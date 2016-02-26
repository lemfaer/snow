<?php

	class ShopCategory {

		public static function getID($shortNameArray) {
			$id = 0;
			while($shortName = array_shift($shortNameArray)) {
				$query = "SELECT id 
					FROM category 
					WHERE parent_id = '$id' AND short_name = '$shortName' AND status = '1'";
				$result = DB::checkedQuery($query);
				$id = array_shift($result->fetch());
			}

			return $id;
		}

		public static function getList($categoryID) {
			$query = "SELECT id, name, short_name, image
				FROM category 
				WHERE parent_id = '$categoryID' AND status = '1'
				ORDER BY sort_order";
			$result = DB::checkedQuery($query);

			return $result->fetchAll();
		}

		public static function getBreadcrumbArray($categoryID) {
			if(!$categoryID) {
				return;
			}

			$id = $categoryID;
			while($id) {
				$query = "SELECT a.id, a.name 
					FROM category AS a INNER JOIN category AS b
					ON a.id = b.parent_id
					WHERE b.id = '$id' AND b.status = '1'";
				$result = DB::query($query);
				$elem = $result->fetch();
				$id = $elem['id'];
				$bcArray[] = $elem;
			}
			array_pop($bcArray);

			return $bcArray;
		}

	}