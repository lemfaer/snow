<?php

class OrdersController {

	public function actionIndex() {
		$client = Client::get();
		$indentList = $client->getIndentList();
		View::template("user/order/index.php", compact("indentList"));
	}

}