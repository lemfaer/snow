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
	private function setID($id) {
		$this->id = $id;
	}

	public function setCount($count) {
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
	protected function withArray($arr) {
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
	public static function findFirst(array $whereArr, $nullStatus = true) {
		return parent::findFirst($whereArr, $nullStatus);
	}

	public static function findCount(array $whereArr, $nullStatus = true) {
		return parent::findCount($whereArr, $nullStatus);
	}

	public static function findAll(array $whereArr, $order = "id ASC", $limit = self::LIMIT_MAX, $offset = 0, $nullStatus = true) {
		return parent::findAll($whereArr, $order, $limit, $offset, $nullStatus);
	} 

	public function insert() {}

	public function update() {}

	public function delete() {}
//abstract methods realization end

}