<?php

	class ShopProductController {

		public function actionIndex($productID) {
			$productItem = ProductItem::findFirst(array("id" => $productID));
			$recomendedList = Product::findAll(array("is_recomended" => '1'), "id DESC", 3);

			// echo "ID: $productID";
			// echo "<pre>";
			// print_r($productItem);
			// echo "<br>";
			// print_r($recomendedList);
			// echo "</pre>";

			View::template("ShopProductView/index.php", compact("productItem", "recomendedList"));
		}

	}