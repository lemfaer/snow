<?php

class CharName extends AbstractTable {

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
		return parent::get($this->name);
	}

	public function getCategory() : Category {
		return parent::get($this->category);
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

	public function setCategory(Category $category) {
		$this->category = parent::set($category, $this->validator->checkCategory);
	}

	public function setStatus(bool $status) {
		$this->status = parent::set($status, $this->validator->checkStatus);
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new CharNameValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = $arr['id'];
		$obj->name   = $arr['name'];
		$obj->status = $arr['status'];

		$category      = Category::findFirst(array("id" => $arr['category_id']));
		$obj->category = $category;

		return $obj;
	}
//construct end

}