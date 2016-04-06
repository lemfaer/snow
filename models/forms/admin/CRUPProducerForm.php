<?php

/**
 * Обрабатыает запросы связанные с CRUPProducer формой 
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @final
 */
final class CRUPProducerForm extends AbstractCRUPForm {
	
	/**
	 * Выполняет валидацию данных полученных из формы Producer
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator   = new ProducerValidator();
		$imValidator = new ImageValidator();

		if(isset($data['file'])) {
			$data['image'] = $data['file']['image'];
			unset($data['file']);
		}

		$method = function(string $key) use (&$imValidator) {
			switch ($key) {
				case "id":
					$m = "checkID";
					break;
				case "name":
					$m = "checkName";
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
	 * Создает новую запись Producer в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function create(array $data) {
		$name   = $data['name'];
		$image  = $data['file']['image'];
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
			$im = new Image();
			try {
				$im->setByUploadedFile($image);
				$im->setStatus(true);
				$im->insert();
			} catch(WrongDataException $e) {
				throw new WrongDataException($im, "wrong file", $e);
			}

			$p = new Producer();
			$p->setName($name);
			$p->setImage($im);
			$p->setStatus($status);

			$p->insert();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Редактирует запись Producer в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function update(array $data) {
		$id     = $data['id'];
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
			$p = Producer::findFirst(array("id" => $id), true);
			$p->setStatus($status);
			
			isset($data['name']) ? ($p->setName($data['name'])) : (null);
			if(isset($data['file']['image'])) {
				$im = new Image();
				try {
					$im->setByUploadedFile($data['file']['image']);
					$im->setStatus(true);
					$im->insert();
				} catch(WrongDataException $e) {
					throw new WrongDataException($im, "wrong file", $e);
				}
				$p->setImage($im);
			}

			if(!$p->isSaved()) {
				$p->update();
			}
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($data, "wrong id", $e);
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}