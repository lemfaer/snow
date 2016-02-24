<?php 

	class ShopCategoryController {

		public function actionIndex($shortName = null) {
			$categoryID = ShopCategory::getID(array($shortName));
			$categoryList = ShopCategory::getList($categoryID);

			echo "ID: $categoryID";
			echo "<pre>";
			print_r($categoryList);
			echo "</pre>";

			$contentView = "ShopCategory";
			require_once(ROOT."/views/template/index.php");
		}

		public function actionRedirect($shortName1, $shortName2) {
			$categoryID = ShopCategory::getID(array($shortName1, $shortName2));
			new Redirect("/products/$categoryID");
		}

	}