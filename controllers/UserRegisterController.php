<?php

class UserRegisterController {

	public function actionIndex() {
		$contentView = ROOT."/views/UserRegisterView/index.php";
		require_once(ROOT."/views/template/index.php");
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
			$contentView = ROOT."/views/UserRegisterView/success.php";
		} catch(WrongDataException $e) {
			$contentView = ROOT."/views/UserRegisterView/error.php";
		}

		require_once(ROOT."/views/template/index.php");
	}

}