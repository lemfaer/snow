<?php

class Color extends AbstractTable {

	const TABLE = "color";

//main info
	//protected $id
	private $name;
	private $value;
	//protected $status

	//getters
	public function getName() : string {
		return parent::get($this->name);
	}

	public function getValue() : string {
		return parent::get($this->value);
	}
	//getters end

	//setters
	public function setName(string $name) {
		$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
		$this->name = parent::set($name, $this->validator->checkName);
	}

	public function setValue(string $value) {
		$value = mb_convert_case($value, MB_CASE_UPPER, "UTF-8");
		$this->value = parent::set($value, $this->validator->checkValue);
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new ColorValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = $arr['id'];
		$obj->name   = $arr['name'];
		$obj->value  = $arr['value'];
		$obj->status = $arr['status'];

		return $obj;
	}
//construct end

}