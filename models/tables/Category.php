<?php

class Category extends AbstractRecord {

//main info
	private $id;
	private $name;
	private $short_name;
	private $description;
	private $image;
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
	public function setName($name) {
		$this->name = $name;
	}

	public function setShortName($short_name) {
		$this->short_name = $short_name;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setImage($image) {
		$this->image = $image;
	}

	public function setParent(Category $parent) {
		$this->parent = $parent;
	}

	public function setSortOrder($sort_order) {
		$this->sort_order = $sort_order;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
	//setters end;

	//link
	private $link;

	public function link() {
		if(!isset($link)) {
			$this->setLink();
		}
		return $this->link;
	}

	private function setLink() {
		$arr = array();
		for($i = $this; $i !== null; $i = $i->parent) {
			$arr[] = $i->short_name;
		}
		$arr = array_reverse($arr);
		$this->link = "/category/".implode("/", $arr);
	}
	//link end
//main info end

//abstract methods realization
	public static function findFirst($where, $nullStatus = false) {
		$category = self::findFirstDefault(__CLASS__, "category", $where, $nullStatus);
		return $category;
	}

	public static function findAll($where, $limit = self::LIMIT_MAX, $offset = 0, $order = "id", $nullStatus = false) {
		$categoryList = self::findAllDefault(__CLASS__, "category", $where, $limit, $offset, 
			$order, $nullStatus);
		return $categoryList;
	}

	public function insert() {}

	public function update() {}
	
	public function delete() {}

	public function getArray() {
		$arr = array();

		$arr['id'] 				= $this->id;
		$arr['name'] 			= $this->name;
		$arr['short_name'] 		= $this->short_name;
		$arr['description'] 	= $this->description;
		$arr['image'] 			= $this->image;
		$arr['sort_order'] 		= $this->sort_order;
		$arr['status'] 			= $this->status;
		$arr['parent'] 			= ($this->parent) ? ($this->parent->getArray()) : (null); //class

		return $arr;
	}

	protected function setByArray($arr) {
		$this->id 			= $arr['id'];
		$this->name 		= $arr['name'];
		$this->short_name 	= $arr['short_name'];
		$this->description 	= $arr['description'];
		$this->image 		= $arr['image'];
		$this->sort_order 	= $arr['sort_order'];
		$this->status 		= $arr['status'];


		$this->parent = ($arr['parent_id']) 
			? (self::findFirst("id = {$arr['parent_id']}")) 
			: (null); //class
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