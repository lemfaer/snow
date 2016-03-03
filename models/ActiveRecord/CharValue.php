<?php

class CharValue extends AbstractRecord {

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

//abstract methods realization
	public static function findFirst($where, $nullStatus = false) {
		$charValue = self::findFirstDefault(__CLASS__, "char_value", $where, $nullStatus);
		return $charValue;
	}

	public static function findAll($where, $limit, $offset, $order = "id", $nullStatus = false) {
		$charValueList = self::findAllDefault(__CLASS__, "char_value", $where, $limit, $offset, 
			$order, $nullStatus);
		return $charValueList;
	}

	public function insert() {}

	public function update() {}

	public function delete() {}

	public function getArray() {
		$arr = array();
		$arr['id'] 		= $this->id;
		$arr['name'] 	= $this->name->getArray(); //class
		$arr['value'] 	= $this->value;
		$arr['status'] 	= $this->status;

		return $arr;
	}

	protected function setByArray($arr) {
		$this->id 		= $arr['id'];
		$this->value 	= $arr['value'];
		$this->status 	= $arr['status'];

		$this->name = CharName::findFirst("id = {$arr['name_id']}");
	}
//abstract methods realization end

}