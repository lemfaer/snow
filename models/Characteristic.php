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

	public static function findFirst(array $whereArr, $nullStatus = false) {
		$char = new self(); 
		$char->value = CharValue::findFirst($whereArr, $nullStatus);
		$char->name = $char->value->getName();

		return $char;
	}

	public static function findAll(array $whereArr, $order = "id ASC", $limit = AbstractRecord::LIMIT_MAX, $offset = 0, $nullStatus = false) {
		$charList = CharValue::findAll($whereArr, $order, $limit, $offset, $nullStatus);
		foreach ($charList as $key => $value) {
			$char = new self();
			$char->value = $value;
			$char->name = $value->getName();

			$charList[$key] = $char;
		}

		return $charList;
	}
}
