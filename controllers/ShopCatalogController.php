<?php

	class ShopCatalogController {

		public static function actionIndex($categoryID, $page = 1) {
			$productList = ShopProduct::getList($categoryID, $page);

			echo "ID: $categoryID";
			echo "<pre>";
			print_r($productList);
			echo "</pre>";
		}

	}