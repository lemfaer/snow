<?php

class CharValue extends AbstractRecord {

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
	private function setID($id) {
		$this->id = $id;
	}

	public function setName(CharName $name) {
		$this->name = $name;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
	//setters end
//main info end

//construct
	protected function withArray($arr) {
		$obj = new self();

		$obj->id 		= $arr['id'];
		$obj->value 	= $arr['value'];
		$obj->status 	= $arr['status'];

		$name = CharName::findFirst(array("id" => $arr['name_id']));
		$obj->name = $name;

		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}

	public function delete() {}
//abstract methods realization end

}