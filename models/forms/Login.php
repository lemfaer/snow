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
		} catch(RecordSelectException $e) {
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
		try {
			$user = self::findUser($data);
		} catch(RecordSelectException $e) {
			throw new WrongDataException($data);
		}

	}

}