<?php

class CargoValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Cargo";

	const COUNT_LIMIT = 1000;
	const COUNT_ERROR = "Неправильный ввод количества товаров";
	const COUNT_AVAILABLE_ERROR = "Доступно меньше товаров";
//const end

//validate methods
	public function checkIntent(Intent $intent) : bool {
		$error = array("intent" => parent::INTENT_OBJECT_ERROR);
		return parent::checkObject($intent, $error);
	}

	public function checkAvailable(Available $available) : bool {
		$error = array("available" => parent::AVAILABLE_OBJECT_ERROR);
		return parent::checkObject($available, $error);
	}

	public function checkCount(int $count) : bool {
		$error = array("count" => self::COUNT_ERROR);
		$bool = $count >= 0 && $count <= self::COUNT_LIMIT;
		return parent::log($bool, $error);
	}

	public function checkAvailableCount(int $count, Available $available) : bool {
		$error = array("count" => self::COUNT_AVAILABLE_ERROR);
		$bool = $count <= $available->getCount();
		return parent::log($bool, $error);
	}
//validate methods end

}