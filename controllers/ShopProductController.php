<?php

	class ShopProductController {

		public function actionIndex($productID) {
			$productItem = ShopProduct::getItem($productID);
			$breadcrumbArray = ShopCategory::getBCArrayByProductID($productID);

			echo "ID: $productID";
			echo "<pre>";
			print_r($productItem);
			echo "<br>";
			print_r($breadcrumbArray);
			echo "</pre>";

			
		}

	}