<?php

final class RegisterForm extends AbstractForm {

	private static function checkParams(array $data) : array {
		$validator = new UserValidator();

		$method = function(string $key) : string {
			switch ($key) {
				case "first_name":
					$m = "checkFirstName";
					break;
				case "last_name":
					$m = "checkLastName";
					break;
				case "email":
					$m = "checkEmail";
					break;
				case "login":
					$m = "checkLogin";
					break;
				case "password":
					$m = "checkPassword";
					break;
				default:
					throw new WrongDataException($key);
			}
			return $m;
		};

		return parent::checkParamsDefault($data, $method, $validator);
	}

	private static function checkCaptcha(string $captcha) : array {
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

	public static function check(array $data) : string {
		if(isset($data['captcha'])) {
			$captcha = self::checkCaptcha($data['captcha']);
			unset($data['captcha']);
		}

		$result = self::checkParams($data);

		if(isset($captcha)) {
			$result['captcha'] = $captcha;
			$result['success'] = $result['success'] && $captcha['success'];
		}

		return json_encode($result);
	}

	public static function submit(array $data) {
		$u = new User();

		$u->setFirstName($data['first_name']);
		$u->setLastName($data['last_name']);
		$u->setEmail($data['email']);
		$u->setLogin($data['login']);
		$u->setPassword($data['password']);
		$u->setStatus(true);
		$u->generateHash();

		$u->insert();
	}

}