<?php

	class ShopProductController {

		public function actionIndex($productID) {
			$product = ShopProduct::getItem($productID);
			$recomendedList = ShopProduct::getRecList();
			$breadcrumbArray = ShopCategory::getBCArrayByProductID($productID);

			// echo "ID: $productID";
			// echo "<pre>";
			// print_r($product);
			// echo "<br>";
			// print_r($breadcrumbArray);
			// echo "</pre>";

			$contentView = ROOT."/views/ShopProductView/index.php";
			require_once(ROOT."/views/template/index.php");
		}

	}