<?php

	class ProductController {

		public function actionIndex($productID) {
			$productItem = ProductItem::findFirst(array("id" => $productID));
			try {
				$recomendedList = Product::findAll(array("is_recomended" => '1'), "rand()", 4);
			} catch(QueryEmptyResultException $e) {
				$recomendedList = array();
			}

			// echo "ID: $productID";
			// echo "<pre>";
			// print_r($productItem);
			// echo "<br>";
			// print_r($recomendedList);
			// echo "</pre>";

			View::template("shop/product/index.php", compact("productItem", "recomendedList"));
		}

	}