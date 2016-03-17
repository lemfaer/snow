<?php

class ColorValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Color";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";
	//Символ #, цифры, a,b,c,d,e. 7 символов
	const VALUE_PATTERN = "/^#[0-9aAbBcCdDeE]{6}$/";

	const NAME_ERROR = "Неправильный ввод имени";
	const VALUE_ERROR = "Неправильный ввод значения";
//const end

//closures
	private $checkName;
	private $checkValue;
//closures end

	public function __construct() {
		parent::__construct();

		$this->checkName = function(string $name) : bool {
			$error = array("name" => self::NAME_ERROR);
			return parent::checkString($name, self::NAME_PATTERN, $error);
		};

		$this->checkValue = function(string $value) : bool {
			$error = array("value" => self::VALUE_ERROR);
			return parent::checkString($value, self::VALUE_PATTERN, $error);
		};
	}

}