<?php

class ProductItem extends AbstractRecord {

	const LIMIT_CHAR = 10;
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
			$charList = Characteristic::findAll("id IN($valueIDString)", self::LIMIT_CHAR, 0);
		}

		$this->charList = $charList;
	} 
//char list end

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
			$availableList = Available::findAll("product_id = $id", 9999, 0);
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
		$colorList = array();
		if(!$this->product->isAvailable()) {
			$this->colorList = $colorList;
			return;
		}

		foreach ($this->availableList as $av) {
			$colorIDArray[] = $av->getColor()->getID();
		}
		$colorIDArray = array_unique($colorIDArray);
		$colorIDString = implode(",", $colorIDArray);

		$colorList = Color::findAll("id IN($colorIDString)", self::LIMIT_COLOR, 0, "name");
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
		$sizeList = array();
		if(!$this->product->isAvailable()) {
			$this->sizeList = $sizeList;
			return;
		}

		foreach ($this->availableList as $av) {
			$sizeIDArray[] = $av->getSize()->getID();
		}
		$sizeIDArray = array_unique($sizeIDArray);
		$sizeIDString = implode(",", $sizeIDArray);

		$sizeList = Size::findAll("id IN($sizeIDString)", self::LIMIT_COLOR, 0, "name");
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

//constructor
	public function __construct($product) {
		$this->product = $product;
		$this->charList();
		$this->availableList();
		$this->colorList();
		$this->sizeList();
	}
//constructor end

//abstract methods realization
	public static function findFirst($where, $nullStatus = false) {
		$product = Product::findFirst($where, $nullStatus);
		$productItem = new ProductItem($product);
		return $productItem;
	}

	public static function findAll($where, $limit = self::LIMIT_MAX, $offset = 0, $order = "id", $nullStatus = false) {
		$productList = Product::findAll($where, $limit, $offset, $order, $nullStatus);
		foreach ($productList as $key => $product) {
			$productList[$key] = new ProductItem($product);
		}
		return $productList;
	}

	public function insert() {}

	public function update() {}
	
	public function delete() {}

	public function getArray() {}

	protected function setByArray($arr) {		
		throw new Exception("unsupported", 1);
	}
//abstract methods realization end

}