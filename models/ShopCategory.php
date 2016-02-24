<?php

	class ShopCategory {

		//print_r($db->errorInfo());

		private static function queryTemplate($query) {
			$db = DB::getConnection();

			$result = $db->query($query);
			$result->setFetchMode(PDO::FETCH_ASSOC);

			if(!$result->rowCount()) {
				throw new Exception("Error Processing Request", 1);
			}

			return $result;
		}

		public static function getID($shortNameArray) {
			$id = 0;
			while($shortName = array_shift($shortNameArray)) {
				$query = "SELECT id 
					FROM category 
					WHERE parent_id = '$id' AND short_name = '$shortName' AND status = '1'";
				$result = self::queryTemplate($query);
				$id = array_shift($result->fetch());
			}

			return $id;
		}

		public static function getList($id) {
			$query = "SELECT id, name, short_name, image
				FROM category 
				WHERE parent_id = '$id' AND status = '1'";
			$result = self::queryTemplate($query);

			return $result->fetchAll();
		}

	}