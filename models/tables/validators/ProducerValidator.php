<?php

class ProducerValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Producer";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const NAME_ERROR = "Неправильный ввод имени";
//const end

//validate methods
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}

	public function checkImage(Image $image) : bool {
		$error = array("image" => parent::IMAGE_OBJECT_ERROR);
		return parent::checkObject($image, $error);
	}
//validate methods end

}