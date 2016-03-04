<?php

class TestController {
	
	public function actionTest() {
		$category = Category::findFirst("id = 1");
		$product = Product::findFirst("id = 1");
		$productItem = ProductItem::findFirst("id = 1");
		$color 	= Color::findFirst("id = 1");
		$size 	= Size::findFirst("id = 1");
		$available = Available::findFirst("id = 1");

		echo "<pre>";
		print_r($category);
		echo "<hr>";
		print_r($product);
		echo "<hr>";
		print_r($productItem);
		echo "<hr>";
		print_r($color);
		echo "<hr>";
		print_r($size);
		echo "<hr>";
		print_r($available);
		echo "</pre>";
	}

}