<?php

class Available extends AbstractRecord {

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

//abstract methods realization
	public static function findFirst($where, $nullStatus = true) {
		$color = self::findFirstDefault(__CLASS__, "aviable", $where, $nullStatus);
		return $color;
	}

	public static function findAll($where, $limit, $offset, $order = "id", $nullStatus = true) {
		$colorList = self::findAllDefault(__CLASS__, "aviable", $where, $limit, $offset, 
			$order, $nullStatus);
		return $colorList;
	}

	public function insert() {}

	public function update() {}

	public function delete() {}

	public function getArray() {
		$arr = array();
		$arr['id'] 		= $this->id;
		$arr['count'] 	= $this->count;
		$arr['size'] 	= $this->size->getArray();
		$arr['color'] 	= $this->color->getArray();
		$arr['product'] = $this->product->getArray();

		return $arr;
	}

	protected function setByArray($arr) {
		$this->id 		= $arr['id'];
		$this->count	= $arr['count'];

		$this->size = Size::findFirst("id = {$arr['size_id']}");
		$this->color = Color::findFirst("id = {$arr['color_id']}");
		//$this->product = Product::findFirst("id = {$arr['product_id']}");
	}
//abstract methods realization end

}