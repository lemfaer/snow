<?php
	
	class ShopProduct {

		const DEF_REC_COUNT = 3;
		const DEF_LIST_COUNT = 12;

		private static $recCount;
		private static $listCount;

		public static function getRecomended($count = self::DEF_REC_COUNT) {
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
				WHERE category_id = $categoryID AND status = '1'
				ORDER BY id DESC
				LIMIT $count OFFSET $offset";
			$result = DB::query($query);
			return $result->fetchAll();
		}

		public static function getItem($productID) {
			//запрос основной информации
			$query = "SELECT a.*, b.name AS producer_name 
				FROM product AS a INNER JOIN producer AS b
				ON a.producer_id = b.id
				WHERE a.id = $productID AND a.status = '1' AND b.status = '1'";
			$result = DB::query($query);
			$productItem = $result->fetch();

			//запрос характеристик
			$query = "SELECT value_id FROM product_has_value WHERE product_id = $productID";
			$query = "SELECT a.value, a.name_id
				FROM char_value AS a INNER JOIN ($query) AS b
				ON a.id = b.value_id
				WHERE a.status = '1'";
			$query = "SELECT a.name, b.value 
				FROM char_name AS a INNER JOIN ($query) AS b
				ON a.id = b.name_id
				WHERE a.status = '1'
				ORDER BY a.name ASC";
			$result = DB::query($query);
			$productItem['char'] = $result->fetchAll();

			//запрос цветов

			return $productItem;
		}

	}