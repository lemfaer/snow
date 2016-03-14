<?php

class UserRegisterController {

	public function actionIndex() {
		
		$contentView = ROOT."/views/UserRegisterView/index.php";
		require_once(ROOT."/views/template/index.php");
	}

	public function actionSubmit() {
		$_SESSION['data'] = "hello";
		header("location: /register");
	}

}