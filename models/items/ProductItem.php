<?php

class ProductItem extends AbstractRecord {

	const LIMIT_CHAR = 10;
	const LIMIT_IMAGE = 5;
	const LIMIT_COLOR = 20;
	const LIMIT_SIZE = 20;

//product
	private $product;

	public function getProduct() : Product {
		return $this->product;
	}

	public function setProduct(Product $product) {
		$this->product = $product;
	}
//product end

//char list
	private $charList;

	public function getCharList() : array {
		return $this->charList;
	}

	public function setCharList(array $charList) {
		$this->charList = $charList;
	}

	private function charList() {
		$id = $this->product->getID();
		$query = "SELECT value_id FROM product_has_value WHERE product_id = '$id'";
		
		try {
			$result = DB::query($query);
		} catch(Exception $e) {
			return;
		}

		$charIDArray = array();
		while($id = $result->fetch()) {
			$id = array_shift($id);
			$charIDArray[] = $id;
		}

		try {
			$charList = CharValue::findAll(array("id" => $arr), "id ASC");
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr, "wrong id in db"), $e);
		}
		$this->charList = $charList;
	} 
//char list end

//image list
	private $imageList;

	public function getImageList() : array {
		return $this->imageList;
	}

	public function setImageList(array $imageList) {
		$this->imageList = $imageList;
	}

	private function imageList() {
		$id = $this->product->getID();
		$query = "SELECT image_id FROM product_has_image WHERE product_id = $id";

		try {
			$result = DB::query($query);
		}
		catch(Exception $e) {
			$this->imageList = array($this->product->getImage());
			return;
		}

		$imageIDArray = array();
		while($id = $result->fetch()) {
			$id = array_shift($id);
			$imageIDArray[] = $id;
		}
			
		$imageList = Image::findAll(array("id" => $imageIDArray), "id ASC", self::LIMIT_IMAGE);

		$this->imageList = $imageList;
	}
//image list end

//available list
	private $availableList;

	public function getAvailableList() : array {
		return $this->availableList;
	}

	public function setAvailableList(array $availableList) {
		$this->availableList = $availableList;
	}

	private function availableList() {
		$availableList = array();

		if($this->product->isAvailable()) {
			$id = $this->product->getID();
			$availableList = Available::findAll(array("product_id" => $id), 
				"id ASC", self::LIMIT_MAX);
			foreach ($availableList as $key => $av) {
				if($av->getCount() < 1) {
					unset($availableList[$key]);
				}
			}
		}

		$this->availableList = $availableList;
	} 
//available list end

//color list with size ids
	private $colorList;

	public function getColorList() : array {
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

		$colorList = Color::findAll(array("id" => $colorIDArray), "name ASC", self::LIMIT_COLOR);
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

	public function getSizeList() : array {
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

		$sizeList = Size::findAll(array("id" => $sizeIDArray), "name ASC", self::LIMIT_SIZE);
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
	public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int {
		return Product::findCount($whereArr, $nullStatus);
	} 

	public static function findFirst(array $whereArr = array(), bool $nullStatus = false) : AbstractRecord {
		$product = Product::findFirst($whereArr, $nullStatus);
		$productItem = new ProductItem($product);
		return $productItem;
	}

	public static function findAll(array $whereArr = array(), string $order = "id", int $limit = self::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array {
		$productList = Product::findAll($whereArr, $order, $limit, $offset, $nullStatus);
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