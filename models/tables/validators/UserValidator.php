<?php

class UserValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "User";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const FIRSTNAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";
	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const LASTNAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";
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

//closure
	private $checkFirstName;
	private $checkLastName;
	private $checkEmail;
	private $checkLogin;
	private $checkPassword;
//closure end

	public function __construct() {
		parent::__construct();

		$this->checkFirstName = function(string $first_name) : bool {
			$error = array("first_name" => self::FIRSTNAME_ERROR);
			return parent::checkString($first_name, self::FIRSTNAME_PATTERN, $error);
		};

		$this->checkLastName = function(string $last_name) : bool {
			$error = array("last_name" => self::LASTNAME_ERROR);
			return parent::checkString($last_name, self::LASTNAME_PATTERN, $error);
		};

		$this->checkEmail = function(string $email) : bool {
			$bool = false;
			$error = array("email" => self::EMAIL_INVALID_ERROR);
			if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error = array("email" => self::EMAIL_EXIST_ERROR);
				if(!(User::findCount(array("email" => $email), true) > 0)) {
					$bool = true;
				}
			}
			return parent::log($bool, $error);
		};

		$this->checkLogin = function(string $login) : bool {
			$bool = false;
			$error = array("login" => self::LOGIN_INVALID_ERROR);
			if(preg_match(self::LOGIN_PATTERN, $login)) {
				$error = array("login" => self::LOGIN_EXIST_ERROR);
				if(!(User::findCount(array("login" => $login), true) > 0)) {
					$bool = true;
				}
			}
			return parent::log($bool, $error);
		};

		$this->checkPassword = function(string $password) : bool {
			$bool = false;
			$error = array("password" => self::PASSWORD_LENGTH_ERROR);
			if(strlen($password) >= self::PASSWORD_MIN_LENGTH) {
				$error = array("password" => self::PASSWORD_INVALID_ERROR);
				if(preg_match(self::PASSWORD_PATTERN, $password)) {
					$bool = true;
				}
			}
			return parent::log($bool, $error);
		};
	}

}