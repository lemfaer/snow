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

		if(isset($data['price'])) {
			$data['price'] = (int) $data['price'];
		}

		if(isset($data['year'])) {
			$data['year'] = (int) $data['year'];
		}

		$method = function(string $key) use (&$imageValidator, &$nameValidator, 
			&$valueValidator, &$colorValidator, &$sizeValidator, &$availableValidator,
			&$categoryValidator, &$producerValidator) {
			if(preg_match("/image_[0-9]+/", $key)) {
				return array($imageValidator, "checkUploadedFile");
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
		$name  = $data['name'];
		$year  = $data['year'];
		$price = $data['price'];
		$desc  = $data['description'];
		$short = $data['short_description'];

		$status = filter_var($data['status'], FILTER_VALIDATE_BOOLEAN);
		$new    = filter_var($data['is_new'], FILTER_VALIDATE_BOOLEAN);
		$rec    = filter_var($data['is_recomended'], FILTER_VALIDATE_BOOLEAN);

		$categoryID = $data['category'];
		$producerID = $data['producer'];

		$imageArr = array();
		$charArr  = array();
		$colorArr = array();
		$sizeArr  = array();
		$countArr = array();

		if(isset($data['file']['image'])) {
			$imageArr = array_values($data['file']['image']);
		} 

		if(isset($data['char_value'])) {
			$charArr = array_values($data['char_value']);
		}

		if(isset($data['color'])) {
			$colorArr = array_values($data['color']);
		}

		if(isset($data['size'])) {
			$sizeArr = array_values($data['size']);
		}

		if(isset($data['count'])) {
			$countArr = array_values($data['count']);
		}

		if(count($colorArr) !== count($sizeArr) 
			|| count($sizeArr) !== count($countArr)) {
			throw new UncheckedLogicException(
				"count of colors sizes and counts must be same",
				new WrongDataException(array($colorArr, $sizeArr, $countArr),
					"not same count")
			);
		}

		try {
		//category
			try {
				$category = Category::findFirst(array("id" => $categoryID));
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($categoryID, "wrong category id", $e);
			}
		//category end

		//producer
			try {
				$producer = Producer::findFirst(array("id" => $producerID));
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($producerID, "wrong producer id", $e);
			}
		//producer end

		//images
			$arr = array();

			foreach ($imageArr as $imageUF) {
				$image = new Image();

				$image->setStatus(true);
				$image->setByUploadedFile($imageUF);

				$image->insert();
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

		//product
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
		//product end

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
	public static function update(array $data) {}

}