<?php

class AvailableValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Available";

	const COUNT_LIMIT = 1000;
	const COUNT_ERROR = "Неправильный ввод количества товаров";
//const end

//closures
	private $checkCount;
	private $checkSize;
	private $checkColor;
	private $checkProduct;
//closures end

	public function __construct() {
		parent::__construct();

		$this->checkCount = function(int $count) : bool {
			$error = array("count" => self::COUNT_ERROR);
			$bool = $count < self::COUNT_LIMIT;
			return parent::log($bool, $error);
		};

		$this->checkSize = function(Size $size) : bool {
			$error = array("size" => parent::SIZE_OBJECT_ERROR);
			return parent::checkObject($size, $error);
		};

		$this->checkColor = function(Color $color) : bool {
			$error = array("color" => parent::COLOR_OBJECT_ERROR);
			return parent::checkObject($color, $error);
		};

		$this->checkProduct = function(Product $product) : bool {
			$error = array("product" => parent::PRODUCT_OBJECT_ERROR);
			return parent::checkObject($product, $error);
		};
	}
	
}