<?php

class Available extends AbstractTable {

	const TABLE = "available";

//main info
	private $id;
	private $count;
	private $size; //class
	private $color; //class
	private $product; //class
	private $status;

	//getters
	public function getID() : int {
		return parent::get($this->id);
	}

	public function getCount() : int {
		return parent::get($this->count);
	}

	public function getSize() : Size {
		return parent::get($this->size);
	}

	public function getColor() : Color {
		return parent::get($this->color);
	}

	public function getProduct() : Product {
		return parent::get($this->product);
	}

	public function getStatus() : bool {
		return parent::get($this->status);
	}
	//getters end

	//setters
	protected function setID(int $id) {
		$this->id = parent::set($id, $this->validator->checkID);
	}

	public function setCount(int $count) {
		$this->count = parent::set($count, $this->validator->checkCount);
	}

	public function setSize(Size $size) {
		$this->size = parent::set($size, $this->validator->checkSize);
	}

	public function setColor(Color $color) {
		$this->color = parent::set($color, $this->validator->checkColor);
	}

	public function setProduct(Product $product) {
		$this->product = parent::set($product, $this->validator->checkProduct);
	}

	public function setStatus(bool $status) {
		$this->status = parent::set($status, $this->validator->checkStatus);
	} 
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new AvailableValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id    = $arr['id'];
		$obj->count = $arr['count'];

		$size      = Size::findFirst(array("id" => $arr['size_id']));
		$obj->size = $size;

		$color      = Color::findFirst(array("id" => $arr['color_id']));
		$obj->color = $color;

		$product      = Product::findFirst(array("id" => $arr['product_id']));
		$obj->product = $product;

		return $obj;
	}
//construct end

}