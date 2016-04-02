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
			$s = new Size();
			$s->setName($name);
			$s->setStatus($status);
			$s->setCategory($category);

			$s->insert();
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
			$s = Size::findFirst(array("id" => $id), true);
			$s->setStatus($status);

			isset($data['name']) ? ($s->setName($data['name'])) : (null);
			if(isset($data['category'])) {
				try {
					$category = Category::findFirst(array("id" => $data['category']));
				} catch(RecordNotFoundException $e) {
					throw new WrongDataException($data['category'], "wrong id", $e);
				}
				$s->setCategory($category);
			}

			if(!$s->isSaved()) {
				$s->update();
			}
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($data, "wrong id", $e);
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}