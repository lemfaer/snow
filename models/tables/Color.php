<?php

class Color extends AbstractTable {

	const TABLE = "color";

//main info
	private $id;
	private $name;
	private $value;
	private $status;

	//getters
	public function getID() : int {
		return parent::get($this->id);
	}

	public function getName() : string {
		return parent::get($this->name);
	}

	public function getValue() : string {
		return parent::get($this->value);
	}

	public function getStatus() : bool {
		return parent::get($this->status);
	}
	//getters end

	//setters
	protected function setID(int $id) {
		$this->id = parent::set($id, $this->validator->checkID);
	}

	public function setName(string $name) {
		$this->name = parent::set($name, $this->validator->checkName);
	}

	public function setValue(string $value) {
		$this->value = parent::set($value, $this->validator->checkValue);
	}

	public function setStatus(bool $status) {
		$this->status = parent::set($status, $this->validator->checkStatus);
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