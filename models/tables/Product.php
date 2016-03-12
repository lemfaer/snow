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
	private function setID(int $id) {
		$this->id = $id;
	}

	public function setName(string $name) {
		$this->name = $name;
	}

	public function setProducer(Producer $producer) {
		$this->producer = $producer;
	}

	public function setPrice(int $price) {
		$this->price = $price;
	}

	public function setYear(int $year) {
		$this->year = $year;
	}

	public function setShortDescription(string $short_description) {
		$this->short_description = $short_description;
	}

	public function setDescription(string $description) {
		$this->description = $description;
	}

	public function setCategory(Category $category) {
		$this->category = $category;
	}

	public function setNew(bool $is_new) {
		$this->is_new = $is_new;
	}

	public function setRecomended(bool $is_recomended) {
		$this->is_recomended = $is_recomended;
	}

	public function setStatus(bool $status) {
		$this->status = $status;
	}
	//setters end
//main info end

//available
	public function isAvailable() : bool {
		$avCount = Available::findCount(array("product_id" => $this->id));
		return $avCount == true;
	}
//available end

//first image
	public function getImage() : Image {
		try {
			$query = "SELECT image_id FROM product_has_image WHERE product_id = $this->id LIMIT 1";
			$result = DB::query($query);
			$result = $result->fetch();
			$id = array_shift($result);
			return Image::findFirst(array("id" => $id));
		} catch(Exception $e) {
			$image = new Image();
			$image->setPath("http://i65.tinypic.com/k6ey0.gif");
			return $image;
		}
	}
//first image end

//construct
	protected static function withArray(array $arr) : AbstractRecord {
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

		$category = Category::findFirst(array("id" => $arr['category_id']));
		$obj->category	= $category; //class

		$producer = Producer::findFirst(array("id" => $arr['producer_id']));
		$obj->producer	= $producer; //class

		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}
	
	public function delete() {}
//abstract methods realization end

}
