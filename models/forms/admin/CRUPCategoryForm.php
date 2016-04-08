<?php

/**
 * Обрабатыает запросы связанные с CRUPCategory формой 
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @final
 */
final class CRUPCategoryForm extends AbstractCRUPForm {
	
	/**
	 * Выполняет валидацию данных полученных из формы Category
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator   = new CategoryValidator();
		$imValidator = new ImageValidator();

		if(isset($data['file']['image'])) {
			$data['image'] = $data['file']['image'];
			unset($data['file']);
		}

		if(isset($data['image']) && isset($data['image_only'])) {
			$data = array("image" => $data['image']);
		}

		if(isset($data['sort_order'])) {
			$data['sort_order'] = (int) $data['sort_order'] + 1;
		}

		$method = function(string $key) use (&$imValidator) {
			switch ($key) {
				case "id":
					$m = "checkID";
					break;
				case "name":
					$m = "checkName";
					break;
				case "short_name":
					$m = "checkShortName";
					break;
				case "description":
					$m = "checkDescription";
					break;
				case "sort_order":
					$m = "checkSortOrder";
					break;
				case "parent":
					$m = "checkID";
					break;
				case "image":
					$m = array($imValidator, "checkUploadedFile");
					break;
				case "status":
					$m = "checkStatus";
					break;
				default:
					throw new WrongDataException($key);
			}
			return $m;
		};

		$result =  parent::checkParamsDefault($data, $method, $validator);
		return json_encode($result);
	}

	/**
	 * Создает новую запись Category в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function create(array $data) {
		$name     = $data['name'];
		$parentID = $data['parent'];
		$sort     = $data['sort_order'];
		$short    = $data['short_name'];
		$desc     = $data['description'];
		$imageID  = $data['file']['image'];
		$status   = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
		//image
			$image = new Image();
			try {
				$image->setByUploadedFile($imageID);
				$image->setStatus(true);
				$image->insert();
			} catch(WrongDataException $e) {
				throw new WrongDataException($imageID, "wrong file", $e);
			}
		//image end

		//parent
			try {
				$parent = Category::findFirst(array("id" => $parentID), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($parentID, "wrong id", $e);
			}
		//parent end

		//sort
			$query = "UPDATE category AS c
				SET sort_order = sort_order + '1'
				WHERE sort_order > '$sort' AND parent_id = '$parentID'";
			DB::query($query);
			$sort = $sort + 1;
		//sort end

			$category = new Category();

			$category->setName($name);
			$category->setImage($image);
			$category->setParent($parent);
			$category->setStatus($status);
			$category->setSortOrder($sort);
			$category->setShortName($short);
			$category->setDescription($desc);

			$category->insert();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Редактирует запись Category в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function update(array $data) {
		$id     = $data['id'];
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
			try {
				$category = Category::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong id", $e);
			}

			$category->setStatus($status);
			
			if(isset($data['name'])) {
				$category->setName($data['name']);
			}

			if(isset($data['short_name'])) {
				$category->setShortName($data['short_name']);
			}

			if(isset($data['description'])) {
				$category->setDescription($data['description']);
			}

			if(isset($data['sort_order'])) {
				$sort = $data['sort_order'] + 1;
				$category->setSortOrder($sort);
			}

			if(isset($data['parent'])) {
				$parentID = $data['parent'];

				try {
					$parent = Category::findFirst(array("id" => $parentID), true);
				} catch(RecordNotFoundException $e) {
					throw new WrongDataException($parentID, "wrong id", $e);
				}

				$category->setParent($parent);
			}

			if(isset($data['file']['image'])) {
				$imageUF = $data['file']['image'];

				try {
					$image = new Image();

					$image->setStatus(true);
					$image->setByUploadedFile($imageUF);
					
					$image->insert();
				} catch(WrongDataException $e) {
					throw new WrongDataException($imageUF, "wrong file", $e);
				}

				$category->setImage($image);
			}

			if(!$category->isSaved()) {
				$category->update();
			}
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}