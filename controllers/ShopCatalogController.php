<?php

	class ShopCatalogController {

		const LIMIT_PRODUCT_LIST = 12;
		const SORT_ORDER = "id DESC";

		public static function actionIndex($categoryID, $page = 1) {
			$category = Category::findFirst(array("id" => $categoryID));
			
			$order = self::SORT_ORDER;
			$limit = self::LIMIT_PRODUCT_LIST;
			$offset = ($page - 1) * $limit;
			$total = Product::findCount(array("category_id" => $categoryID));

			$productList = Product::findAll(array("category_id" => $categoryID), $order,
				$limit, $offset);

			$pagination = new Pagination($total, $page, $limit, "page-");

			// echo "ID: $categoryID";
			// echo "<pre>";
			// print_r($productList);
			// echo "</pre>";

			$contentView = ROOT."/views/ShopCatalogView/index.php";
			require_once(ROOT."/views/template/index.php");
		}

	}