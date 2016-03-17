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

	public function getStatus() {
		return $this->status;
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

class AvailableValidator extends AbstractValidator {

//const
	const CLASS_NAME = "Available";

	const COUNT_LIMIT = 1000;
	const COUNT_ERROR = "Неправильный ввод количества товаров";
//const end

//check
	public function checkCount(int $count) : bool {
		$error = array("count" => self::COUNT_ERROR);
		$bool = $count < self::COUNT_LIMIT;
		return parent::log($bool, $error);
	}

	public function checkSize(Size $size) : bool {
		$error = array("size" => parent::SIZE_OBJECT_ERROR);
		return parent::checkObject($size, $error);
	}

	public function checkColor(Color $color) : bool {
		$error = array("color" => parent::COLOR_OBJECT_ERROR);
		return parent::checkObject($color, $error);
	}

	public function checkProduct(Product $product) : bool {
		$error = array("product" => parent::PRODUCT_OBJECT_ERROR);
		return parent::checkObject($product, $error);
	}
//check end

}