<?php

class ProductController {

	const REC_COUNT = 4;
	const REC_SORT  = "rand()";

	public function actionIndex($id) {
		try {
			$productItem = ProductItem::findFirst(array("id" => $id));
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("product not found", $e);
		}

		try {
			$recomendedList = Product::findAll(array("is_recomended" => '1'), 
				self::REC_SORT, self::REC_COUNT);
		} catch(RecordNotFoundException $e) {
			$recomendedList = array();
		}

		View::template("shop/product/index.php", compact("productItem", "recomendedList"));
	}

}