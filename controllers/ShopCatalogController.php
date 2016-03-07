<?php

	class ShopCatalogController {

		const LIMIT_PRODUCT_LIST = 12;

		public static function actionIndex($categoryID, $page = 1) {
			$category = Category::findFirst("id = $categoryID");

			$offset = ($page - 1) * self::LIMIT_PRODUCT_LIST;
			$productList = Product::findAll("category_id = $categoryID", "id DESC",
				self::LIMIT_PRODUCT_LIST, $offset);

			$total = Product::findCount("category_id = $categoryID");
			$limit = self::LIMIT_PRODUCT_LIST;
			$pagination = new Pagination($total, $page, $limit, "page-");

			// echo "ID: $categoryID";
			// echo "<pre>";
			// print_r($productList);
			// echo "</pre>";

			$contentView = ROOT."/views/ShopCatalogView/index.php";
			require_once(ROOT."/views/template/index.php");
		}

	}