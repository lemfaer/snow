<?php

class Available extends AbstractRecord {

	const TABLE = "available";

//validator
	private $validator;

	public function errorInfo() : array {
		return $this->validator->errorInfo();
	}
//validator end

//main info
	private $id;
	private $count;
	private $size; //class
	private $color; //class
	private $product; //class

	//getters
	public function getID() {
		return $this->id;
	}

	public function getCount() {
		return $this->count;
	}

	public function getSize() {
		return $this->size;
	}

	public function getColor() {
		return $this->color;
	}

	public function getProduct() {
		return $this->product;
	}
	//getters end

	//setters
	private function setID(int $id) : bool {
		if ($this->validator->checkID($id)) {
			$this->id = $id;
			return true;
		}
		return false;
	}

	public function setCount(int $count) : bool {
		if ($this->validator->checkCount($count)) {
			$this->count = $count;
			return true;
		}
		return false;
	}

	public function setSize(Size $size) {
		$this->size = $size;
	}

	public function setColor(Color $color) {
		$this->color = $color;
	}

	public function setProduct(Product $product) {
		$this->product = $product;
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new AvailableValidator();
	}

	protected static function withArray(array $arr) : AbstractRecord {
		$obj = new self();

		$obj->id 		= $arr['id'];
		$obj->count 	= $arr['count'];

		$size = Size::findFirst(array("id" => $arr['size_id']));
		$obj->size = $size;

		$color = Color::findFirst(array("id" => $arr['color_id']));
		$obj->color = $color;

		$product = Product::findFirst(array("id" => $arr['product_id']));
		$obj->product = $product;

		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}

	public function delete() {}
//abstract methods realization end

}

class AvailableValidator extends Validator {

//const
	const CLASS_NAME = "Available";
//const end

//check

//check end

}