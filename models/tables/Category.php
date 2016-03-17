<?php

class Category extends AbstractTable {

	const TABLE = "category";

//main info
	private $id;
	private $name;
	private $short_name;
	private $description;
	private $image; //class
	private $parent; //class
	private $sort_order;
	private $status;

	//getters
	public function getID() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getShortName() {
		return $this->short_name;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getImage() {
		return $this->image;
	}

	public function getParent() {
		return $this->parent;
	}

	public function getSortOrder() {
		return $this->sort_order;
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

	public function setShortName(string $short_name) {
		if ($this->validator->checkShortName($short_name)) {
			$this->short_name = $short_name;
			return true;
		}
		return false;
	}

	public function setDescription(string $description) {
		if ($this->validator->checkDescription($description)) {
			$this->description = $description;
			return true;
		}
		return false;
	}

	public function setImage(Image $image) {
		if ($this->validator->checkImage($image)) {
			$this->image = $image;
			return true;
		}
		return false;
	}

	public function setParent(Category $parent = null) {
		if ($this->validator->checkParent($parent)) {
			$this->parent = $parent;
			return true;
		}
		return false;
	}

	public function setSortOrder(int $sort_order) {
		if ($this->validator->checkSortOrder($sort_order)) {
			$this->sort_order = $sort_order;
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
	//setters end;
//main info end

//link
	public function link() : string {
		$arr = array();
		for($i = $this; $i !== null; $i = $i->parent) {
			$arr[] = $i->short_name;
		}
		$arr = array_reverse($arr);
		$link = "/category/".implode("/", $arr);

		return $link;
	}
//link end

//construct
	public function __construct() {
		$this->validator = new CategoryValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id 			= $arr['id'];
		$obj->name 			= $arr['name'];
		$obj->short_name 	= $arr['short_name'];
		$obj->description 	= $arr['description'];
		$obj->sort_order 	= $arr['sort_order'];
		$obj->status 		= $arr['status'];

		$image = Image::findFirst(array("id" => $arr['image_id']));
		$obj->image = $image;

		$parent = ($arr['parent_id']) 
			? (Category::findFirst(array("id" => $arr['parent_id'])))
			: (null);
		$obj->parent = $parent;
		
		return $obj;
	}
//construct end

//static functions
	public static function getIDByShortNameArray(array $shortNameArray) {
		$id = 0;
		while($shortName = array_shift($shortNameArray)) {
			$query = "SELECT id 
				FROM category 
				WHERE parent_id = '$id' AND short_name = '$shortName' AND status = '1'";
			$result = DB::query($query);
			$result = $result->fetch();
			$id = array_shift($result);
		}
		return $id;
	}
//static functions end

}

class CategoryValidator extends AbstractValidator {

//const
	const CLASS_NAME = "Category";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";
	//lowercase латиница. 1-99 символов
	const SHORTNAME_PATTERN = "/^[a-z]{1,99}$/";

	const NAME_ERROR        = "Неправильный ввод имени";
	const SHORTNAME_ERROR   = "Неправильный ввод краткого имени";
	const DESCRIPTION_ERROR = "Неправильный ввод описания";
	const PARENT_ERROR      = "Передано неправильное значение в поле Parent";
	const SORTORDER_ERROR   = "Неправильный ввод порядка сортировки";
//const end

//check
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}

	public function checkShortName(string $name) : bool {
		$error = array("short_name" => self::SHORTNAME_ERROR);
		return parent::checkString($name, self::SHORTNAME_PATTERN, $error);
	}

	public function checkDescription(string $description) : bool {
		$error = array("description" => self::DESCRIPTION_ERROR);
		return parent::log(true, $error);
	}

	public function checkImage(Image $image) : bool {
		$error = array("image" => parent::IMAGE_OBJECT_ERROR);
		return parent::checkObject($image, $error);
	}

	public function checkParent(Category $parent = null) : bool {
		$error = array("parent" => self::PARENT_ERROR);
		if(is_null($parent)) {
			return parent::log(true, $error);
		}
		return parent::checkObject($parent, $error);
	}

	public function checkSortOrder(int $sort_order) : bool {
		$error = array("sort_order" => self::SORTORDER_ERROR);
		$bool = $sort_order > 0;
		return parent::log($bool, $error);
	}
//check end

}