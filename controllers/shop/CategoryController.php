<?php 

	class CategoryController {

		public function actionIndex($shortName = null) {
			$categoryID = Category::getIDByShortNameArray(array($shortName));
			$category = ($categoryID) ? (Category::findFirst(array("id" => $categoryID))) : (null);
			$categoryList = Category::findAll(array("parent_id" => $categoryID), "sort_order ASC");
			foreach ($categoryList as $key => $cat) {
				if($cat instanceof NullCategory) {
					unset($categoryList[$key]);
				}
			}

			// echo "ID: $categoryID";
			// echo "<pre>";
			// print_r($categoryList);
			// echo "</pre>";

			View::template("shop/category/index.php", compact("category", "categoryList"));
		}

		public function actionRedirect($shortName1, $shortName2) {
			$categoryID = Category::getIDByShortNameArray(array($shortName1, $shortName2));
			header("location: /products/$categoryID");
		}

	}