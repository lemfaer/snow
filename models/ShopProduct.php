<?php
	
	class ShopProduct {

		const DEF_REC_COUNT = 3;
		const DEF_LIST_COUNT = 12;

		private static $recCount;
		private static $listCount;

		public static function getRecomendedList($count = self::DEF_REC_COUNT) {
			self::$recCount = $count;
			$query = "SELECT id, name, short_description, price, image
				FROM product 
				WHERE is_recomended = '1' AND status = '1'
				ORDER BY id DESC
				LIMIT $count";
			$result = DB::query($query);
			return $result->fetchAll();
		}

		public static function getList($categoryID, $page, $count = self::DEF_LIST_COUNT) {
			self::$listCount = $count;
			$offset = ($page - 1) * $count;
			$query = "SELECT id, name, short_description, price, image, is_new
				FROM product 
				WHERE category_id = '$categoryID' AND status = '1'
				ORDER BY id DESC
				LIMIT $count OFFSET $offset";
			$result = DB::query($query);
			return $result->fetchAll();
		}

		public static function getItem($productID) {
			//запрос основной информации
			$productItem = self::getMainInfo($productID);

			//запрос характеристик
			$productItem['char'] = self::getCharArray($productID);

			//проверка наличия товара
			$isAviable = self::checkAvailability($productID);
			$productItem['is_aviable'] = $isAviable;

			if($isAviable) {
				//запрос цветов
				$productItem['color'] = self::getColorArray($productID);

				//запрос размеров
				$productItem['size'] = self::getSizeArray($productID);
			}

			return $productItem;
		}

		private static function getMainInfo($productID) {
			$query = "SELECT a.*, b.name AS producer_name 
				FROM product AS a INNER JOIN producer AS b
				ON a.producer_id = b.id
				WHERE a.id = '$productID' AND a.status = '1' AND b.status = '1'";
			$result = DB::query($query);
			return $result->fetch();
		}

		private static function getCharArray($productID) {
			$query = "SELECT value_id FROM product_has_value WHERE product_id = '$productID'";
			$query = "SELECT a.value, a.name_id
				FROM char_value AS a INNER JOIN ($query) AS b
				ON a.id = b.value_id
				WHERE a.status = '1'";
			$query = "SELECT a.name, b.value 
				FROM char_name AS a INNER JOIN ($query) AS b
				ON a.id = b.name_id
				WHERE a.status = '1'
				ORDER BY a.name ASC";

			//проверка запроса на наличие
			$checkQuery = "SELECT count(*) FROM ($query) AS a";
			$checkResult = array_shift(DB::query($checkQuery)->fetch());
			if($checkResult) {
				$result = DB::query($query);
				return $result->fetchAll();
			} else {
				return false;
			}
		}

		private static function checkAvailability($productID) {
			$query = "SELECT count(*) FROM aviable WHERE product_id = '$productID'";
			$result = DB::query($query);
			return array_shift($result->fetch()) > 0;
		}

		private static function getColorArray($productID) {
			//добавление основной информации про цвета
			$query = "SELECT b.id, b.name, b.value 
				FROM aviable AS a INNER JOIN color AS b
				ON a.color_id = b.id
				WHERE a.product_id = '$productID' AND a.count > '0' AND b.status = '1'
				GROUP BY b.id
				ORDER BY b.name";
			$result = DB::query($query);
			$colorArray = $result->fetchAll();

			//добавление size_id к всем цветам
			foreach ($colorArray as $k => $v) {
				$query = "SELECT size_id FROM aviable 
					WHERE product_id = '$productID' AND color_id = {$v['id']}";
				$result = DB::query($query);

				$colorArray[$k]['size_id'] = array();
				while($sizeID = $result->fetch()) {
					$sizeID = array_shift($sizeID);
					$colorArray[$k]['size_id'][] = $sizeID;
				}
			}

			return $colorArray;
		}

		private static function getSizeArray($productID) {
			//добавление основной информации про размеры
			$query = "SELECT b.id, b.name
				FROM aviable AS a INNER JOIN size AS b
				ON a.size_id = b.id
				WHERE a.product_id = '$productID' AND a.count > '0' AND b.status = '1'
				GROUP BY b.id
				ORDER BY b.name";
			$result = DB::query($query);
			$sizeArray = $result->fetchAll();

			//добавление color_id к всем размерам
			foreach ($sizeArray as $k => $v) {
				$query = "SELECT color_id FROM aviable 
					WHERE product_id = '$productID' AND size_id = {$v['id']}";
				$result = DB::query($query);

				$sizeArray[$k]['color_id'] = array();
				while($colorID = $result->fetch()) {
					$colorID = array_shift($colorID);
					$sizeArray[$k]['color_id'][] = $colorID;
				}
			}

			return $sizeArray;
		}	

	}