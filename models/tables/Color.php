<?php

class Color extends AbstractRecord {

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
	private function setID(int $id) {
		$this->id = $id;
	}

	public function setName(string $name) {
		$this->name = $name;
	}

	public function setValue(string $value) {
		$this->value = $value;
	}

	public function setStatus(bool $status) {
		$this->status = $status;
	}
	//setters end
//main info end

//construct
	protected static function withArray(array $arr) : AbstractRecord {
		$obj = new self();

		$obj->id 		= $arr['id'];
		$obj->name 		= $arr['name'];
		$obj->value 	= $arr['value'];
		$obj->status 	= $arr['status'];

		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}

	public function delete() {}
//abstract methods realization end

}