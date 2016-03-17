<?php

class CategoryValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Category";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";
	//lowercase латиница. 1-99 символов
	const SHORTNAME_PATTERN = "/^[a-z]{1,99}$/";

	const NAME_ERROR        = "Неправильный ввод имени";
	const SHORTNAME_ERROR   = "Неправильный ввод краткого имени";
	const DESCRIPTION_ERROR = "Неправильный ввод описания";
	const PARENT_ERROR      = "Передано неправильное значение в поле Parent";
	const SORTORDER_ERROR   = "Неправильный ввод порядка сортировки";
//const end

//closures
	private $checkName;
	private $checkShortName;
	private $checkDescription;
	private $checkImage;
	private $checkParent;
	private $checkSortOrder;
//closures end
	
	public function __construct() {
		parent::__construct();

		$this->checkName = function(string $name) : bool {
			$error = array("name" => self::NAME_ERROR);
			return parent::checkString($name, self::NAME_PATTERN, $error);
		};

		$this->checkShortName = function(string $name) : bool {
			$error = array("short_name" => self::SHORTNAME_ERROR);
			return parent::checkString($name, self::SHORTNAME_PATTERN, $error);
		};

		$this->checkDescription = function(string $description) : bool {
			$error = array("description" => self::DESCRIPTION_ERROR);
			return parent::log(true, $error);
		};

		$this->checkImage = function(Image $image) : bool {
			$error = array("image" => parent::IMAGE_OBJECT_ERROR);
			return parent::checkObject($image, $error);
		};

		$this->checkParent = function(Category $parent = null) : bool {
			$error = array("parent" => self::PARENT_ERROR);
			if(is_null($parent)) {
				return parent::log(true, $error);
			}
			return parent::checkObject($parent, $error);
		};

		$this->checkSortOrder = function(int $sort_order) : bool {
			$error = array("sort_order" => self::SORTORDER_ERROR);
			$bool = $sort_order > 0;
			return parent::log($bool, $error);
		};
	}

}