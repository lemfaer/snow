<?php

/**
 * Обрабатыает запросы связанные с CRUPSize формой 
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @final
 */
final class CRUPSizeForm extends AbstractCRUPForm {
	
	/**
	 * Выполняет валидацию данных полученных из формы Size
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator    = new SizeValidator();
		$catValidator = new CategoryValidator();

		$method = function(string $key) use(&$catValidator) {
			switch ($key) {
				case "id":
					$m = "checkID";
					break;
				case "category":
					$m = array($catValidator, "checkID");
					break;
				case "name":
					$m = "checkName";
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
	 * Создает новую запись Size в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function create(array $data) {
		$name       = $data['name'];
		$categoryID = $data['category'];
		$status     = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
		//category
			try {
				$category = Category::findFirst(array("id" => $categoryID));
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($categoryID, "wrong category id", $e);
			}
		//category end

			$size= new Size();

			$size->setName($name);
			$size->setStatus($status);
			$size->setCategory($category);

			$size->insert();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Редактирует запись Size в базе данных на основе данных из формы
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
				$size = Size::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong id", $e);
			}

			$size->setStatus($status);

			if(isset($data['name'])) {
				$size->setName($data['name']);
			}

			if(isset($data['category'])) {
				$categoryID = $data['category'];

				try {
					$category = Category::findFirst(array("id" => $categoryID));
				} catch(RecordNotFoundException $e) {
					throw new WrongDataException($categoryID, "wrong id", $e);
				}

				$size->setCategory($category);
			}

			if(!$size->isSaved()) {
				$size->update();
			}
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}