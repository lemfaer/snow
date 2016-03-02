<?php

class TestController {
	
	public function actionTest() {
		$c = Category::findFirst("id = 10");
		echo $c->link();
		$c = Category::findAll("parent_id = '9'", 1, 0);

		$c = Product::findFirst("id = 1");
		$c = Product::findAll("category_id = 1", 10, 0);

		echo "<pre>";
		print_r($c);
		echo "</pre>";
	}

}