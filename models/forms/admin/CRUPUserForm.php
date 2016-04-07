<?php

/**
 * Обрабатыает запросы связанные с CRUPUser формой 
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @final
 */
final class CRUPUserForm extends AbstractCRUPForm {
	
	/**
	 * Выполняет валидацию данных полученных из формы User
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator = new UserValidator();

		$method = function(string $key) : string {
			switch ($key) {
				case "id":
					$m = "checkID";
					break;
				case "first_name":
					$m = "checkFirstName";
					break;
				case "last_name":
					$m = "checkLastName";
					break;
				case "email":
					$m = "checkEmail";
					break;
				case "login":
					$m = "checkLogin";
					break;
				case "password":
					$m = "checkPassword";
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
	 * Создает новую запись User в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function create(array $data) {
		$email     = $data['email'];
		$login     = $data['login'];
		$password  = $data['password'];
		$lastName  = $data['last_name'];
		$firstName = $data['first_name'];
		$status    = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
			$user = new User();
			
			$user->setEmail($email);
			$user->setLogin($login);
			$user->setStatus($status);
			$user->setPassword($password);
			$user->setLastName($lastName);
			$user->setFirstName($firstName);

			$user->generateHash();

			$user->insert();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Редактирует запись User в базе данных на основе данных из формы
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
				$user = User::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong id", $e);
			}

			$user->setStatus($status);

			if(isset($data['first_name'])) {
				$user->setFirstName($data['first_name']);
			}

			if(isset($data['last_name'])) {
				$user->setLastName($data['last_name']);
			}

			if(isset($data['email'])) {
				$user->setEmail($data['email']);
			}

			if(isset($data['login'])) {
				$user->setLogin($data['login']);
			}

			if(isset($data['password'])) {
				$user->setPassword($data['password']);
			}

			if(!$user->isSaved()) {
				$user->generateHash();
				$user->update();
			}
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}