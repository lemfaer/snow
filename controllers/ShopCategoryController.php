<?php 

	class ShopCategoryController {

		public function actionIndex($shortName = null) {
			$categoryID = Category::getIDByShortNameArray(array($shortName));
			$category = ($categoryID) ? (Category::findFirst(array("id" => $categoryID))) : (null);
			$categoryList = Category::findAll(array("parent_id" => $categoryID), "sort_order ASC");

			// echo "ID: $categoryID";
			// echo "<pre>";
			// print_r($categoryList);
			// echo "</pre>";

			$contentView = ROOT."/views/ShopCategoryView/index.php";
			require_once(ROOT."/views/template/index.php");
		}

		public function actionRedirect($shortName1, $shortName2) {
			$categoryID = Category::getIDByShortNameArray(array($shortName1, $shortName2));
			header("location: /products/$categoryID");
		}

	}