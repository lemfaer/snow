<?php

class TestController {
	
	public function actionTest() {
		$category = Category::findFirst("id = 11");

		echo "<pre>";
		print_r($category->getArray());
		echo "</pre>";

	}

}