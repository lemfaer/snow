<?php

class ProductItemValidator extends AbstractValidator {

//const
	const IMAGELIST_CLASS_ERROR = 
		"Переданный массив содержит не обьекты класса Image";
	const COLORLIST_CLASS_ERROR = 
		"Переданный массив содержит не обьекты класса Color";
	const CHARLIST_CLASS_ERROR = 
		"Переданный массив содержит не обьекты класса CharValue";
	const AVAILABLELIST_CLASS_ERROR = 
		"Переданный массив содержит не обьекты класса Available";

	const AVAILABLE_EXISTS_ERROR = 
		"Один или несколько переданных обьектов Available уже в базе данных";
	const AVAILABLE_DATA_ERROR = 
		"Один или несколько переданных обьектов Available не содержат необходимых данных";
//const end

//validate methods

	public function checkProduct(Product $product) : bool {
		$error = array("product" => parent::PRODUCT_OBJECT_ERROR);
		return parent::checkObject($product, $error);
	}

	public function checkImageList(array $imageList) : bool {
		$errorClass  = array("imageList" => self::IMAGELIST_CLASS_ERROR);
		$errorObject = array("imageList" => parent::IMAGE_OBJECT_ERROR);
		foreach ($imageList as $image) {
			if(!parent::checkClass($image, "Image", $errorClass) or 
				!parent::checkObject($image, $errorObject)) {
				return false;
			}
		}

		return parent::log(true, array("imageList" => ""));
	}

	public function checkCharList(array $charList) : bool {
		$errorClass  = array("charList" => self::CHARLIST_CLASS_ERROR);
		$errorObject = array("charList" => parent::CHARVALUE_OBJECT_ERROR);
		foreach ($charList as $char) {
			if(!parent::checkClass($char, "CharValue", $errorClass) or 
				!parent::checkObject($char, $errorObject)) {
				return false;
			}
		}

		return parent::log(true, array("charList" => ""));
	}

	public function checkColorList(array $colorList) : bool {
		$errorClass  = array("colorList" => self::COLORLIST_CLASS_ERROR);
		$errorObject = array("colorList" => parent::COLOR_OBJECT_ERROR);
		foreach ($colorList as $color) {
			if(!parent::checkClass($color, "Color", $errorClass) or 
				!parent::checkObject($color, $errorObject)) {
				return false;
			}
		}

		return parent::log(true, array("colorList" => ""));
	}

	public function checkAvailableList(array $availableList) : bool {
		$errorClass  = array("availableList" => self::AVAILABLELIST_CLASS_ERROR);
		$errorObject = array("availableList" => parent::AVAILABLE_OBJECT_ERROR);
		foreach ($availableList as $av) {
			if(!parent::checkClass($av, "Available", $errorClass)) {
				return false;
			}

			try {
				$av->getSize();
				$av->getColor();
				$av->getCount();
			} catch(NullAccessException $e) {
				return parent::log(false,
					array("availableList" => self::AVAILABLE_DATA_ERROR));
			}

			if($av->isSaved()) {
				return parent::log(false, 
					array("availableList" => self::AVAILABLE_EXISTS_ERROR));
			}
		}

		return parent::log(true, array("availableList" => ""));
	}

//validate methods end

}
