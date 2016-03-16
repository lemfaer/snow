<?php

class UserRegisterController {

	public function actionIndex() {
		
		$contentView = ROOT."/views/UserRegisterView/index.php";
		require_once(ROOT."/views/template/index.php");
	}

	public function actionCheck() {
		$data = $_POST['regData'] ?? die("no data");
		new User();
		$vd = new UserValidator();

		if(!is_array($data[key($data)])) {
			$data = array($data);
		}

		$valMethod = function($key) : string {
			switch ($key) {
				case "first_name":
					$vdMethod = "checkFirstName";
					break;
				case "last_name":
					$vdMethod = "checkLastName";
					break;
				case "email":
					$vdMethod = "checkEmail";
					break;
				case "login":
					$vdMethod = "checkLogin";
					break;
				case "password":
					$vdMethod = "checkPassword";
					break;
				default:
					die("wrong data");
			}
			return $vdMethod;
		};

		$check = true;
		foreach ($data as $param) {
			$method = $valMethod($param['key']);
			$paramCheck = $vd->$method(strtoupper($param['value']));
			$result['single'][$param['key']] = $paramCheck;
			$check = $paramCheck && $check;
		}

		$result['error'] = $vd->errorInfo();
		$result['check'] = $check;

		echo json_encode($result);
	}

	public function actionSubmit() {
		$_SESSION['data'] = "hello";
		header("location: /register");
	}

}