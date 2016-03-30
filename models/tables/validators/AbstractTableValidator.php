<?php

abstract class AbstractTableValidator extends AbstractValidator{

//const
	const ID_ERROR 	   = "Неправильный идентификатор";
	const STATUS_ERROR = "Неправильный статус";
//const end

//validate methods
	public function checkID(int $id) : bool {
		$class = get_called_class()::CLASS_NAME;
		$error = array("id" => self::ID_ERROR);
		return self::log($class::findCount(array("id" => $id), true) > 0, $error);
	}

	public function checkStatus(bool $status) : bool {
		$error = array("status" => self::STATUS_ERROR);
		return self::log(true, $error);
	}
//validate methods end

}