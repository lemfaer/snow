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
		if(isset($data['category'])) {
			try {
				$data['category'] = Category::findFirst(
					array("id" => $data['category']));
			} catch(RecordNotFoundException $e) {
				$data['category'] = new NullCategory();
			}
		}

		$validator = new SizeValidator();

		$method = function(string $key) : string {
			switch ($key) {
				case "id":
					$m = "checkID";
					break;
				case "category":
					$m = "checkCategory";
					break;
				case "subcategory":
					$m = "checkCategory";
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
	 * Сосдает новую запись Size в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function create(array $data) {
		try {
			$category = Category::findFirst(array("id" => $data['category']));
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($data['category'], "wrong id", $e);
		}
		$name   = $data['name'];
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
			$c = new Size();
			$c->setName($name);
			$c->setStatus($status);
			$c->setCategory($category);

			$c->insert();
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
			$c = Size::findFirst(array("id" => $id), true);
			$c->setStatus($status);

			isset($data['name']) ? ($c->setName($data['name'])) : (null);
			if(isset($data['category'])) {
				try {
					$category = Category::findFirst(array("id" => $data['category']));
				} catch(RecordNotFoundException $e) {
					throw new WrongDataException($data['category'], "wrong id", $e);
				}
				$c->setCategory($category);
			}

			if(!$c->isSaved()) {
				$c->update();
			}
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($data, "wrong id", $e);
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}