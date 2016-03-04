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
}
