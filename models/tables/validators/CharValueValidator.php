<?php

class CharValueValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "CharValue";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const VALUE_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const VALUE_ERROR = "Неправильный ввод значения";
//const end

//closures
	private $checkName;
	private $checkValue;
//closures end

	public function __construct() {
		parent::__construct();

		$this->checkName = function(CharName $name) : bool {
			$error = array("name" => parent::CHARNAME_OBJECT_ERROR);
			return parent::checkObject($name, $error);
		};
		
		$this->checkValue = function(string $value) : bool {
			$error = array("value" => self::VALUE_ERROR);
			return parent::checkString($value, self::VALUE_PATTERN, $error);
		};
	}

}