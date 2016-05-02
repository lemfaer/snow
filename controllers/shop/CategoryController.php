<?php 

class CategoryController {

	const SORT_ORDER = "sort_order ASC";

	public function actionIndex($shortName = null) {
		$id = Category::getIDByShortNameArray(array($shortName));

		try {
			$category = Category::findFirst(array("id" => $id));
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("category not found", $e);
		}

		try {
			$categoryList = Category::findAll(array("parent_id" => $id), self::SORT_ORDER);
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("categories not found", $e);
		}

		try {
			View::template("/shop/category/index.php", compact("category", "categoryList"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("category view not found", $e);
		}
	}

	public function actionRedirect($shortName1, $shortName2) {
		$id = Category::getIDByShortNameArray(array($shortName1, $shortName2));
		header("location: /products/$id");
	}

}