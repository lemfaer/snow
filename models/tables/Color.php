<?php

class Color extends AbstractRecord {

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
	public function setName($name) {
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
		$color = self::findFirstDefault(__CLASS__, "color", $where, $nullStatus);
		return $color;
	}

	public static function findAll($where, $limit = self::LIMIT_MAX, $offset = 0, $order = "id", $nullStatus = false) {
		$colorList = self::findAllDefault(__CLASS__, "color", $where, $limit, $offset, 
			$order, $nullStatus);
		return $colorList;
	}

	public function insert() {}

	public function update() {}

	public function delete() {}

	public function getArray() {
		$arr = array();
		$arr['id'] 		= $this->id;
		$arr['name'] 	= $this->name;
		$arr['value'] 	= $this->value;
		$arr['status'] 	= $this->status;

		return $arr;
	}

	protected function setByArray($arr) {
		$this->id 		= $arr['id'];
		$this->name 	= $arr['name'];
		$this->value 	= $arr['value'];
		$this->status 	= $arr['status'];
	}
//abstract methods realization end

	public function __toString() {
		return strval($this->id);
	}

}