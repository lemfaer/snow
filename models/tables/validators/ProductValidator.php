<?php

class ProductValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Product";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const NAME_ERROR		= "Неправильный ввод имени";
	const PRICE_ERROR		= "Неправильный ввод цены";
	const YEAR_ERROR		= "Неправильный ввод года";
	const SHORTDESC_ERROR	= "Неправильный ввод краткого описания";
	const DESCRIPTION_ERROR	= "Неправильный ввод описания";
	const NEW_ERROR			= "Неправильное поле new";
	const RECOMENDED_ERROR	= "Неправильное поле recomended";
//const end

//validate methods
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}

	public function checkProducer(Producer $producer) : bool {
		$error = array("producer" => parent::PRODUCER_OBJECT_ERROR);
		return parent::checkObject($producer, $error);
	}

	public function checkPrice(int $price) : bool {
		$error = array("price" => self::PRICE_ERROR);
		$bool = $price > 0;
		return parent::log($bool, $error);
	}

	public function checkYear(int $year) : bool {
		$error = array("year" => self::YEAR_ERROR);
		$bool = $year >= (int)date("Y", 0) && $year <= (int)date("Y");
		return parent::log($bool, $error); 
	}

	public function checkShortDescription(string $short_description) : bool {
		$error = array("short_description" => self::SHORTDESC_ERROR);
		return parent::log(true, $error);
	}

	public function checkDescription(string $description) : bool {
		$error = array("description" => self::DESCRIPTION_ERROR);
		return parent::log(true, $error);
	}

	public function checkCategory(Category $category) : bool {
		$error = array("category" => parent::CATEGORY_OBJECT_ERROR);
		return parent::checkObject($category, $error);
	}

	public function checkNew(bool $is_new) : bool {
		$error = array("is_new" => self::NEW_ERROR);
		return parent::log(true, $error);
	}

	public function checkRecomended(bool $is_recomended) : bool {
		$error = array("is_recomended" => self::RECOMENDED_ERROR);
		return parent::log(true, $error);
	}
//validate methods end

}