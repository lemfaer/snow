<?php

class Size extends AbstractTable {

	const TABLE = "size";

//main info
	//protected $id
	private $name;
	private $category;
	//protected $status

	//getters
	public function getName() : string {
		return parent::get($this->name);
	}

	public function getCategory() : Category {
		return parent::get($this->category);
	}
	//getters end

	//setters
	public function setName(string $name) {
		$name = mb_convert_case($name, MB_CASE_UPPER, "UTF-8");
		$this->name = parent::set($name, $this->validator->checkName);
	}

	public function setCategory(Category $category) {
		$this->category = parent::set($category, $this->validator->checkCategory);
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new SizeValidator();
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