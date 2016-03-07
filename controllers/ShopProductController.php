<?php

	class ShopProductController {

		public function actionIndex($productID) {
			$productItem = ProductItem::findFirst("id = $productID");
			$recomendedList = Product::findAll("is_recomended = '1'", "id DESC", 3);

			// echo "ID: $productID";
			// echo "<pre>";
			// print_r($productItem);
			// echo "<br>";
			// print_r($recomendedList);
			// echo "</pre>";

			$contentView = ROOT."/views/ShopProductView/index.php";
			require_once(ROOT."/views/template/index.php");
		}

	}