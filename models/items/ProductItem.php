<?php

/**
 * Класс описывает структуру продукта
 * 
 * Класс описывает структуру заказа содержащую описание продукта,
 * изображения, спицификации и список модификаций продукта.
 * Методы класса дают возможность получить доступ к данным,
 * описывающим продукт в базе данных, изменять и сохранять их. 
 * 
 * @package models_items
 * @author  Alan Smithee
 * @final
 */
final class ProductItem extends AbstractRecord {

//main info
	/**
	 * @var Product $product   Объект, содержащий основную информацию о продукте
	 * @var array   $charList  Массив, содержащий список характеристик продукта
	 * @var array   $imageList Массив, содержащий изображения продукта
	 * @var array   $сolorList Массив, содержащий цвета и соответствующие размеры
	 * @var array   $sizeList  Массив, содержащий размеры и соответствующие цвета
	 * @var array   $availableList Массив, содержащий модификации продукта
	 */
	private $product;
	private $charList  = array();
	private $imageList = array();
	private $colorList = array();
	private $sizeList  = array();
	private $availableList = array();

	//getters
	/**
	 * Возвращает объект, содержащий основную информацию о продукте
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return Product информация о продукте
	 */
	public function getProduct() : Product {
		return parent::get($this->product);
	}

	/**
	 * Возвращает массив, содержащий список характеристик продукта
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return array список характеристик продукта
	 */
	public function getCharList() : array {
		return parent::get($this->charList);
	}

	/**
	 * Возвращает массив, содержащий изображения продукта
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return array изображения продукта
	 */
	public function getImageList() : array {
		return parent::get($this->imageList);
	}

	/**
	 * Возвращает массив, содержащий модификации продукта
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return array модификации продукта
	 */
	public function getAvailableList() : array {
		return parent::get($this->availableList);
	}

	/**
	 * Возвращает массив, содержащий цвета и соответствующие размеры
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return array цвета и соответствующие размеры
	 */
	public function getColorList() : array {
		return parent::get($this->colorList);
	}

	/**
	 * Возвращает массив, содержащий размеры и соответствующие цвета
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return array размеры и соответствующие цвета
	 */
	public function getSizeList() : array {
		return parent::get($this->sizeList);
	}
	//getters end

	//setters
	/**
	 * Устанавливает основную информацию о продукте
	 * 
	 * @param Product $product основная информация о продукте
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setProduct(Product $product) {
		$this->product = parent::set($product, "checkProduct");
	}

	/**
	 * Устанавливает список характеристик продукта
	 * 
	 * @param array $charList список характеристик продукта
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setCharList(array $charList) {
		$this->charList = parent::set($charList, "checkCharList");
	}

	/**
	 * Устанавливает изображения продукта
	 * 
	 * @param array $imageList изображения продукта
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setImageList(array $imageList) {
		$this->imageList = parent::set($imageList, "checkImageList");
	}

	/**
	 * Устанавливает модификации продукта
	 * 
	 * @param array $availableList модификации продукта
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setAvailableList(array $availableList) {
		$this->availableList = parent::set($availableList, "checkAvailableList");
	}
	//setters end
//main info end

//init
	/**
	 * Инициализирует массив характеристик продукта 
	 * на основе объекта Product в свойстве $product
	 * 
	 * @throws WrongDataException объект Product не установлен
	 * @return void
	 */
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

	/**
	 * Инициализирует массив изображений продукта
	 * на основе объекта Product в свойстве $product
	 * 
	 * @throws WrongDataException объект Product не установлен
	 * @return void
	 */
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

	/**
	 * Инициализирует массив модификаций продукта
	 * на основе объекта Product в свойстве $product
	 * 
	 * @throws WrongDataException объект Product не установлен
	 * @return void
	 */
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

	/**
	 * Инициализирует массив цветов и соответствующих размеров
	 * на основе модификаций продукта в свойстве $availableList
	 * 
	 * @throws WrongDataException массив модификаций не установлен
	 * @return void
	 */
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

	/**
	 * Инициализирует массив размеров и соответствующих цветов
	 * на основе модификаций продукта в свойстве $availableList
	 * 
	 * @throws WrongDataException массив модификаций не установлен
	 * @return void
	 */
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
	/**
	 * Проверяет сохраненена ли информация о продукте в базе данных
	 * 
	 * Возвращает true если в базе данных присутствует информация о продукте
	 * Возвращает false если в базе данных отсутствует информация о продукте
	 * 
	 * @throws WrongDataException объект Product не установлен 
	 * @return bool сохраненен ли список товаров
	 */
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

		$bool = $bool || Available::findCount(array("product_id" => $id), true) > 0;

		return $bool;
	}
//check end

//construct
	/**
	 * Конструктор
	 * 
	 * @param Product $product объект, содержащий основную информацию о продукте
	 * @throws WrongDataException передан неправильный объект Product
	 * @return ProductItem обьект класса
	 */
	public static function withProduct(Product $product) : ProductItem {
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

	/**
	 * Приватный конструктор
	 * Устанавливает валидатор
	 */
	private function __construct() {
		$this->validator = new ProductItemValidator();
	}
//construct end

//abstract methods realization
	/**
	 * Находит количество записей по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @return int количество найденных записей
	 */
	public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int {
		return Product::findCount($whereArr, $nullStatus);
	}

	/**
	 * Находит первую запись по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @throws RecordNotFoundException запись не найдена
	 * @return AbstractRecord первая запись
	 */
	public static function findFirst(array $whereArr = array(), bool $nullStatus = false) : AbstractRecord {
		$product = Product::findFirst($whereArr, $nullStatus);
		$productItem = self::withProduct($product);
		return $productItem;
	}

	/**
	 * Находит все записи по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @throws RecordNotFoundException записи не найдены
	 * @return array<AbstractRecord> записи
	 */
	public static function findAll(array $whereArr = array(), string $order = "id ASC", int $limit = parent::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array {
		$productList = Product::findAll($whereArr, $order, $limit, $offset, $nullStatus);
		foreach ($productList as $key => $product) {
			$productList[$key] = self::withProduct($product);
		}
		return $productList;
	}

	/**
	 * Добавляет запись в базу данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
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

	/**
	 * Обновляет запись в базе данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function update() {
		try {
			$id = $this->getProduct()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "product not set", $e);
		}

		try {
			$query = "DELETE FROM product_has_value WHERE product_id = '$id'";
			DB::query($query);
		} catch(QueryEmptyResultException $e) {}

		try {
			$query = "DELETE FROM product_has_image WHERE product_id = '$id'";
			DB::query($query);
		} catch(QueryEmptyResultException $e) {}

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
		} catch(QueryEmptyResultException $e) {
			throw new UncheckedLogicException("insert must return smth", $e);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		}

		foreach ($this->availableList as $i => $av) {
			try {
				$av->getID();
				$ioru = false;
			} catch(NullAccessException $e) {
				$ioru = true;
			}

			$av->setProduct($this->product);

			if($ioru) {
				$av->insert();
			} else {
				if(!$av->isSaved()) {
					$av->update();
				}
			}

			$this->availableList[$i] = $av;
		}

		try {
			$productItem = ProductItem::withProduct($this->product);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		}

		$arr = array_diff($productItem, $this);

		foreach ($this->availableList as $i => $av) {
			foreach ($arr as $avd) {
				if($av->getID() === $avd->getID()) {
					$avd->delete();
					$this->availableList[$i] = $avd;
				}
			}
		}

		foreach ($arr as $avd) {
			if($avd->isSaved()) {
				$avd->delete();
			}
		}
	}
	
	/**
	 * Удаляет запись из базы данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
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

		foreach ($this->availableList as $i => $av) {
			try {
				$av->getID();
				$av->delete();
				$this->availableList[$i] = $av;
			} catch(NullAccessException $e) {}
		}

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