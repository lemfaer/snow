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

		if(isset($data['file']['image'])) {
			$data['image'] = $data['file']['image'];
			unset($data['file']);
		}

		if(isset($data['image']) && isset($data['image_only'])) {
			$data = array("image" => $data['image']);
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
		$name    = $data['name'];
		$imageUF = $data['file']['image'];
		$status  = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
		//image
			try {
				$image = new Image();

				$image->setStatus(true);
				$image->setByUploadedFile($imageUF);

				$image->insert();
			} catch(WrongDataException $e) {
				throw new WrongDataException($imageUF, "wrong file", $e);
			}
		//image end

			$producer = new Producer();

			$producer->setName($name);
			$producer->setImage($image);
			$producer->setStatus($status);

			$producer->insert();
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
			try {
				$producer = Producer::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong id", $e);
			}

			$producer->setStatus($status);
			
			if(isset($data['name'])) {
				$producer->setName($data['name']);
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

				$producer->setImage($image);
			}

			if(!$producer->isSaved()) {
				$producer->update();
			}
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}