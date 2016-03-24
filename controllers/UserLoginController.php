<?php

class UserLoginController {

	public function actionIndex() {
		View::template("UserLoginView/index.php");
	}

	public function actionCheck() {
		if(!isset($_POST['loginData'])) {
			header("location: /login");
		}
		$data = $_POST['loginData'];

		echo Login::check($data);
	}

	public function actionSubmit() {
		if(!isset($_POST['loginData'])) {
			header("location: /login");
		}
		$data = $_POST['loginData'];

		try {
			Login::submit($data);
			header("location: /category");
		} catch(WrongDataException $e) {
			View::template("UserLoginView/error.php");
		}
	}

}