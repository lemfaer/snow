<?php

class User extends AbstractTable {

	const TABLE = "user"; 

//main info
	private $id;
	private $first_name;
	private $last_name;
	private $email;
	private $login;
	private $password;
	private $status;

	//getters
	public function getID() {
		return $this->id;
	}

	public function getFirstName() {
		return $this->first_name;
	}

	public function getLastName() {
		return $this->last_name;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getLogin() {
		return $this->login;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getStatus() {
		return $this->status;
	}
	//getters end

	//setters
	protected function setID(int $id) : bool {
		if ($this->validator->checkID($id)) {
			$this->id = $id;
			return true;
		}
		return false;
	}

	public function setFirstName(string $first_name) {
		if ($this->validator->checkFirstName($first_name)) {
			$this->first_name = $first_name;
			return true;
		}
		return false;
	}

	public function setLastName(string $last_name) {
		if ($this->validator->checkLastName($last_name)) {
			$this->last_name = $last_name;
			return true;
		}
		return false;
	}

	public function setEmail(string $email) {
		if ($this->validator->checkEmail($email)) {
			$this->email = $email;
			return true;
		}
		return false;
	}

	public function setLogin(string $login) {
		if ($this->validator->checkLogin($login)) {
			$this->login = $login;
			return true;
		}
		return false;
	}

	public function setPassword(string $password) {
		if ($this->validator->checkPassword($password)) {
			$this->password = $password;
			return true;
		}
		return false;
	}

	public function setStatus(bool $status) {
		if ($this->validator->checkStatus($status)) {
			$this->status = $status;
			return true;
		}
		return false;
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new UserValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id			= $arr['id'];
		$obj->first_name	= $arr['first_name'];
		$obj->last_name	= $arr['last_name'];
		$obj->email		= $arr['email'];
		$obj->login		= $arr['login'];
		$obj->password		= $arr['password'];
		$obj->status		= $arr['status'];

		return $obj;
	}
//construct end

}

class UserValidator extends AbstractValidator {

//const
	const CLASS_NAME = "User";

	//кириллица, латиница, цифры, пробел, дефис. Начаная с большой БУКВЫ. 2-99 символов
	const FIRSTNAME_PATTERN = "/^[A-ZА-ЯЁ][A-Za-zА-Яа-яЁё0-9\- ]{1,98}$/u";
	//кириллица, латиница, цифры, пробел, дефис. Начаная с большой БУКВЫ. 2-99 символов
	const LASTNAME_PATTERN = "/^[A-ZА-ЯЁ][A-Za-zА-Яа-яЁё0-9\- ]{1,98}$/u";
	//латиница, цифры. 1-99 символов
	const LOGIN_PATTERN = "/^[a-zA-Z0-9]{1,99}$/";
	//латиница, цифры. 6-99 символов
	const PASSWORD_PATTERN = "/^[a-zA-Z0-9]{6,99}$/";

	const FIRSTNAME_ERROR = "Неправильный ввод имени";
	const LASTNAME_ERROR = "Неправильный ввод фамилии";

	const EMAIL_INVALID_ERROR = "Неправильный ввод email";
	const EMAIL_EXIST_ERROR = "Такой email уже зарегистрирован";

	const LOGIN_INVALID_ERROR = "Неправильный ввод логина";
	const LOGIN_EXIST_ERROR = "Ползователь с таким логином уже зарегистрирован";

	const PASSWORD_MIN_LENGTH = 6;
	const PASSWORD_LENGTH_ERROR = "Длина пароля недостаточна";
	const PASSWORD_INVALID_ERROR = "Пароль содержит неразрешенные символы";
//const end

//check
	public function checkFirstName(string $first_name) : bool {
		$error = array("first_name" => self::FIRSTNAME_ERROR);
		return parent::checkString($first_name, self::FIRSTNAME_PATTERN, $error);
	}

	public function checkLastName(string $last_name) : bool {
		$error = array("last_name" => self::LASTNAME_ERROR);
		return parent::checkString($last_name, self::LASTNAME_PATTERN, $error);
	}

	public function checkEmail(string $email) : bool {
		$bool = false;
		$error = array("email" => self::EMAIL_INVALID_ERROR);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = array("email" => self::EMAIL_EXIST_ERROR);
			if(!User::findCount(array("email" => $email))) {
				$bool = true;
			}
		}
		return parent::log($bool, $error);
	}

	public function checkLogin(string $login) : bool {
		$bool = false;
		$error = array("login" => self::LOGIN_INVALID_ERROR);
		if(preg_match(self::LOGIN_PATTERN, $login)) {
			$error = array("login" => self::LOGIN_EXIST_ERROR);
			if(!User::findCount(array("login" => $login))) {
				$bool = true;
			}
		}
		return parent::log($bool, $error);
	}

	public function checkPassword(string $password) : bool {
		$bool = false;
		$error = array("password" => self::PASSWORD_LENGTH_ERROR);
		if(strlen($password) >= self::PASSWORD_MIN_LENGTH) {
			$error = array("password" => self::PASSWORD_INVALID_ERROR);
			if(preg_match(self::PASSWORD_PATTERN, $password)) {
				$bool = true;
			}
		}
		return parent::log($bool, $error);
	}
//check end

}