<?php

class RegisterController {

	public function actionIndex() {
		if(Client::logged()) {
			header("location: /user/orders");
		}
		
		try {
			View::template("/user/register/index.php");
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("register form view not found", $e);
		}
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
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("wrong data from register form", $e);
		}

		try {
			View::template("/user/register/success.php");
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("register success view not found");
		}
	}

}