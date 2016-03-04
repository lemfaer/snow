<?php

class ProductItem extends Product {

//char list
	private $charList;

	public function getCharList() {
		return $this->charList;
	}

	public function setChatList($charList) {
		$this->charList = $charList;
	}

	private function setCharList() {
		$charList = array();
		$id = $this->getID();
		$query = "SELECT count(value_id) FROM product_has_value WHERE product_id = '$id'";
		$result = DB::query($query);

		if(array_shift($result->fetch())) {
			$query = "SELECT value_id FROM product_has_value WHERE product_id = '$id'";
			$result = DB::query($query);

			$arrID = array();
			while($id = $result->fetch()) {
				$id = array_shift($id);
				$arrID[] = $id;
			}

			$valueIDString = implode(",", $arrID);
			$charList = Characteristic::findAll("id IN($valueIDString)", 10, 0);
		}

		$this->charList = $charList;
	} 
//char list end

	public static function findFirst($where, $nullStatus = false) {
		$productItem = self::findFirstDefault(__CLASS__, "product", $where, $nullStatus);
		$productItem->setCharList();
		return $productItem;
	}

}