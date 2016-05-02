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
		$validator   = new UserValidator();
		$cnValidator = new ContactValidator();

		if(isset($data['contact'])) {
			$contact = $data['contact'];

			if(isset($contact['names'])) {
				$data = array_merge($data, $contact['names']);
			}

			if(isset($contact['phones'])) {
				$data = array_merge($data, $contact['phones']);
			}

			if(isset($contact['addresses'])) {
				$data = array_merge($data, $contact['addresses']);
			}

			unset($data['contact']);
		}

		$method = function(string $key) use (&$cnValidator) {
			if(preg_match("/contact-name_[0-9]+/", $key)) {
				return array($cnValidator, "checkName");
			}

			if(preg_match("/contact-phone_[0-9]+/", $key)) {
				return array($cnValidator, "checkPhone");
			}

			if(preg_match("/contact-address_[0-9]+/", $key)) {
				return array($cnValidator, "checkAddress");
			}

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
				case "is_admin":
					$m = "checkAdmin";
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
		$admin     = filter_var($data['is_admin'], FILTER_VALIDATE_BOOLEAN);

		try {
		//user
			$user = new User();
			
			$user->setEmail($email);
			$user->setLogin($login);
			$user->setAdmin($admin);
			$user->setStatus($status);
			$user->setPassword($password);
			$user->setLastName($lastName);
			$user->setFirstName($firstName);

			$user->generateHash();

			$user->insert();
		//user end

		//userItem
			$userItem = UserItem::withUser($user);

			if(isset($data['contact'])) {
				$name    = array_shift($data['contact']['names']);
				$phone   = array_shift($data['contact']['phones']);
				$address = array_shift($data['contact']['addresses']);

				$contact = new Contact();

				$contact->setName($name);
				$contact->setPhone($phone);
				$contact->setAddress($address);
				$contact->setStatus(true);

				$userItem->setContact($contact);
			}

			$userItem->insert();
		//userItem end

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
		$admin  = filter_var($data['is_admin'], FILTER_VALIDATE_BOOLEAN);

		try {
			try {
				$userItem = UserItem::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong id", $e);
			}

			$user = $userItem->getUser();
		//user
			$user->setAdmin($admin);
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
		//user end
			$userItem->setUser($user);

		//contact
			// contact 1 - added, 2 - modified, 3 - deleted
			if(isset($data['contact']) && !$userItem->issetContact()) {
				$name    = array_shift($data['contact']['names']);
				$phone   = array_shift($data['contact']['phones']);
				$address = array_shift($data['contact']['addresses']);

				$contact = new Contact();

				$contact->setName($name);
				$contact->setPhone($phone);
				$contact->setAddress($address);
				$contact->setStatus(true);

				$userItem->setContact($contact);
			} elseif(isset($data['contact']) && $userItem->issetContact()) {
				$contact = $userItem->getContact();

				if(isset($data['contact']['names'])) {
					$name = array_shift($data['contact']['names']);
					$contact->setName($name);
				}

				if(isset($data['contact']['phones'])) {
					$phone = array_shift($data['contact']['phones']);
					$contact->setPhone($phone);
				}

				if(isset($data['contact']['addresses'])) {
					$address = array_shift($data['contact']['addresses']);
					$contact->setAddress($address);
				}

				$userItem->setContact($contact);
			} elseif(!isset($data['contact']) && $userItem->issetContact()) {
				$userItem->unsetContact();
			}
		//contact end

			$userItem->update();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

}