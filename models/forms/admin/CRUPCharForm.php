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
					$m = "checkID";
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
		try {
			$category = Category::findFirst(array("id" => $data['category']));
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($data['category'], "wrong id", $e);
		}
		$name   = $data['name'];
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
			$cn = new CharName();
			$cn->setCategory($category);
			$cn->setName($name);
			$cn->setStatus(true);

			$cn->insert();

			if(isset($data['value'])) {
				foreach ($data['value'] as $value) {
					$cv = new CharValue();
					$cv->setName($cn);
					$cv->setValue($value);
					$cv->setStatus($status);

					$cv->insert();
				}
			}
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
			$cv = CharValue::findFirst(array("id" => $id), true);
			$cv->setStatus($status);
			isset($data['value']) ? ($cv->setValue($data['value'])) : (null);
			if(!$cv->isSaved()) {
				$cv->update();
			}

			$cn = $cv->getName();
			isset($data['name']) ? ($cn->setName($data['name'])) : (null);
			if(isset($data['category'])) {
				try {
					$category = Category::findFirst(array("id" => $data['category']));
				} catch(RecordNotFoundException $e) {
					throw new WrongDataException($data['category'], "wrong id", $e);
				}
				$cn->setCategory($category);
			}
			if(!$cn->isSaved()) {
				$cn->update();
			}

		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($data, "wrong id", $e);
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}