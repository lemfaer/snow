<?php

final class Login extends AbstractForm {

	const LOGIN_ERROR = "Неправильный логин или пароль";

	private static function findUser(array $data) : User {
		if(!isset($data['elo']) || !isset($data['password'])) {
			throw new WrongDataException($data);
		}

		$elo = $data['elo'];
		$eloKey = (filter_var($elo, FILTER_VALIDATE_EMAIL)) ? ("email") : ("login");
		$password = $data['password'];
		$where = array(
			$eloKey => $elo,
			"password" => $password,
		);

		return User::findFirst($where);
	}

	public static function check(array $data) : string {
		try {
			$user = self::findUser($data);
			$bool = true;
		} catch(RecordSelectException $e) {
			$bool = false;
		}
		$result['success'] = $bool;
		$result['error'] = ($bool) ? ('') : (self::LOGIN_ERROR);

		return json_encode($result);
	}

	public static function submit(array $data) {
		try {
			$user = self::findUser($data);
		} catch(RecordSelectException $e) {
			throw new WrongDataException($data);
		}

	}

}