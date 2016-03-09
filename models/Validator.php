<?php

abstract class Validator {

	//кириллица, латиница, цифры, пробел, дефис. Начаная с большой БУКВЫ 
	const NAME_PATTERN = "/^[A-Z,А-Я,Ё][A-Z,a-z,А-Я,а-я,Ё,ё,0-9,\-, ]{1,98}$/u";

	const ID_ERROR 		= "Неправильный ввод идентификатора";
	const NAME_ERROR 	= "Неправильный ввод имени";
	const STATUS_ERROR 	= "Неправильный ввод статуса";

	protected static $errorInfo;

	public static function errorInfo() {
		return self::$errorInfo;
	}

	protected static function log($bool, $errorInfo = array()) {
		if(!$bool) {
			if($errorInfo) {
				$errorInfo = array_slice($errorInfo, 0, 1);
				$key = key($errorInfo);
				self::$errorInfo[$key] = $errorInfo[$key];
			}
		}
		return $bool;
	}

	public static function checkID($id, $class) {
		$error = array("id" => self::ID_ERROR);

		if(!is_numeric($id) || !is_string($class)) {
			return self::log(false, $error);
		}

		$id = intval($id);

		return self::log($class::findCount(array("id" => $id)) > 0, $error);
	}

	public static function checkName($name) {
		$error = array("name" => self::NAME_ERROR);

		if(!is_string($name)) {
			return self::log(false, $error);
		}

		return self::log(preg_match(self::NAME_PATTERN, $name) === 1, $error);
	}

	public static function checkStatus($status) {
		$error = array("status" => self::STATUS_ERROR);

		switch ($status) {
			case '0':
			case '1': 
				return log(true, $error);

			default: 
				return log(false, $error);
		}
	}

}