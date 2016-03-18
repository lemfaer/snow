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
		$this->name = parent::set($name, $this->validator->checkName);
	}

	public function setValue(string $value) {
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