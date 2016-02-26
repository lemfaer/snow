<?php

	class ShopCategory {

		public static function getID($shortNameArray) {
			$id = 0;
			while($shortName = array_shift($shortNameArray)) {
				$query = "SELECT id 
					FROM category 
					WHERE parent_id = '$id' AND short_name = '$shortName' AND status = '1'";
				$result = DB::query($query);
				$id = array_shift($result->fetch());
			}

			return $id;
		}

		public static function getName($categoryID) {
			if(!$categoryID) {
				return;
			}
			$query = "SELECT name FROM category WHERE id = '$categoryID' AND status = '1'";
			$result = DB::query($query);
			return array_shift($result->fetch());
		}

		public static function getList($categoryID) {
			$query = "SELECT id, name, short_name, image
				FROM category 
				WHERE parent_id = '$categoryID' AND status = '1'
				ORDER BY sort_order";
			$result = DB::query($query);

			return $result->fetchAll();
		}

		public static function getBCArrayByCategoryID($categoryID) {
			if(!$categoryID) {
				return false;
			}

			$id = $categoryID;
			while($id) {
				$query = "SELECT parent_id, short_name, name FROM category WHERE id = '$id' AND status = '1'";
				$elem = DB::query($query)->fetch();

				$id = array_shift($elem);
				$elem['url'] = "/category";
				$bc[] = $elem;
			}

			while($elem = array_pop($bc)) {
				foreach ($bc as $key => $value) {
					$bc[$key]['url'] .= "/".$elem['short_name'];
				}
				$elem['url'] .= "/".array_shift($elem);
				$bcArray[] = $elem;
			}

			return $bcArray;
		}

		public static function getBCArrayByProductID($productID) {
			$query = "SELECT category_id FROM product WHERE id = '$productID' AND status = '1'";
			$categoryID = array_shift(DB::query($query)->fetch());
			return self::getBCArrayByCategoryID($categoryID);
		}

	}