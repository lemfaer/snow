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

//validate methods
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}

	public function checkShortName(string $name) : bool {
		$error = array("short_name" => self::SHORTNAME_ERROR);
		return parent::checkString($name, self::SHORTNAME_PATTERN, $error);
	}

	public function checkDescription(string $description) : bool {
		$error = array("description" => self::DESCRIPTION_ERROR);
		return parent::log(true, $error);
	}

	public function checkImage(Image $image) : bool {
		$error = array("image" => parent::IMAGE_OBJECT_ERROR);
		return parent::checkObject($image, $error);
	}

	public function checkParent(Category $parent) : bool {
		$error = array("parent" => self::PARENT_ERROR);
		if($parent instanceof NullCategory) {
			return parent::log(true, $error);
		}
		return parent::checkObject($parent, $error);
	}

	public function checkParentID(Category $parent, int $id) : bool {
		$error = array("parent" => self::PARENT_ERROR);
		$bool = true;
		$pum = $parent;
		while(!($pum instanceof NullCategory)) {
			if($id === $pum->getID()) {
				$bool = false;
			}
			$pum = $pum->getParent();
		}
		return parent::log($bool, $error);
	}

	public function checkSortOrder(int $sort_order) : bool {
		$error = array("sort_order" => self::SORTORDER_ERROR);
		$bool = $sort_order > 0;
		return parent::log($bool, $error);
	}
//validate methods end

}