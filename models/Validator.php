<?php

abstract class Validator {

	//кириллица, латиница, цифры, пробел, дефис. Начаная с большой БУКВЫ 
	const STRING_PATTERN = "/^[A-Z,А-Я,Ё][A-Z,a-z,А-Я,а-я,Ё,ё,0-9,\-, ]{1,98}$/u";

	const ID_ERROR 		= "Неправильный ввод идентификатора";
	const STRING_ERROR 	= "Неправильный ввод имени";
	const STATUS_ERROR 	= "Неправильный ввод статуса";

	protected static $errorInfo;

	public static function errorInfo() : array {
		return self::$errorInfo;
	}

	protected static function log(bool $bool, array $errorInfo = array()) : bool {
		if(!$bool) {
			if($errorInfo) {
				$errorInfo = array_slice($errorInfo, 0, 1);
				$key = key($errorInfo);
				self::$errorInfo[$key] = $errorInfo[$key];
			}
		}
		return $bool;
	}

	public static function checkID(int $id, string $class) : bool {
		$error = array("id" => self::ID_ERROR);

		if(!is_numeric($id) || !is_string($class)) {
			return self::log(false, $error);
		}

		$id = intval($id);

		return self::log($class::findCount(array("id" => $id)) > 0, $error);
	}

	public static function checkString(string $str, string $name) : bool {
		$error = array($name => self::STRING_ERROR);

		if(!is_string($str)) {
			return self::log(false, $error);
		}

		return self::log(preg_match(self::STRING_PATTERN, $str) === 1, $error);
	}

}