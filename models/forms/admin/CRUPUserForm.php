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
		$firstName = $data['first_name'];
		$lastName  = $data['last_name'];
		$email     = $data['email'];
		$login     = $data['login'];
		$password  = $data['password']; 
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);

		try {
			$u = new User();
			$u->setFirstName($firstName);
			$u->setLastName($lastName);
			$u->setEmail($email);
			$u->setLogin($login);
			$u->setPassword($password);
			$u->setStatus($status);

			$u->generateHash();

			$u->insert();
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
			$u = User::findFirst(array("id" => $id), true);
			$u->setStatus($status);

			isset($data['first_name']) ? ($u->setFirstName($data['first_name'])) : (null);
			isset($data['last_name'])  ? ($u->setLastName($data['last_name']))   : (null);
			isset($data['email'])      ? ($u->setEmail($data['email']))          : (null);
			isset($data['login'])      ? ($u->setLogin($data['login']))          : (null);
			isset($data['password'])   ? ($u->setPassword($data['password']))    : (null);

			$u->generateHash();

			if(!$u->isSaved()) {
				$u->update();
			}
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($data, "wrong id", $e);
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}