<?php

class CharValue extends AbstractTable {

	const TABLE = "char_value";

//main info
	private $id;
	private $name; //class
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

	public function setName(CharName $name) : bool {
		if ($this->validator->checkName($name)) {
			$this->name = $name;
			return true;
		}
		return false;
	}

	public function setValue(string $value) : bool {
		if ($this->validator->checkValue($value)) {
			$this->value = $value;
			return true;
		}
		return false;
	}

	public function setStatus(bool $status) : bool {
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
		$this->validator = new CharValueValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = $arr['id'];
		$obj->value  = $arr['value'];
		$obj->status = $arr['status'];

		$name      = CharName::findFirst(array("id" => $arr['name_id']));
		$obj->name = $name;

		return $obj;
	}
//construct end

}

class CharValueValidator extends AbstractValidator {

//const
	const CLASS_NAME = "CharValue";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const VALUE_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const VALUE_ERROR = "Неправильный ввод значения";
//const end

//check
	public function checkName(CharName $name) : bool {
		$error = array("name" => parent::CHARNAME_OBJECT_ERROR);
		return parent::checkObject($name, $error);
	}
	
	public function checkValue(string $value) : bool {
		$error = array("value" => self::VALUE_ERROR);
		return parent::checkString($value, self::VALUE_PATTERN, $error);
	}
//check end

}