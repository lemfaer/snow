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
	public function getID() : int {
		return parent::get($this->id);
	}

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

	public function getParent() { //can be null
		return $this->parent;
	}

	public function getSortOrder() : int {
		return parent::get($this->sort_order);
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

	public function setShortName(string $short_name) {
		$this->short_name = parent::set($short_name, $this->validator->checkShortName);
	}

	public function setDescription(string $description) {
		$this->description = parent::set($description, $this->validator->checkDescription);
	}

	public function setImage(Image $image) {
		$this->image = parent::set($image, $this->validator->checkImage);
	}

	public function setParent(Category $parent = null) {
		if(!is_null($parent)) { // can be null
			$this->parent = parent::set($parent, $this->validator->checkParent);
		} else {
			$this->parent = null;
		}
	}

	public function setSortOrder(int $sort_order) {
		$this->sort_order = parent::set($sort_order, $this->validator->checkSortOrder);
	}

	public function setStatus(bool $status) {
		$this->status = parent::set($status, $this->validator->checkStatus);
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

		$obj->id          = $arr['id'];
		$obj->name        = $arr['name'];
		$obj->short_name  = $arr['short_name'];
		$obj->description = $arr['description'];
		$obj->sort_order  = $arr['sort_order'];
		$obj->status      = $arr['status'];

		$image      = Image::findFirst(array("id" => $arr['image_id']));
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