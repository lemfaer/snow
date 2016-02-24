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

		public static function getList($id) {
			$query = "SELECT id, name, short_name, image
				FROM category 
				WHERE parent_id = '$id' AND status = '1'
				ORDER BY sort_order";
			$result = DB::query($query);

			return $result->fetchAll();
		}

	}