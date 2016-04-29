<?php

/**
 * Обрабатыает запросы связанные с CRUPProduct формой 
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @final
 */
final class CRUPProductForm extends AbstractCRUPForm {
	
	/**
	 * Выполняет валидацию данных полученных из формы Product
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator = new ProductValidator();

		$imageValidator     = new ImageValidator();
		$nameValidator      = new CharNameValidator();
		$valueValidator     = new CharValueValidator();
		$colorValidator     = new ColorValidator();
		$sizeValidator      = new SizeValidator();
		$availableValidator = new AvailableValidator();
		$categoryValidator  = new CategoryValidator();
		$producerValidator  = new ProducerValidator();

		if(isset($data['file']['image'])) {
			$data['image'] = $data['file']['image'];
			unset($data['file']);
		}

		if(isset($data['image']) && isset($data['image_only'])) {
			$data = array("image" => $data['image']);
		}

		if(isset($data['image'])) {
			$data = array_merge($data, $data['image']); 
			unset($data['image']);
		}

		if(isset($data['image_id'])) {
			$data = array_merge($data, $data['image_id']);
			unset($data['image_id']);
		}

		if(isset($data['char_name'])) {
			$data = array_merge($data, $data['char_name']); 
			unset($data['char_name']);
		}

		if(isset($data['char_value'])) {
			$data = array_merge($data, $data['char_value']); 
			unset($data['char_value']);
		}

		if(isset($data['color'])) {
			$data = array_merge($data, $data['color']); 
			unset($data['color']);
		}

		if(isset($data['size'])) {
			$data = array_merge($data, $data['size']); 
			unset($data['size']);
		}

		if(isset($data['count'])) {
			$data = array_merge($data, $data['count']); 
			unset($data['count']);
		}

		if(isset($data['available_id'])) {
			$data = array_merge($data, $data['available_id']); 
			unset($data['available_id']);
		}

		if(isset($data['price'])) {
			$data['price'] = (int) $data['price'];
		}

		if(isset($data['year'])) {
			$data['year'] = (int) $data['year'];
		}

		foreach ($data as $i => $v) {
			if(preg_match("/count_[0-9]+/", $i)) {
				$data[$i] = (int) $v;
			}
		}

		$method = function(string $key) use (&$imageValidator, &$nameValidator, 
			&$valueValidator, &$colorValidator, &$sizeValidator, &$availableValidator,
			&$categoryValidator, &$producerValidator) {
			if(preg_match("/image_[0-9]+/", $key)) {
				return array($imageValidator, "checkUploadedFile");
			}

			if(preg_match("/image_id_[0-9]+/", $key)) {
				return array($imageValidator, "checkID");
			}

			if(preg_match("/name_[0-9]+/", $key)) {
				return array($nameValidator, "checkID");
			}

			if(preg_match("/value_[0-9]+/", $key)) {
				return array($valueValidator, "checkID");
			}

			if(preg_match("/color_[0-9]+/", $key)) {
				return array($colorValidator, "checkID");
			}

			if(preg_match("/size_[0-9]+/", $key)) {
				return array($sizeValidator, "checkID");
			}

			if(preg_match("/count_[0-9]+/", $key)) {
				return array($availableValidator, "checkCount");
			}

			if(preg_match("/available_id_[0-9]+/", $key)) {
				return array($availableValidator, "checkID");
			}

			switch ($key) {
				case "id":
					$m = "checkID";
					break;
				case "category":
					$m = array($categoryValidator, "checkID");
					break;
				case "producer":
					$m = array($producerValidator, "checkID");
					break;
				case "name":
					$m = "checkName";
					break;
				case "price":
					$m = "checkPrice";
					break;
				case "year":
					$m = "checkYear";
					break;
				case "short_description":
					$m = "checkShortDescription";
					break;
				case "description":
					$m = "checkDescription";
					break;
				case "is_new":
					$m = "checkNew";
					break;
				case "is_recomended":
					$m = "checkRecomended";
					break;
				case "status":
					$m = "checkStatus";
					break;
				default:
					throw new WrongDataException($key);
			}
			return $m;
		};

		$result =  parent::checkParamsDefault($data, $method, $validator);
		return json_encode($result);
	}

	/**
	 * Создает новую запись Product в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function create(array $data) {
		try {
			$product = self::createProduct($data);

			extract(self::item(
				$data['file']['image'] ?? array(),
				$data['char_value']    ?? array(),
				$data['color']         ?? array(),
				$data['size']          ?? array(),
				$data['count']         ?? array()
			));

			$productItem = ProductItem::withProduct($product);

			$productItem->setCharList($charArr);
			$productItem->setImageList($imageArr);
			$productItem->setAvailableList($availableArr);

			$productItem->insert();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Редактирует запись Product в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function update(array $data) {
		if(!isset($data['id'])) {
			throw new WrongDataException($data, "id not set");
		}

		$id = $data['id'];

		try {
			try {
				$productItem = ProductItem::findFirst(array("id" => $id), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($id, "wrong product id", $e);
			}

			$product = $productItem->getProduct();
			$product = self::updateProduct($product, $data);
			$productItem->setProduct($product);

			$imageArrUp = self::updateImageID($data['image_id'] ?? array());

			$avArrUp = self::updateAvID($data['available_id'] ?? array());
			foreach ($avArrUp as $i => $av) {
				$i++;

				$bool1 = isset($data['color']["color_$i"]);
				$bool2 = isset($data['size']["size_$i"]);
				$bool3 = isset($data['count']["count_$i"]);

				if(!$bool1 || !$bool2 || !$bool3) {
					continue;
				}

				$color = $data['color']["color_$i"];
				$size  = $data['size']["size_$i"];
				$count = $data['count']["count_$i"];

				$av = self::updateAvailable($av, $color, $size, $count);

				unset($data['color']["color_$i"]);
				unset($data['size']["size_$i"]);
				unset($data['count']["count_$i"]);

				$i--;
			}

			extract(self::item(
				$data['file']['image'] ?? array(),
				$data['char_value']    ?? array(),
				$data['color']         ?? array(),
				$data['size']          ?? array(),
				$data['count']         ?? array()
			));

			$imageArr     = array_merge($imageArr, $imageArrUp);			
			$availableArr = array_merge($availableArr, $avArrUp); 

			$productItem->setCharList($charArr);
			$productItem->setImageList($imageArr);
			$productItem->setAvailableList($availableArr);

			$productItem->update();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Преобразует полученые с формы идентификаторы изображений в объекты Image
	 * 
	 * @param array $imageIDArr идентификаторы изображений
	 * @throws WrongDataException переданы неправильные данные
	 * @return array объекты Image
	 */
	private static function updateImageID(array $imageIDArr) : array {
		try {
			$imageArr = array();
			foreach ($imageIDArr as $imageID) {
				$imageArr[] = Image::findFirst(array("id" => $imageID), true);
			}
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($imageID, "wrong image id", $e);
		}

		return $imageArr;
	}

	/**
	 * Преобразует полученые с формы идентификаторы модификаций в объекты Available
	 * 
	 * @param array $avIDArr идентификаторы модификаций
	 * @throws WrongDataException переданы неправильные данные
	 * @return array объекты Available
	 */
	private static function updateAvID(array $avIDArr) : array {
		try {
			$avArr = array();
			foreach ($avIDArr as $avID) {
				$avArr[] = Available::findFirst(array("id" => $avID), true);
			}
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($avID, "wrong image id", $e);
		}

		return $avArr;
	}

	/**
	 * Изменяет объект Available
	 * 
	 * @param Available $product модификация товара
	 * @param int $color идентификатор цвета
	 * @param int $size идентификатор размера
	 * @param int $count кол-во товаров
	 * @throws WrongDataException переданы неправильные данные
	 * @return Available модификация товара
	 */
	private static function updateAvailable(Available $av, int $colorID, int $sizeID, int $count) : Available {
		try {
			$size  = Size::findFirst(array("id" => $sizeID), true);
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($sizeID, "wrong size id", $e);
		}

		try {
			$color = Color::findFirst(array("id" => $colorID), true);
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($colorID, "wrong color id", $e);
		}

		$av->setSize($size);
		$av->setColor($color);
		$av->setCount($count);

		$av->update();

		return $av;
	}

	/**
	 * Создает объект Product на основе данных с формы
	 * 
	 * @param array $data данные полученные с формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return Product объект
	 */
	private static function createProduct(array $data) : Product {
		$req = array(
			"name", "year", "price", 
			"status", "is_new", "is_recomended",
			"category", "producer",
		);
		if($k = array_diff_key(array_flip($req), $data)) {
			throw new WrongDataException($k, " keys not exists");
		}

		//data
			$name  = $data['name'];

			$year  = (int) $data['year'];
			$price = (int) $data['price'];

			$desc  = $data['description'] ?? '';
			$short = $data['short_description'] ?? '';

			$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);
			$new    = filter_var($data['is_new'], FILTER_VALIDATE_BOOLEAN);
			$rec    = filter_var($data['is_recomended'], FILTER_VALIDATE_BOOLEAN);

			try {
				$category = Category::findFirst(array("id" => $data['category']), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($data['category'], "wrong category id", $e);
			}

			try {
				$producer = Producer::findFirst(array("id" => $data['producer']), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($data['producer'], "wrong producer id", $e);
			}
		//data end

		$product = new Product();

		$product->setNew($new);
		$product->setName($name);
		$product->setYear($year);
		$product->setPrice($price);
		$product->setStatus($status);
		$product->setRecomended($rec);
		$product->setDescription($desc);
		$product->setCategory($category);
		$product->setProducer($producer);
		$product->setShortDescription($short);

		$product->insert();

		return $product;
	}

	/**
	 * Изменяет объект Product на основе данных с формы
	 * 
	 * @param Product $product объект
	 * @param array $data данные полученные с формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return Product объект
	 */
	private static function updateProduct(Product $product, array $data) : Product {
		$req = array(
			"status", "is_new", "is_recomended",
		);
		if($k = array_diff_key(array_flip($req), $data)) {
			throw new WrongDataException($k, " keys not exists");
		}

		if(!$product->isSaved()) {
			throw new WrongDataException($product, "product not saved");
		}

		$new    = filter_var($data['is_new'], FILTER_VALIDATE_BOOLEAN);
		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);
		$rec    = filter_var($data['is_recomended'], FILTER_VALIDATE_BOOLEAN);

		$product->setNew($new);
		$product->setStatus($status);
		$product->setRecomended($rec);

		if(isset($data['category'])) {
			$categoryID = $data['category'];
			try {
				$category = Category::findFirst(array("id" => $categoryID));
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($categoryID, "wrong category id", $e);
			}
			$product->setCategory($category);
		}

		if(isset($data['producer'])) {
			$producerID = $data['producer'];
			try {
				$producer = Producer::findFirst(array("id" => $producerID));
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($producerID, "wrong producer id", $e);
			}
			$product->setProducer($producer);
		}

		if(isset($data['name'])) {
			$product->setName($data['name']);
		}

		if(isset($data['year'])) {
			$year = (int) $data['year'];
			$product->setYear($year);
		}

		if(isset($data['price'])) {
			$price = (int) $data['price'];
			$product->setPrice($price);
		}

		if(isset($data['description'])) {
			$product->setDescription($data['description']);
		}

		if(isset($data['short_description'])) {
			$product->setShortDescription($data['short_description']);
		}

		if(!$product->isSaved()) {
			$product->update();
		}

		return $product;
	}

	/**
	 * Обрабатывает данные полученные с формы
	 * 
	 * @param array $imageArr массив изображений с формы
	 * @param array $charArr массив значений характеристик с формы
	 * @param array $colorArr массив выбранных цветов с формы
	 * @param array $sizeArr массив выбранных размеров с формы
	 * @param array $countArr массив количества экземпляров с формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return array compact содержит данные для инициализации ProductItem 
	 * ($imageArr, $charArr, $availableArr)
	 */
	private static function item(array $imageArr, array $charArr, array $colorArr, array $sizeArr, array $countArr) {
		$charArr  = array_values($charArr);
		$sizeArr  = array_values($sizeArr);
		$countArr = array_values($countArr);
		$imageArr = array_values($imageArr);
		$colorArr = array_values($colorArr);

		if(count($colorArr) !== count($sizeArr) 
			|| count($sizeArr) !== count($countArr)) {
			throw new UncheckedLogicException(
				"count of colors sizes and counts must be same",
				new WrongDataException(array($colorArr, $sizeArr, $countArr),
					"not same count")
			);
		}

		foreach ($countArr as $i => $count) {
			$countArr[$i] = (int) $count;
		}

		//images
			$arr = array();

			foreach ($imageArr as $imageUF) {
				$image = Image::withUploadedFile($imageUF);
				$arr[] = $image;
			}

			$imageArr = $arr;
		//images end

		//chars
			try {
				$charArr = ($charArr) 
					? (CharValue::findAll(array("id" => $charArr))) 
					: (array());
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($charArr, "wrong char ids", $e);
			}
		//chars end

		//sizes
			try {
				foreach ($sizeArr as $i => $sizeID) {
					$sizeArr[$i] = Size::findFirst(array("id" => $sizeID));
				}
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($sizeID, "wrong size id", $e);
			}
		//sizes end

		//colors
			try {
				foreach ($colorArr as $i => $colorID) {
					$colorArr[$i] = Color::findFirst(array("id" => $colorID));
				}
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($colorID, "wrong color id", $e);
			}
		//colors end

		//available
			$arr = array();

			for($i = 0; $i < count($countArr); $i++) {
				$av = new Available();
				$av->setSize($sizeArr[$i]);
				$av->setColor($colorArr[$i]);
				$av->setCount($countArr[$i]);
				$av->setStatus(true);

				$arr[] = $av;
			}

			$availableArr = $arr;
		//available end

		return compact("imageArr", "charArr", "availableArr");
	}

}