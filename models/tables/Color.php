<?php

class Color extends AbstractTable {

	const TABLE = "color";

//main info
	private $id;
	private $name;
	private $value;
	private $status;

	//getters
	public function getID() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getValue() {
		return $this->value;
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

	public function setName(string $name) {
		if ($this->validator->checkName($name)) {
			$this->name = $name;
			return true;
		}
		return false;
	}

	public function setValue(string $value) {
		if ($this->validator->checkValue($value)) {
			$this->value = $value;
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
		$this->validator = new ColorValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id 		= $arr['id'];
		$obj->name 		= $arr['name'];
		$obj->value 	= $arr['value'];
		$obj->status 	= $arr['status'];

		return $obj;
	}
//construct end

}

class ColorValidator extends AbstractValidator {

//const
	const CLASS_NAME = "Color";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";
	//Символ #, цифры, a,b,c,d,e. 7 символов
	const VALUE_PATTERN = "/^#[0-9aAbBcCdDeE]{6}$/";

	const NAME_ERROR = "Неправильный ввод имени";
	const VALUE_ERROR = "Неправильный ввод значения";
//const end

//check
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}

	public function checkValue(string $value) : bool {
		$error = array("value" => self::VALUE_ERROR);
		return parent::checkString($value, self::VALUE_PATTERN, $error);
	}
//check end

}