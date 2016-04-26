<?php

class Category extends AbstractTable {

	const TABLE = "category";

//main info
	//protected $id
	private $name;
	private $short_name;
	private $description;
	private $image; //class
	private $parent; //class
	private $sort_order;
	//protected $status

	//getters
	public function getName() : string {
		return parent::get($this->name);
	}

	public function getShortName() : string {
		return parent::get($this->short_name);
	}

	public function getDescription() : string {
		return parent::get($this->description);
	}

	public function getImage() : Image {
		return parent::get($this->image);
	}

	public function getParent() : self {
		return parent::get($this->parent);
	}

	public function getSortOrder() : int {
		return parent::get($this->sort_order);
	}
	//getters end

	//setters
	public function setName(string $name) {
		$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
		$this->name = parent::set($name, "checkName");
	}

	public function setShortName(string $short_name) {
		$this->short_name = parent::set($short_name, "checkShortName");
	}

	public function setDescription(string $description) {
		$this->description = parent::set($description, "checkDescription");
	}

	public function setImage(Image $image) {
		$this->image = parent::set($image, "checkImage");
	}

	public function setParent(Category $parent) {
		$category = parent::set($parent, "checkParent");
		if(isset($this->id)) {
			if($this->validator->checkParentID($parent, $this->id)) {
				$this->parent = $parent;
			} else {
				throw new WrongDataException($parent, implode(", ", $this->errorInfo()));
			}
		} else {
			$this->parent = $parent;
		}
	}

	public function setSortOrder(int $sort_order) {
		$this->sort_order = parent::set($sort_order, "checkSortOrder");
	}
	//setters end;
//main info end

//link
	public function link() : string {
		$arr = array();
		for($i = $this; $i instanceof NullCategory; $i = $i->parent) {
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
		$this->parent = new NullCategory();
	}

	protected static function withArray(array $arr) : AbstractTable {
		if(!$arr['id']) {
			return new NullCategory();
		}
		
		$obj = new self();

		$obj->id          = (int)    $arr['id'];
		$obj->name        = (string) $arr['name'];
		$obj->short_name  = (string) $arr['short_name'];
		$obj->description = (string) $arr['description'];
		$obj->sort_order  = (int)    $arr['sort_order'];
		$obj->status      = (bool)   $arr['status'];

		try {
			$image = Image::findFirst(array("id" => $arr['image_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['image_id'], "wrong id in db", $e));
		}
		$obj->image = $image;

		try {
			$parent = ($arr['parent_id'])
				? (Category::findFirst(array("id" => $arr['parent_id']), true))
				: (new NullCategory());
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['parent_id'], "wrong id in db", $e));
		}
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

final class NullCategory extends Category {

	public function __construct() {
		$this->id = 0;
	}

	public function getID() : int {
		return $this->id;
	}

	public function getName() : string {
		return "no";
	}

	public function isNull() : bool {
		return true;
	}

	public function isSaved() : bool {
		return true;
	}

	protected function get($prop) {
		throw new NullAccessException();
	}

	protected function set($value, string $checkMethod) {
		throw new NullAccessException();
	}

	public function insert() {
		throw new NullAccessException();
	}

	public function update() {
		throw new NullAccessException();
	}

	public function delete() {
		throw new NullAccessException();
	}

	public function getArray() : array {
		return array("id" => $this->id);
	}

}