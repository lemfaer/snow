<?php

class ColorValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Color";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";
	//Символ #, цифры, a,b,c,d,e. 7 символов
	const VALUE_PATTERN = "/^#[0-9aAbBcCdDeEfF]{6}$/";

	const NAME_ERROR          = "Неправильный ввод имени";
	const VALUE_INVALID_ERROR = "Неправильный ввод значения";
	const VALUE_EXISTS_ERROR  = "Такой цвет уже существует";
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
			$bool = false;
			$error = array("value" => self::VALUE_INVALID_ERROR);
			if(preg_match(self::VALUE_PATTERN, $value)) {
				$error = array("value" => self::VALUE_EXISTS_ERROR);
				if(!(Color::findCount(array("value" => $value), true) > 0)) {
					$bool = true;
				}
			}
			return parent::log($bool, $error);
		};
	}

}