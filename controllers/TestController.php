<?php

class TestController {
	
	public function actionTest() {
		echo "<pre>";

		var_dump(Validator::checkID("231", "image"));
		print_r(Validator::errorInfo());

		Product::findFirst(["id" => 1]);

		echo "</pre>";
	}

}