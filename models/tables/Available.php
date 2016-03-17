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
	protected function setID(int $id) : bool {
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

	public function setSize(Size $size) : bool {
		if ($this->validator->checkSize($size)) {
			$this->size = $size;
			return true;
		}
		return false;
	}

	public function setColor(Color $color) : bool {
		if ($this->validator->checkColor($color)) {
			$this->color = $color;
			return true;
		}
		return false;
	}

	public function setProduct(Product $product) : bool {
		if ($this->validator->checkProduct($product)) {
			$this->product = $product;
			return true;
		}
		return false;
	}

	public function setStatus(bool $status) : bool {
		if($this->validator->checkStatus($status)) {
			$this->status = $status;
			return true;
		}
		return false;
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