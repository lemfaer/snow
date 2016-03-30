<?php

abstract class AbstractTableValidator extends AbstractValidator{

//const
	const ID_ERROR 	   = "Неправильный идентификатор";
	const STATUS_ERROR = "Неправильный статус";
//const end

//getter
	public function __get($name) {
		if(property_exists($this, $name)) {
			$reflection = new ReflectionProperty($this, $name);
			$reflection->setAccessible(true);
			return $reflection->getValue($this);
		}
	}
//getter end 

//closures
	protected $checkID;
	protected $checkStatus;
//closures end

//construct
	protected function  __construct() {
		$this->checkID = function(int $id) : bool {
			$class = get_called_class()::CLASS_NAME;
			$error = array("id" => self::ID_ERROR);
			return self::log($class::findCount(array("id" => $id), true) > 0, $error);
		};

		$this->checkStatus = function(bool $status) : bool {
			$error = array("status" => self::STATUS_ERROR);
			return self::log(true, $error);
		};
	}
//construct

}