<?php

class User extends AbstractTable {

	const TABLE = "user"; 

//main info
	//protected $id
	private $first_name;
	private $last_name;
	private $email;
	private $login;
	private $password;
	private $hash;
	//protected $status

	//getters
	public function getFirstName() : string {
		return parent::get($this->first_name);
	}

	public function getLastName() : string {
		return parent::get($this->last_name);
	}

	public function getEmail() : string {
		return parent::get($this->email);
	}

	public function getLogin() : string {
		return parent::get($this->login);
	}

	public function getPassword() : string {
		return parent::get($this->password);
	}

	public function getHash() : string {
		return parent::get($this->hash);
	}
	//getters end

	//setters
	public function setFirstName(string $first_name) {
		$first_name = mb_convert_case($first_name, MB_CASE_TITLE, "UTF-8");
		$this->first_name = parent::set($first_name, $this->validator->checkFirstName);
	}

	public function setLastName(string $last_name) {
		$last_name = mb_convert_case($last_name, MB_CASE_TITLE, "UTF-8");
		$this->last_name = parent::set($last_name, $this->validator->checkLastName);
	}

	public function setEmail(string $email) {
		$name = mb_convert_case($name, MB_CASE_LOWER, "UTF-8");
		$this->email = parent::set($email, $this->validator->checkEmail);
	}

	public function setLogin(string $login) {
		$this->login = parent::set($login, $this->validator->checkLogin);
	}

	public function setPassword(string $password) {
		$password = parent::set($password, $this->validator->checkPassword);
		$this->password = md5(md5($password));
	}
	//setters end

	public function generateHash() {
		$this->hash = md5(self::generateHashString());
	}

	private function generateHashString(int $n = 10) : string {
		$char = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
		$charLen = strlen($char) - 1;

		$str = "";
		while(strlen($str) < $n) {
			$str .= $char[mt_rand(0, $charLen)];
		}

		return $str;
	}
//main info end

//construct
	public function __construct() {
		$this->validator = new UserValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id         = (int)    $arr['id'];
		$obj->first_name = (string) $arr['first_name'];
		$obj->last_name  = (string) $arr['last_name'];
		$obj->email      = (string) $arr['email'];
		$obj->login      = (string) $arr['login'];
		$obj->password   = (string) $arr['password'];
		$obj->status     = (bool)   $arr['status'];

		return $obj;
	}
//construct end

}