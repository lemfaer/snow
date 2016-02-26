<?php 

	class ShopCategoryController {

		public function actionIndex($shortName = null) {
			$categoryID = ShopCategory::getID(array($shortName));
			$categoryName = ShopCategory::getName($categoryID);
			$categoryList = ShopCategory::getList($categoryID);
			$breadcrumbArray = ShopCategory::getBCArrayByCategoryID($categoryID);

			// echo "ID: $categoryID";
			// echo "<pre>";
			// print_r($categoryList);
			// echo "<br>";
			// print_r($breadcrumbArray);
			// echo "</pre>";

			$contentView = ROOT."/views/ShopCategoryView/index.php";
			require_once(ROOT."/views/template/index.php");
		}

		public function actionRedirect($shortName1, $shortName2) {
			$categoryID = ShopCategory::getID(array($shortName1, $shortName2));
			new Redirect("/products/$categoryID");
		}

	}