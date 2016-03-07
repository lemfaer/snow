<?php

class Category extends AbstractRecord {

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
	private function setID($id) {
		$this->id = $id;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function setShortName($short_name) {
		$this->short_name = $short_name;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setImage(Image $image) {
		$this->image = $image;
	}

	public function setParent(Parent $parent) {
		$this->parent = $parent;
	}

	public function setSortOrder($sort_order) {
		$this->sort_order = $sort_order;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
	//setters end;
//main info end

//link
	public function link() {
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
	protected function withArray($arr) {
		$obj = new self();

		$obj->id 			= $arr['id'];
		$obj->name 			= $arr['name'];
		$obj->short_name 	= $arr['short_name'];
		$obj->description 	= $arr['description'];
		$obj->sort_order 	= $arr['sort_order'];
		$obj->status 		= $arr['status'];

		$image = Image::findFirst("id = {$arr['image_id']}");
		$obj->image = $image;

		$parent = ($arr['parent_id']) 
			? (Category::findFirst("id = {$arr['parent_id']}"))
			: (null);
		$obj->parent = $parent;
		
		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}
	
	public function delete() {}

	public function getArray() {
		$arr = parent::getArray();
		unset($arr['parent']);
		$arr['parent_id'] = (is_object($this->parent)) ? ($parent->getID()) : (0);
		return $arr;
	}
//abstract methods realization end

//static functions
	public static function getIDByShortNameArray($shortNameArray) {
		$id = 0;
		while($shortName = array_shift($shortNameArray)) {
			$query = "SELECT id 
				FROM category 
				WHERE parent_id = '$id' AND short_name = '$shortName' AND status = '1'";
			$result = DB::query($query);
			$id = array_shift($result->fetch());
		}
		return $id;
	}
//static functions end

}