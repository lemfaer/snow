<?php

class Product extends AbstractRecord {

//main info
	private $id;
	private $name;
	private $producer; //class
	private $price;
	private $year;
	private $short_description;
	private $description;
	private $image;
	private $category; //class
	private $is_new;
	private $is_recomended;
	private $status;

	//getters
	public function getID() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getProducer() {
		return $this->producer;
	}
        
    public function getPrice() {
    	return $this->price;
    }

    public function getYear() {
		return $this->year;
    }

	public function getShortDescription() {
		return $this->short_description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getImage() {
		return $this->image;
	}

	public function getCategory() {
		return $this->category;
	}

	public function isNew() {
		return $this->is_new;
	}

	public function isRecomended() {
		return $this->is_recomended;
	}

	public function getStatus() {
		return $this->status;
	}
	//getters end

	//setters
	public function setName($name) {
		$this->name = $name;
	}

	public function setProducer(Producer $producer) {
		$this->producer = $producer;
	}

	public function setPrice($price) {
		$this->price = $price;
	}

	public function setYear($year) {
		$this->year = $year;
	}

	public function setShortDescription($short_description) {
		$this->short_description = $short_description;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setImage($image) {
		$this->image = $image;
	}

	public function setCategory(Category $category) {
		$this->category = $category;
	}

	public function setNew($is_new) {
		$this->is_new = $is_new;
	}

	public function setRecomended($is_recomended) {
		$this->is_recomended = $is_recomended;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
	//setters end
//main info end

//abstract methods realization
	public static function findFirst($where, $nullStatus = false) {
		$product = self::findFirstDefault(__CLASS__, "product", $where, $nullStatus);
		return $product;
	}

	public static function findAll($where, $limit, $offset, $order = "id", $nullStatus = false) {
		$productList = self::findAllDefault(__CLASS__, "product", $where, $limit, $offset, 
			$order, $nullStatus);
		return $productList;
	}

	public function insert() {}

	public function update() {}
	
	public function delete() {}

	public function getArray() {
		$arr = array();
		$arr['id']					= $this->id;
		$arr['name']				= $this->name;
		$arr['producer']			= $this->producer->getArray();
		$arr['price']				= $this->price;
		$arr['year']				= $this->year;
		$arr['short_description']	= $this->short_description;
		$arr['description']			= $this->description;
		$arr['image']				= $this->image;
		$arr['category']			= $this->category->getArray();
		$arr['is_new']				= $this->is_new;
		$arr['is_recomended']		= $this->is_recomended;
		$arr['status']				= $this->status;
		return $arr;
	}

	protected function setByArray($arr) {
		$this->id 					= $arr['id'];
		$this->name					= $arr['name'];
		$this->price				= $arr['price'];
		$this->year					= $arr['year'];
		$this->short_description	= $arr['short_description'];
		$this->description			= $arr['description'];
		$this->image				= $arr['image'];
		$this->is_new				= $arr['is_new'];
		$this->is_recomended		= $arr['is_recomended'];
		$this->status				= $arr['status'];

		$this->category	= Category::findFirst("id = {$arr['category_id']}"); //class
		$this->producer	= Producer::findFirst("id = {$arr['producer_id']}"); //class

		return $this;
	}
//abstract methods realization end

}
