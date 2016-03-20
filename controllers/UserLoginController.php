<?php

class UserLoginController {

	public function actionIndex() {
		$contentView = ROOT."/views/UserLoginView/index.php";
		require_once(ROOT."/views/template/index.php");
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

		print_r($data);
	}

}