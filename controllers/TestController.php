<?php

class TestController {
	
	public function actionTest() {

		echo "<pre>";
		$categoryList = Category::findAll(array("parent_id" => array(11,12), "short_name" => "one"));
			
		foreach ($categoryList as $category) {
			print_r($category->getArray());
		}
			
		echo "</pre>";

	}

}