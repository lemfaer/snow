<?php

class TestController {
	
	public function actionTest() {
		echo "<pre>";

		$av = new Available();
		var_dump($av->setID(-1));
		print_r($av->errorInfo());

		echo "</pre>";
	}

}