<?php

/**
 * Класс отвечает за авторизацию пользователей на сайте
 * 
 * @package models
 * @author  Alan Smithee
 * @final
 * @static
 */
final class Client {

	/**
	 * Авторизирует пользователя на сайте
	 * 
	 * @param User $user пользователь для авторизации
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function login(User $user) {
		try {
			$user->generateHash();
			$user->update();

			//set cookie 30 days
			setcookie("id",   $user->getID(),   time() + 60 * 60 * 24 * 30, "/");
			setcookie("hash", $user->getHash(), time() + 60 * 60 * 24 * 30, "/");
		} catch(NullAccessException $e) {
			throw new WrongDataException($user, "wrong data for client login", $e);
		} catch(WrongDataException $e) {
			throw new WrongDataException($user, "wrong data for client login", $e);
		}
	}

	/**
	 * Проверяет, авторизован ли пользователь
	 * 
	 * @return bool вошел ли пользователь на сайт
	 */
	public static function logged() : bool {
		if(isset($_COOKIE['id']) && isset($_COOKIE['hash'])) {
			try {
				$user = User::findFirst(array(
					"id"   => $_COOKIE['id'],
					"hash" => $_COOKIE['hash'],
				));
				return true;
			} catch(RecordNotFoundException $e) {}
		}
		return false;
	}

	/**
	 * Возвращает пользователя, или переадресует на страницу авторизации
	 * 
	 * @return User пользователь
	 */
	public static function get() : User {
		if(!self::logged()) {
			header("location: /login");
		}

		try {
			$user = User::findFirst(array(
				"id"   => $_COOKIE['id'],
				"hash" => $_COOKIE['hash'],
			));
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("user is logged checked", $e);
		}

		return $user;
	}

	/**
	 * Совершает выход пользователя на сайте
	 * 
	 * @throws ClientNotExistsException пользователь не авторизирован
	 * @return void
	 */
	public static function logout() {
		if(!self::logged()) {
			throw new ClientNotExistsException("no client");
		}

		unset($_COOKIE['id']);
		unset($_COOKIE['hash']);

		setcookie("id", null, -1, "/");
		setcookie("hash", null, -1, "/");
	}

}