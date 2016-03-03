<?php

class CharName extends AbstractRecord {

//main info
	private $id;
	private $name;
	private $category; //class
	private $status;

	//getters
	public function getID() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getCategory() {
		return $this->category;
	}

	public function getStatus() {
		return $this->status;
	}
	//getters end

	//setters
	public function setName($name) {
		$this->name = $name;
	}

	public function setCategory(Category $category) {
		$this->category = $category;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
	//setters end
//main info end

//abstract methods realization
	public static function findFirst($where, $nullStatus = false) {
		$charName = self::findFirstDefault(__CLASS__, "char_name", $where, $nullStatus);
		return $charName;
	}

	public static function findAll($where, $limit, $offset, $order = "id", $nullStatus = false) {
		$charNameList = self::findAllDefault(__CLASS__, "char_name", $where, $limit, $offset, 
			$order, $nullStatus);
		return $charNameList;
	}

	public function insert() {}

	public function update() {}

	public function delete() {}

	public function getArray() {
		$arr = array();
		$arr['id'] 			= $this->id;
		$arr['name'] 		= $this->name;
		$arr['category'] 	= $this->category->getArray(); //class
		$arr['status'] 		= $this->status;

		return $arr;
	}

	protected function setByArray($arr) {
		$this->id 		= $arr['id'];
		$this->name 	= $arr['name'];
		$this->status 	= $arr['status'];

		$this->category = Category::findFirst("id = {$arr['category_id']}");
	}
//abstract methods realization end

}