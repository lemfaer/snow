<?php

/**
 * Класс обрабатывает запросы формы авторизации
 * 
 * @package models_forms
 * @author  Alan Smithee
 * @final
 */
final class Login extends AbstractForm {

	const LOGIN_ERROR = "Неправильный логин или пароль";

	/**
	 * Находит user по массиву переданному из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return User полученный user из бд
	 */
	private static function findUser(array $data) : User {
		if(!isset($data['elo']) || !isset($data['password'])) {
			throw new WrongDataException($data, "not set email/login or password");
		}

		$elo = $data['elo'];
		$eloKey = (filter_var($elo, FILTER_VALIDATE_EMAIL)) ? ("email") : ("login");
		$password = $data['password'];
		$where = array(
			$eloKey => $elo,
			"password" => $password,
		);

		try {
			$user = User::findFirst($where);
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($data, "user no found", $e);
		}
		return $user;
	}

	/**
	 * Проверяет есть ли user в бд
	 * 
	 * @param array $data массив переданный из формы
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		try {
			$user = self::findUser($data);
			$bool = true;
		} catch(WrongDataException $e) {
			$bool = false;
		}
		$result['success'] = $bool;
		$result['error'] = ($bool) ? ('') : (self::LOGIN_ERROR);

		return json_encode($result);
	}

	/**
	 * Авторизирует пользователя на сайте
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function submit(array $data) {
		$user = self::findUser($data);
		$user->generateHash();
			
		try {
			$user->update();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}

		//set cookie 30 days
		setcookie("id",   $user->getID(),   time() + 60 * 60 * 24 * 30);
		setcookie("hash", $user->getHash(), time() + 60 * 60 * 24 * 30);
	}

}