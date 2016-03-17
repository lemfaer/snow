<?php

class CharName extends AbstractTable {

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
	protected function setID(int $id) : bool {
		if ($this->validator->checkID($id)) {
			$this->id = $id;
			return true;
		}
		return false;
	}

	public function setName(string $name) {
		if ($this->validator->checkName($name)) {
			$this->name = $name;
			return true;
		}
		return false;
	}

	public function setCategory(Category $category) {
		if ($this->validator->checkCategory($category)) {
			$this->category = $category;
			return true;
		}
		return false;
	}

	public function setStatus(bool $status) {
		if ($this->validator->checkStatus($status)) {
			$this->status = $status;
			return true;
		}
		return false;
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new CharNameValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id = $arr['id'];
		$obj->name = $arr['name'];
		$obj->status = $arr['status'];

		$category = Category::findFirst(array("id" => $arr['category_id']));
		$obj->category = $category;

		return $obj;
	}
//construct end

}

class CharNameValidator extends AbstractValidator {

//const
	const CLASS_NAME = "CharName";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const NAME_ERROR = "Неправильный ввод имени";
//const end

//check
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}
	
	public function checkCategory(Category $category) : bool {
		$error = array("category" => parent::CATEGORY_OBJECT_ERROR);
		return parent::checkObject($category, $error);
	}
//check end

}