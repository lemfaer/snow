<?php

class Characteristic {

	private $name; //class
	private $value; //class

	public function getName() {
		return $this->name;
	}

	public function getValue() {
		return $this->value;
	}

	public static function findFirst($where, $nullStatus = false) {
		$char = new self(); 
		$char->value = CharValue::findFirst($where, $nullStatus);
		$char->name = $char->value->getName();

		return $char;
	}

	public static function findAll($where, $limit, $offset, $order = "id", $nullStatus = false) {
		$charList = CharValue::findAll($where, $limit, $offset, $order, $nullStatus);
		foreach ($charList as $key => $value) {
			$char = new self();
			$char->value = $value;
			$char->name = $value->getName();

			$charList[$key] = $char;
		}

		return $charList;
	}

	public static function getCharList($productID) {
		$charList = array();
		$query = "SELECT count(value_id) FROM product_has_value WHERE product_id = '$productID'";
		$result = DB::query($query);

		if($result->fetch()) {
			$query = "SELECT value_id FROM product_has_value WHERE product_id = '$productID'";
			$result = DB::query($query);

			$arrID = array();
			while($id = $result->fetch()) {
				$id = array_shift($id);
				$arrID[] = $id;
			}

			$valueIDString = implode(",", $arrID);
			$charList = self::findAll("")
		}
	}

}
