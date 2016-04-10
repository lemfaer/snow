<?php

/**
 * Обрабатыает запросы связанные с CRUPChar формой 
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @final
 */
final class CRUPCharForm extends AbstractCRUPForm {
	
	/**
	 * Выполняет валидацию данных полученных из формы Char
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator      = new CharNameValidator();
		$valueValidator = new CharValueValidator();
		$catValidator   = new CategoryValidator();

		$method = function(string $key) use(&$valueValidator, &$catValidator) {
			if(preg_match("/value_[0-9]+/", $key)) {
				return array($valueValidator, "checkValue");
			}

			switch ($key) {
				case "id":
					$m = array($valueValidator, "checkID");
					break;
				case "category":
					$m = array($catValidator, "checkID");
					break;
				case "name":
					$m = "checkName";
					break;
				case "value":
					$m = array($valueValidator, "checkValue");
					break;
				case "status":
					$m = "checkStatus";
					break;
				default:
					throw new WrongDataException($key);
			}
			return $m;
		};

		$result = parent::checkParamsDefault($data, $method, $validator);
		return json_encode($result);
	}

	/**
	 * Создает новую запись Char в базе данных на основе данных из формы
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
		//charName
			try {
				$category = Category::findFirst(array("id" => $categoryID));
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($categoryID, "wrong category id", $e);
			}

			$charName = new CharName();

			$charName->setName($name);
			$charName->setStatus(true);
			$charName->setCategory($category);

			$charName->insert();
		//charName end

		//charValue
			if(isset($data['value'])) {
				foreach ($data['value'] as $value) {
					$charValue = new CharValue();

					$charValue->setValue($value);
					$charValue->setName($charName);
					$charValue->setStatus($status);

					$charValue->insert();
				}
			}
		//charValue end
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Редактирует запись Char в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function update(array $data) {
		$id     = $data['id'];
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
		//charValue
			try {
				$charValue = CharValue::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong id", $e);
			}
			
			$charValue->setStatus($status);

			if(isset($data['value'])) {
				$charValue->setValue($data['value']);
			}

			if(!$charValue->isSaved()) {
				$charValue->update();
			}
		//charValue end

		//charName
			$charName = $charValue->getName();

			if(isset($data['name'])) {
				$charName->setName($data['name']);
			}

			if(isset($data['category'])) {
				$categoryID = $data['category'];

				try {
					$category = Category::findFirst(array("id" => $categoryID));
				} catch(RecordNotFoundException $e) {
					throw new WrongDataException($categoryID, "wrong id", $e);
				}

				$charName->setCategory($category);
			}

			if(!$charName->isSaved()) {
				$charName->update();
			}
		//charName end
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}