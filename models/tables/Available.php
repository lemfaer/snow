<?php

class Available extends AbstractTable {

	const TABLE = "available";

//main info
	//protected $id
	private $count;
	private $size; //class
	private $color; //class
	private $product; //class
	//protected $status

	//getters
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
	//getters end

	//setters
	public function setCount(int $count) {
		$this->count = parent::set($count, "checkCount");
	}

	public function setSize(Size $size) {
		$this->size = parent::set($size, "checkSize");
	}

	public function setColor(Color $color) {
		$this->color = parent::set($color, "checkColor");
	}

	public function setProduct(Product $product) {
		$this->product = parent::set($product, "checkProduct");
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new AvailableValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id    = (int) $arr['id'];
		$obj->count = (int) $arr['count'];

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