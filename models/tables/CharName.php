<?php

class CharName extends AbstractRecord {

	const TABLE = "char_name";

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
	private function setID($id) {
		$this->id = $id;
	}

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

//construct
	protected function withArray($arr) {
		$obj = new self();

		$obj->id = $arr['id'];
		$obj->name = $arr['name'];
		$obj->status = $arr['status'];

		$category = Category::findFirst("id = {$arr['category_id']}");
		$obj->category = $category;

		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}

	public function delete() {}
//abstract methods realization end

}