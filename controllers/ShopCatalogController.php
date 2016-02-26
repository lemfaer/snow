<?php

	class ShopCatalogController {

		public static function actionIndex($categoryID, $page = 1) {
			$productList = ShopProduct::getList($categoryID, $page);
			$categoryName = ShopCategory::getName($categoryID);
			$breadcrumbArray = ShopCategory::getBCArrayByCategoryID($categoryID);

			// echo "ID: $categoryID";
			// echo "<pre>";
			// print_r($productList);
			// echo "<br>";
			// print_r($breadcrumbArray);
			// echo "</pre>";

			$contentView = ROOT."/views/ShopCatalogView/index.php";
			require_once(ROOT."/views/template/index.php");
		}

	}