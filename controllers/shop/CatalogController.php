<?php

class CatalogController {

	const LIMIT_PRODUCT_LIST = 12;
	const SORT_ORDER = "id DESC";

	public static function actionIndex($id, $page = 1) {
		try {
			$category = Category::findFirst(array("id" => $id));
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("category not found", $e);
		}
		
		$order  = self::SORT_ORDER;
		$limit  = self::LIMIT_PRODUCT_LIST;
		$offset = ($page - 1) * $limit;
		$total  = Product::findCount(array("category_id" => $id));

		try {
			$productList = Product::findAll(array("category_id" => $id), $order,
				$limit, $offset);
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("products not found", $e);
		}

		$pagination = new Pagination($total, $page, $limit, "page-");

		View::template("shop/catalog/index.php", 
			compact("category", "productList", "pagination"));
	}

}