<?php

class ProducerValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Producer";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const NAME_ERROR = "Неправильный ввод имени";
//const end

//closure
	private $checkName;
	private $checkImage;
//closure end

	public function __construct() {
		parent::__construct();

		$this->checkName = function(string $name) : bool {
			$error = array("name" => self::NAME_ERROR);
			return parent::checkString($name, self::NAME_PATTERN, $error);
		};
		
		$this->checkImage = function(Image $image) : bool {
			$error = array("image" => parent::IMAGE_OBJECT_ERROR);
			return parent::checkObject($image, $error);
		};
	}

}