<?php

class SizeValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Size";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const NAME_ERROR = "Неправильный ввод имени";
//const end

//validate methods
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}

	public function checkCategory(Category $category) : bool {
		$error = array("category" => parent::CATEGORY_OBJECT_ERROR);
		return parent::checkObject($category, $error);
	}
//validate methods end

}