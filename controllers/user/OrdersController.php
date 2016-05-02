<?php

class OrdersController {

	public function actionIndex() {
		$client = Client::get();
		$indentList = $client->getIndentList();

		try {
			View::template("/user/order/index.php", compact("indentList"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("myorders view not found", $e);
		}
	}

}