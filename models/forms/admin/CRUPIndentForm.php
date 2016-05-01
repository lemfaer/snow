<?php

/**
 * Обрабатыает запросы связанные с CRUPIndent формой 
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @final
 */
final class CRUPIndentForm extends AbstractCRUPForm {
	
	/**
	 * Выполняет валидацию данных полученных из формы Indent
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator      = new IndentValidator();
		$stateValidator = new StateValidator();

		$method = function(string $key) use (&$stateValidator) {
			switch ($key) {
				case "id":
					$m = "checkID";
					break;
				case "state":
					$m = array($stateValidator, "checkID");
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
	 * Перенаправляет на главную
	 * 
	 * @param array $data массив переданный из формы
	 * @return void
	 */
	public static function create(array $data) {
		header("location: /");
	}

	/**
	 * Редактирует запись Indent в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function update(array $data) {
		$id = $data['id'];

		try {
			try {
				$indent = Indent::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong id", $e);
			}

			if(isset($data['state'])) {
				try {
					$state = State::findFirst(array("id" => $data['state']), true);
				} catch(RecordNotFoundException $e) {
					throw new WrongDataException($data['state'], "wrong state id", $e);
				}

				$indent->setState($state);
			}

			if(!$indent->isSaved()) {
				$indent->update();
			}
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}