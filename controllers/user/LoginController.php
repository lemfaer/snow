<?php

class LoginController {

	public function actionIndex() {
		if(Client::logged()) {
			header("location: /user/orders");
		}

		try {
			View::template("/user/login/index.php");
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("login form view not found", $e);
		}
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
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("wrong data from login form", $e);
		}
		header("location: /");
	}

}