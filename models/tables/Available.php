<?php

class Available extends AbstractRecord {

	const TABLE = "available";

//main info
	private $id;
	private $count;
	private $size; //class
	private $color; //class
	private $product; //class

	//getters
	public function getID() : int {
		return $this->id;
	}

	public function getCount() : int {
		return $this->count;
	}

	public function getSize() : Size {
		return $this->size;
	}

	public function getColor() : Color {
		return $this->color;
	}

	public function getProduct() : Product {
		return $this->product;
	}
	//getters end

	//setters
	private function setID(int $id) {
		$this->id = $id;
	}

	public function setCount(int $count) {
		$this->count = $count;
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