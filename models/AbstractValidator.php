<?php

abstract class AbstractValidator {

//const
	const AVAILABLE_OBJECT_ERROR = "Передан неправильный обьект Available";
	const CATEGORY_OBJECT_ERROR  = "Передан неправильный обьект Category";
	const CHARNAME_OBJECT_ERROR  = "Передан неправильный обьект CharName";
	const CHARVALUE_OBJECT_ERROR = "Передан неправильный обьект CharValue";
	const COLOR_OBJECT_ERROR     = "Передан неправильный обьект Color";
	const CONTACT_OBJECT_ERROR   = "Передан неправильный обьект Contact";
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
	protected function checkString(string $str, string $pattern, array $error) : bool {
		return self::log(preg_match($pattern, $str) === 1, $error);
	}

	protected function checkObject(AbstractTable $obj, array $error) : bool {
		return self::log($obj->isSaved(), $error);
	}

	protected function checkClass(AbstractTable $obj, string $class, array $error) : bool {
		return self::log($obj instanceof $class, $error);
	}
//standart check end

}