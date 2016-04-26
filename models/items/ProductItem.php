<?php

class ProductItem extends AbstractRecord {

//set
	/**
	 * Выполняет действия перед установкой значений в свойства
	 * 
	 * @param mixed $value переданное значение
	 * @param string $checkMethod метод для проверки переданного значения
	 * @throws WrongDataException передано неправильное значение
	 * @return mixed (type of $value) переданное значение
	 */
	private $product;
	private $charList  = array();
	private $imageList = array();
	private $colorList = array();
	private $sizeList  = array();
	private $availableList = array();

	//getters
	public function getProduct() : Product {
		return parent::get($this->product);
	}

	public function getCharList() : array {
		return parent::get($this->charList);
	}

	public function getImageList() : array {
		return parent::get($this->imageList);
	}

	public function getAvailableList() : array {
		return parent::get($this->availableList);
	}

	public function getColorList() : array {
		return parent::get($this->colorList);
	}

	public function getSizeList() : array {
		return parent::get($this->sizeList);
	}
	//getters end

	//setters
	public function setProduct(Product $product) {
		$this->product = parent::set($product, "checkProduct");
	}

	public function setCharList(array $charList) {
		$this->charList = parent::set($charList, "checkCharList");
	}

	public function setImageList(array $imageList) {
		$this->imageList = parent::set($imageList, "checkImageList");
	}

	public function setAvailableList(array $availableList) {
		$this->availableList = parent::set($availableList, "checkAvailableList");
	}
	//setters end
//main info end

//init
	private function charList() {
		try {
			$id = $this->getProduct()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "product not set", $e);
		}

		$query = "SELECT value_id FROM product_has_value WHERE product_id = '$id'";
		try {
			$result = DB::query($query);
		} catch(QueryEmptyResultException $e) {
			$this->charList = array();
			return;
		}

		$arr = array();
		foreach ($result->fetchAll() as $value) {
			$arr = array_merge_recursive($arr, $value);
		}
		$arr = array_shift($arr);

		try {
			$charList = CharValue::findAll(array("id" => $arr), "id ASC");
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr, "wrong id in db"), $e);
		}
		$this->charList = $charList;
	}

	private function imageList() {
		try {
			$id = $this->getProduct()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "product not set", $e);
		}

		$query = "SELECT image_id FROM product_has_image WHERE product_id = $id";
		try {
			$result = DB::query($query);
		} catch(QueryEmptyResultException $e) {
			$this->imageList = array($this->product->getImage());
			return;
		}

		$arr = array();
		foreach ($result->fetchAll() as $value) {
			$arr = array_merge_recursive($arr, $value);
		}
		$arr = array_shift($arr);
		
		try {
			$imageList = Image::findAll(array("id" => $arr));
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr, "wrong id in db"), $e);
		}
		$this->imageList = $imageList;
	}

	private function availableList() {
		try {
			$id = $this->getProduct()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "product not set", $e);
		}

		try {
			$arr = Available::findAll(array("product_id" => $id));
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("available checked", $e);
		}

		foreach ($arr as $key => $av) {
			if($av->getCount() < 1) {
				unset($arr[$key]);
			}
		}

		$this->availableList = $arr;

		try {
			$this->colorList();
			$this->sizeList();
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("available has been set", $e);
		}
	}

	private function colorList() {
		try {
			$id = $this->getAvailableList();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "available not set", $e);
		}

		foreach ($this->availableList as $av) {
			$colorIDArray[] = $av->getColor()->getID();
		}
		$colorIDArray = array_unique($colorIDArray);

		try {
			$colorList = Color::findAll(array("id" => $colorIDArray), "name ASC");
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($colorIDArray, "wrong id in db"), $e);
		}
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

	private function sizeList() {
		try {
			$id = $this->getAvailableList();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "available not set", $e);
		}

		foreach ($this->availableList as $av) {
			$sizeIDArray[] = $av->getSize()->getID();
		}
		$sizeIDArray = array_unique($sizeIDArray);

		try {
			$sizeList = Size::findAll(array("id" => $sizeIDArray), "CAST(name AS int)");
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($sizeIDArray, "wrong id in db"), $e);
		}
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
//init end

//check
	public function isIn() {
		try {
			$id = $this->getProduct()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "product not set", $e);
		}
		$bool = false;

		try {
			$query = "SELECT count(*) FROM product_has_image WHERE product_id = '$id'";
			$count = DB::query($query)->fetch();
			$bool  = $bool || array_shift($count) > 0;

			$query = "SELECT count(*) FROM product_has_value WHERE product_id = '$id'";
			$count = DB::query($query)->fetch();
			$bool  = $bool || array_shift($count) > 0;
		} catch(QueryEmptyResultException $e) {
			throw new UncheckedLogicException("count(*) must return smth", $e);
		}

		$bool = $bool || Available::findCount(array("product_id" => $id)) > 0;

		return $bool;
	}
//check end

//construct
	public static function withProduct($product) {
		$obj = new self();

		$obj->setProduct($product); // no exception check

		try {
			$obj->charList();
			$obj->imageList();

			if($product->isAvailable()) {
				$obj->availableList();
			}
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("product has been set", $e);
		}

		return $obj;
	}

	private function __construct() {
		$this->validator = new ProductItemValidator();
	}
//construct end

//abstract methods realization
	public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int {
		return Product::findCount($whereArr, $nullStatus);
	} 

	public static function findFirst(array $whereArr = array(), bool $nullStatus = false) : AbstractRecord {
		$product = Product::findFirst($whereArr, $nullStatus);
		$productItem = self::withProduct($product);
		return $productItem;
	}

	public static function findAll(array $whereArr = array(), string $order = "id ASC", int $limit = parent::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array {
		$productList = Product::findAll($whereArr, $order, $limit, $offset, $nullStatus);
		foreach ($productList as $key => $product) {
			$productList[$key] = self::withProduct($product);
		}
		return $productList;
	}

	public function insert() {
		if($this->isIn()) { // no exception check
			throw new WrongDataException($this, "already in database");
		}

		try {
			$id = $this->getProduct()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "product not set", $e);
		}

		try {
			foreach ($this->charList as $char) {
				$query = "INSERT INTO product_has_value 
					SET product_id = '$id', value_id = '{$char->getID()}'";
				DB::query($query);
			}

			foreach ($this->imageList as $image) {
				$query = "INSERT INTO product_has_image 
					SET product_id = '$id', image_id = '{$image->getID()}'";
				DB::query($query);
			}

			foreach ($this->availableList as $i => $av) {
				$av->setProduct($this->product);
				if(!$av->isSaved()) {
					$av->insert();
				}
				$this->availableList[$i] = $av;
			}
		} catch(QueryEmptyResultException $e) {
			throw new UncheckedLogicException("insert must return smth", $e);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		}
	}

	public function update() {
		$this->delete();
		$this->insert();
	}
	
	public function delete() {
		try {
			$id = $this->getProduct()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "product not set", $e);
		}

		$query = "DELETE FROM product_has_value WHERE product_id = '$id'";
		try {
			DB::query($query);
		} catch(QueryEmptyResultException $e) {}

		$query = "DELETE FROM product_has_image WHERE product_id = '$id'";
		try {
			DB::query($query);
		} catch(QueryEmptyResultException $e) {}

		try {
			$availableList = Available::findAll(array("product_id" => $id), true);
		} catch(RecordNotFoundException $e) {
			$availableList = array();
		}
		foreach ($availableList as $av) {
			$av->delete();
		}
	}
//abstract methods realization end

}