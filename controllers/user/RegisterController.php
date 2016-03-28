<?php

class RegisterController {

	public function actionIndex() {
		View::template("user/register/index.php");
	}

	public function actionCheck() {
		if(!isset($_POST['regData'])) {
			header("location: /register");
		}
		$data = $_POST['regData'];
		
		try {
			echo RegisterForm::check($data);
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
			RegisterForm::submit($data);
			View::template("user/register/success.php");
		} catch(WrongDataException $e) {
			View::template("user/register/error.php");
		}
	}

}