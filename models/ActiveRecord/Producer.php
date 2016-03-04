<?php

class Producer extends AbstractRecord {

//main info
	private $id;
	private $name;
	private $status;

	//getters
	public function getID() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getStatus() {
		return $this->status;
	}
	//getters end

	//setters
	public function setName($name) {
		$this->name = $name;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
	//setters end
//main info end

//abstract methods realization
	public static function findFirst($where, $nullStatus = false) {
		$producer = self::findFirstDefault(__CLASS__, "producer", $where, $nullStatus);
		return $producer;
	}

	public static function findAll($where, $limit, $offset, $order = "id", $nullStatus = false) {
		$producerList = self::findAllDefault(__CLASS__, "producer", $where, $limit, $offset, 
			$order, $nullStatus);
		return $producerList;
	}

	public function insert() {}

	public function update() {}

	public function delete() {}

	public function getArray() {
		$arr = array();
		$arr['id'] 		= $this->id;
		$arr['name'] 	= $this->name;
		$arr['status'] 	= $this->status;

		return $arr;
	}

	protected function setByArray($arr) {
		$this->id 		= $arr['id'];
		$this->name 	= $arr['name'];
		$this->status 	= $arr['status'];
	}
//abstract methods realization end

}