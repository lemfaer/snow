<?php

class TestController {
	
	public function actionTest() {
		echo "<pre>";

		$t1 = microtime(true);
		DB::getConnection();
		$t2 = microtime(true);
		echo $t2 - $t1."<br>";

		var_dump(Validator::checkID("231", "image"));
		print_r(Validator::errorInfo());

		echo "</pre>";
	}

}