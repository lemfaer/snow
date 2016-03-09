<?php

class UserRegisterController {

	public function actionIndex() {
		var_dump(isset($_SESSION['data']));
		$contentView = ROOT."/views/UserRegisterView/index.php";
		require_once(ROOT."/views/template/index.php");
	}

	public function actionSubmit() {
		$_SESSION['data'] = "hello";
		header("location: /register");
	}

}