<?php

/**
 * Обрабатыает запросы связанные с CRUPColor формой 
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @final
 */
final class CRUPColorForm extends AbstractCRUPForm {
	
	/**
	 * Выполняет валидацию данных полученных из формы Color
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator = new ColorValidator();

		$method = function(string $key) : string {
			switch ($key) {
				case "id":
					$m = "checkID";
					break;
				case "name":
					$m = "checkName";
					break;
				case "value":
					$m = "checkValue";
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
	 * Создает новую запись Color в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function create(array $data) {
		$name   = $data['name'];
		$value  = $data['value'];
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
			$color = new Color();

			$color->setName($name);
			$color->setValue($value);
			$color->setStatus($status);

			$color->insert();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Редактирует запись Color в базе данных на основе данных из формы
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
				$color = Color::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong id", $e);
			}

			$color->setStatus($status);

			if(isset($data['name'])) {
				$color->setName($data['name']);
			}

			if(isset($data['value'])) {
				$color->setValue($data['value']);
			}

			if(!$color->isSaved()) {
				$color->update();
			}
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}