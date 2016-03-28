<?php

class LoginController {

	public function actionIndex() {
		View::template("user/login/index.php");
	}

	public function actionCheck() {
		if(!isset($_POST['loginData'])) {
			header("location: /login");
		}
		$data = $_POST['loginData'];

		echo LoginForm::check($data);
	}

	public function actionSubmit() {
		if(!isset($_POST['loginData'])) {
			header("location: /login");
		}
		$data = $_POST['loginData'];

		try {
			LoginForm::submit($data);
			header("location: /profile");
		} catch(WrongDataException $e) {
			View::template("user/login/error.php");
		}
	}

}