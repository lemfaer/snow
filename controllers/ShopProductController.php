<?php

	class ShopProductController {

		public function actionIndex($productID) {
			$productItem = ShopProduct::getItem($productID);

			echo "ID: $productID";
			echo "<pre>";
			print_r($productItem);
			echo "</pre>";
		}

	}