<?php

class Product extends AbstractRecord {

	const TABLE = "product";

//main info
	private $id;
	private $name;
	private $producer; //class
	private $price;
	private $year;
	private $short_description;
	private $description;
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
	private function setID($id) {
		$this->id = $id;
	}

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

//available
	private $available;

	public function isAvailable() {
		return $this->available;
	}

	private function available() {
		$avCount = Available::findCount("product_id = $this->id");
		$this->available = $avCount == true;
	}
//available end

//first image
	private $firstImage;

	public function getImage() {
		return $this->firstImage;
	}

	private function firstImage() {
		$query = "SELECT image_id FROM product_has_image WHERE product_id = $this->id LIMIT 1";
		$id = array_shift(DB::query($query)->fetch());
		$this->firstImage = Image::findFirst("id = $id");
	}
//first image end

//construct
	protected function withArray($arr) {
		$obj = new self();

		$obj->id 					= $arr['id'];
		$obj->name					= $arr['name'];
		$obj->price					= $arr['price'];
		$obj->year					= $arr['year'];
		$obj->short_description		= $arr['short_description'];
		$obj->description			= $arr['description'];
		$obj->is_new				= $arr['is_new'];
		$obj->is_recomended			= $arr['is_recomended'];
		$obj->status				= $arr['status'];

		$category = Category::findFirst("id = {$arr['category_id']}");
		$obj->category	= $category; //class

		$producer = Producer::findFirst("id = {$arr['producer_id']}");
		$obj->producer	= $producer; //class

		$obj->available();
		$obj->firstImage();

		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}
	
	public function delete() {}
//abstract methods realization end

}
