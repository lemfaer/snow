<?php

class TestController {
	
	public function actionTest() {
		echo "<pre>";

		$c = new User();
		
		var_dump($c->setPassword("Hello1"));

		print_r($c->getArray());
		echo "<hr>";
		print_r($c->errorInfo());

		echo "</pre>";

		require_once(ROOT."/views/template/index.php");
	}

}