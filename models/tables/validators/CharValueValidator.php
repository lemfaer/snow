<?php

class CharValueValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "CharValue";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const VALUE_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const VALUE_ERROR = "Неправильный ввод значения";
//const end

//validate methods
	public function checkName(CharName $name) : bool {
		$error = array("name" => parent::CHARNAME_OBJECT_ERROR);
		return parent::checkObject($name, $error);
	}

	public function checkValue(string $value) : bool {
		$error = array("value" => self::VALUE_ERROR);
		return parent::checkString($value, self::VALUE_PATTERN, $error);
	}
//validate methods end

}