<?php

class UserRegisterController {

	public function actionIndex() {
		$contentView = ROOT."/views/UserRegisterView/index.php";
		require_once(ROOT."/views/template/index.php");
	}

	private function checkParams(array $data) : array {
		new User();
		$vd = new UserValidator();

		if(!is_array($data[key($data)])) {
			$data = array($data);
		}

		$valMethod = function(string $key) : string {
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
		foreach ($data as $p) {
			if(!is_array($p)) {
				continue;
			}
			$method = $valMethod($p['key']);
			$paramCheck = $vd->$method(mb_strtoupper($p['value']));
			$result['single'][$p['key']] = $paramCheck;
			$check = $paramCheck && $check;
		}

		$result['error'] = $vd->errorInfo();
		$result['success'] = $check;

		return $result;
	}

	private function checkCaptcha(string $captcha) : array {
		$secret = "6Ld9xhoTAAAAAI7mXt9KS07zbyxsZbG1aORIURm4";
			
		$postfields = http_build_query(array(
			"secret" => $secret,
			"response" => $captcha
		));

		$ch = curl_init();
		$opt = array(
			CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify",
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postfields,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $opt);

		return json_decode(curl_exec($ch), true);
	}

	public function actionCheck() {
		$data = $_POST['regData'] ?? header("location: /register");
		
		if(isset($data['captcha'])) {
			$captcha = $this->checkCaptcha($data['captcha']);
			unset($data['captcha']);

			$result = $this->checkParams($data);
			$result['captcha'] = $captcha;
			$result['success'] = $result['success'] && $captcha['success'];
		} else {
			$result = $this->checkParams($data);
		}

		echo json_encode($result);
	}

	public function actionSubmit() {
		$data = $_POST['regform'] ?? header("location: /register");

		$contentView = ROOT."/views/UserRegisterView/submit.php";
		require_once(ROOT."/views/template/index.php");
	}

}