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

		$obj->id     = (int)  $arr['id'];
		$obj->count  = (int)  $arr['count'];
		$obj->status = (bool) $arr['status'];

		try {
			$size = Size::findFirst(array("id" => $arr['size_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['size_id'], "wrong id in db", $e));
		}
		$obj->size = $size;

		try {
			$color = Color::findFirst(array("id" => $arr['color_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['color_id'], "wrong id in db", $e));
		}
		$obj->color = $color;

		try {
			$product = Product::findFirst(array("id" => $arr['product_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['product_id'], "wrong id in db", $e));
		}
		$obj->product = $product;

		return $obj;
	}
//construct end

}