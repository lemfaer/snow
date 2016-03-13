<?php

abstract class AbstractValidator {

//const
	const ID_ERROR 	   = "Неправильный идентификатор";
	const STATUS_ERROR = "Неправильный статус";

	const AVAILABLE_OBJECT_ERROR = "Передан неправильный обьект Available";
	const CATEGORY_OBJECT_ERROR  = "Передан неправильный обьект Category";
	const CHARNAME_OBJECT_ERROR  = "Передан неправильный обьект CharName";
	const CHARVALUE_OBJECT_ERROR = "Передан неправильный обьект CharValue";
	const COLOR_OBJECT_ERROR     = "Передан неправильный обьект Color";
	const IMAGE_OBJECT_ERROR     = "Передан неправильный обьект Image";
	const PRODUCER_OBJECT_ERROR  = "Передан неправильный обьект Producer";
	const PRODUCT_OBJECT_ERROR   = "Передан неправильный обьект Product";
	const SIZE_OBJECT_ERROR      = "Передан неправильный обьект Size";
	const USER_OBJECT_ERROR      = "Передан неправильный обьект User";
//const end

//error info
	protected $errorInfo = array();

	public function errorInfo() : array {
		return $this->errorInfo;
	}

	protected function log(bool $bool, array $error = array()) : bool {
		if($error) {
			$error = array_slice($error, 0, 1);
			$key = key($error);
			if($bool) {
				unset($this->errorInfo[$key]);
			} else {
				$this->errorInfo[$key] = array_shift($error);
			}
		}
		return $bool;
	}
//error info end

//standart check
	public function checkID(int $id) : bool {
		$class = get_called_class()::CLASS_NAME;
		$error = array("id" => self::ID_ERROR);
		return self::log($class::findCount(array("id" => $id)) > 0, $error);
	}

	public function checkStatus(bool $status) : bool {
		$error = array("status" => self::STATUS_ERROR);
		return self::log(true, $error);
	}

	protected function checkString(string $str, string $pattern, array $error) : bool {
		return self::log(preg_match($pattern, $str) === 1, $error);
	}

	protected function checkObject(AbstractRecord $obj, array $error) : bool {
		$class = get_class($obj);
		$id = $obj->getID();
		return self::log($class::findCount(array("id" => $id)) > 0, $error);
	} 
//standart check end

}