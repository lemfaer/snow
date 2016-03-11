<?php

class CharName extends AbstractRecord {

	const TABLE = "char_name";

//main info
	private $id;
	private $name;
	private $category; //class
	private $status;

	//getters
	public function getID() : int {
		return $this->id;
	}

	public function getName() : string {
		return $this->name;
	}

	public function getCategory() : Category {
		return $this->category;
	}

	public function getStatus() : bool {
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

	public function setCategory(Category $category) {
		$this->category = $category;
	}

	public function setStatus(bool $status) {
		$this->status = $status;
	}
	//setters end
//main info end

//construct
	protected static function withArray(array $arr) : AbstractRecord {
		$obj = new self();

		$obj->id = $arr['id'];
		$obj->name = $arr['name'];
		$obj->status = $arr['status'];

		$category = Category::findFirst(array("id" => $arr['category_id']));
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