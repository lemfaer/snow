<?php

class CharName extends AbstractTable {

	const TABLE = "char_name";

//main info
	//protected $id
	private $name;
	private $category; //class
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
		$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
		$this->name = parent::set($name, "checkName");
	}

	public function setCategory(Category $category) {
		$this->category = parent::set($category, "checkCategory");
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new CharNameValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = (int)    $arr['id'];
		$obj->name   = (string) $arr['name'];
		$obj->status = (bool)   $arr['status'];

		try {
			$category = Category::findFirst(array("id" => $arr['category_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['category_id'], "wrong id in db", $e));
		}
		$obj->category = $category;

		return $obj;
	}
//construct end

}