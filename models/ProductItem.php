<?php

class ProductItem extends AbstractRecord {

	const LIMIT_CHAR = 10;
	const LIMIT_IMAGE = 5;
	const LIMIT_COLOR = 20;
	const LIMIT_SIZE = 20;

//product
	private $product;

	public function getProduct() {
		return $this->product;
	}

	public function setProduct(Product $product) {
		$this->product = $product;
	}
//product end

//char list
	private $charList;

	public function getCharList() {
		return $this->charList;
	}

	public function setCharList($charList) {
		$this->charList = $charList;
	}

	private function charList() {
		$charList = array();
		$id = $this->product->getID();
		$query = "SELECT count(value_id) FROM product_has_value WHERE product_id = '$id'";
		$result = DB::query($query);

		if(array_shift($result->fetch())) {
			$query = "SELECT value_id FROM product_has_value WHERE product_id = '$id'";
			$result = DB::query($query);

			$arrID = array();
			while($id = $result->fetch()) {
				$id = array_shift($id);
				$arrID[] = $id;
			}

			$valueIDString = implode(",", $arrID);
			$charList = Characteristic::findAll("id IN($valueIDString)", "id ASC", self::LIMIT_CHAR);
		}

		$this->charList = $charList;
	} 
//char list end

//image list
	private $imageList;

	public function getImageList() {
		return $this->imageList;
	}

	public function setImageList($imageList) {
		$this->imageList = $imageList;
	}

	private function imageList() {
		$id = $this->product->getID();
		$query = "SELECT count(*) FROM product_has_image WHERE product_id = $id";
		$result = DB::query($query);

		$imageList = array();
		if(array_shift($result->fetch())) {
			$query = "SELECT image_id FROM product_has_image WHERE product_id = $id";
			$result = DB::query($query);

			$imageIDArray = array();
			while($id = $result->fetch()) {
				$id = array_shift($id);
				$imageIDArray[] = $id;
			}
			$imageIDString = implode(",", $imageIDArray);
			
			$imageList = Image::findAll("id IN($imageIDString)", "id ASC", self::LIMIT_IMAGE);
			array_shift($imageList);
		}

		array_unshift($imageList, $this->product->getImage());

		$this->imageList = $imageList;
	}
//image list end

//available list
	private $availableList;

	public function getAvailableList() {
		return $this->availableList;
	}

	public function setAvailableList($availableList) {
		$this->availableList = $availableList;
	}

	private function availableList() {
		$availableList = array();

		if($this->product->isAvailable()) {
			$id = $this->product->getID();
			$availableList = Available::findAll("product_id = $id", "id ASC", self::LIMIT_MAX);
		}

		$this->availableList = $availableList;
	} 
//available list end

//color list with size ids
	private $colorList;

	public function getColorList() {
		return $this->colorList;
	}

	private function colorList() {
		if(!$this->product->isAvailable()) {
			$this->colorList = array();
			return;
		}

		foreach ($this->availableList as $av) {
			$colorIDArray[] = $av->getColor()->getID();
		}
		$colorIDArray = array_unique($colorIDArray);
		$colorIDString = implode(",", $colorIDArray);

		$colorList = Color::findAll("id IN($colorIDString)", "name ASC", self::LIMIT_COLOR);
		foreach ($colorList as $key => $color) {
			$colorList[$key] = array(
				"color" => $color,
				"size_id" => array()
			); 
		}
		foreach ($this->availableList as $av) {
			foreach ($colorList as $key => $value) {
				if($av->getColor()->getID() === $value['color']->getID()) {
					$colorList[$key]['size_id'][] = $av->getSize()->getID();
				}
			}
		}

		$this->colorList = $colorList;
	}
//color list with size ids end

//size list with color ids
	private $sizeList;

	public function getSizeList() {
		return $this->sizeList;
	}

	private function sizeList() {
		if(!$this->product->isAvailable()) {
			$this->sizeList = array();
			return;
		}

		foreach ($this->availableList as $av) {
			$sizeIDArray[] = $av->getSize()->getID();
		}
		$sizeIDArray = array_unique($sizeIDArray);
		$sizeIDString = implode(",", $sizeIDArray);

		$sizeList = Size::findAll("id IN($sizeIDString)", "name ASC", self::LIMIT_SIZE);
		foreach ($sizeList as $key => $size) {
			$sizeList[$key] = array(
				"size" => $size,
				"color_id" => array()
			); 
		}
		foreach ($this->availableList as $av) {
			foreach ($sizeList as $key => $value) {
				if($av->getSize()->getID() === $value['size']->getID()) {
					$sizeList[$key]['color_id'][] = $av->getColor()->getID();
				}
			}
		}

		$this->sizeList = $sizeList;
	}
//size list with color ids end

//construct
	public function __construct($product) {
		$this->product = $product;
		
		$this->charList 		= array();
		$this->imageList 		= array();
		$this->availableList 	= array();
		$this->colorList 		= array();
		$this->sizeList 		= array();

		if($this->product->getID()) {
			$this->charList();
			$this->imageList();
			$this->availableList();
			$this->colorList();
			$this->sizeList();
		}
	}
//construct end

//abstract methods realization
	public static function findFirst($where, $nullStatus = false) {
		$product = Product::findFirst($where, $nullStatus);
		$productItem = new ProductItem($product);
		return $productItem;
	}

	public static function findCount($where, $nullStatus = false) {
		return Product::findCount($where, $nullStatus);
	} 

	public static function findAll($where, $order = "id", $limit = self::LIMIT_MAX, $offset = 0, $nullStatus = false) {
		$productList = Product::findAll($where, $order, $limit, $offset, $nullStatus);
		foreach ($productList as $key => $product) {
			$productList[$key] = new ProductItem($product);
		}
		return $productList;
	}

	public function insert() {}

	public function update() {}
	
	public function delete() {}
//abstract methods realization end

}