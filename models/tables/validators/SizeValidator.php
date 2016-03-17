<?php

class SizeValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Size";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const NAME_ERROR = "Неправильный ввод имени";
//const end

//closure
	private $checkName;
	private $checkCategory;
//closure end

	public function __construct() {
		parent::__construct();

		$this->checkName = function(string $name) : bool {
			$error = array("name" => self::NAME_ERROR);
			return parent::checkString($name, self::NAME_PATTERN, $error);
		};
		
		$this->checkCategory = function(Category $category) : bool {
			$error = array("category" => parent::CATEGORY_OBJECT_ERROR);
			return parent::checkObject($category, $error);
		};
	}

}