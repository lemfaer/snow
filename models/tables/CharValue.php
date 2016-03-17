<?php

class CharValue extends AbstractTable {

	const TABLE = "char_value";

//main info
	private $id;
	private $name; //class
	private $value;
	private $status;

	//getters
	public function getID() : int {
		return parent::get($this->id);
	}

	public function getName() : CharName {
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

	public function setName(CharName $name) {
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