<?php

abstract class Validator {

//const
	//кириллица, латиница, цифры, пробел, дефис. Начаная с большой БУКВЫ 
	const STRING_PATTERN = "/^[A-Z,А-Я,Ё][A-Z,a-z,А-Я,а-я,Ё,ё,0-9,\-, ]{1,98}$/u";

	const ID_ERROR		= "Неправильный идентификатор";
	const OBJECT_ERROR 	= "Передан неправильный обьект";
	const STRING_ERROR 	= "Неправильный ввод имени";
//const end

//error info
	protected $errorInfo = array();

	public function errorInfo() : array {
		return $this->errorInfo;
	}

	protected function log(bool $bool, array $errorInfo = array()) : bool {
		if(!$bool) {
			if($errorInfo) {
				$errorInfo = array_slice($errorInfo, 0, 1);
				$key = key($errorInfo);
				$this->errorInfo[$key] = $errorInfo[$key];
			}
		}
		return $bool;
	}
//error info end

//standart check
	public function checkID(int $id) : bool {
		$class = get_called_class()::CLASS_NAME;
		$error = array("id" => self::ID_ERROR);
		return self::log($class::findCount(array("id" => $id)) > 0, $error);
	}

	protected function checkObject(AbstractRecord $obj, string $class, string $key = null) : bool {
		$error = array($key => self::OBJECT_ERROR);
		return self::log($class::findCount(array("id" => $id)) > 0, $error);
	} 

	protected function checkString(string $str, string $key) : bool {
		$error = array($key => self::STRING_ERROR);
		return self::log(preg_match(self::STRING_PATTERN, $str) === 1, $error);
	}
//standart check end

}