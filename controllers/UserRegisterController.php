<?php

class UserRegisterController {

	public function actionIndex() {
		View::template("UserRegisterView/index.php");
	}

	public function actionCheck() {
		if(!isset($_POST['regData'])) {
			header("location: /register");
		}
		$data = $_POST['regData'];
		
		try {
			echo Register::check($data);
		} catch(WrongDataException $e) {
			die($e->getMessage().", привет=)");
		}
	}

	public function actionSubmit() {
		if(!isset($_POST['regData'])) {
			header("location: /register");
		}
		$data = $_POST['regData'];

		try {
			Register::submit($data);
			View::template("UserRegisterView/success.php");
		} catch(WrongDataException $e) {
			View::template("UserRegisterView/error.php");
		}
	}

}