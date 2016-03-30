<?php

class AvailableValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Available";

	const COUNT_LIMIT = 1000;
	const COUNT_ERROR = "Неправильный ввод количества товаров";
//const end

//validate methods
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
//validate methods end
	
}