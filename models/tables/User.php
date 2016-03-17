<?php

class User extends AbstractTable {

	const TABLE = "user"; 

//main info
	private $id;
	private $first_name;
	private $last_name;
	private $email;
	private $login;
	private $password;
	private $hash;
	private $status;

	//getters
	public function getID() : int {
		return parent::get($this->id);
	}

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

	public function getStatus() : bool {
		return parent::get($this->status);
	}
	//getters end

	//setters
	protected function setID(int $id) : bool {
		if ($this->validator->checkID($id)) {
			$this->id = $id;
			return true;
		}
		return false;
	}

	public function setFirstName(string $first_name) : bool {
		if ($this->validator->checkFirstName($first_name)) {
			$this->first_name = mb_convert_case($first_name, MB_CASE_TITLE, "UTF-8");
			return true;
		}
		return false;
	}

	public function setLastName(string $last_name) : bool {
		if ($this->validator->checkLastName($last_name)) {
			$this->last_name = mb_convert_case($last_name, MB_CASE_TITLE, "UTF-8");
			return true;
		}
		return false;
	}

	public function setEmail(string $email) : bool {
		if ($this->validator->checkEmail($email)) {
			$this->email = $email;
			return true;
		}
		return false;
	}

	public function setLogin(string $login) : bool {
		if ($this->validator->checkLogin($login)) {
			$this->login = $login;
			return true;
		}
		return false;
	}

	public function setPassword(string $password) : bool {
		if ($this->validator->checkPassword($password)) {
			$this->password = md5(md5($password));
			return true;
		}
		return false;
	}

	public function setStatus(bool $status) : bool {
		if ($this->validator->checkStatus($status)) {
			$this->status = $status;
			return true;
		}
		return false;
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

		$obj->id         = $arr['id'];
		$obj->first_name = $arr['first_name'];
		$obj->last_name  = $arr['last_name'];
		$obj->email      = $arr['email'];
		$obj->login      = $arr['login'];
		$obj->password   = $arr['password'];
		$obj->status     = $arr['status'];

		return $obj;
	}
//construct end

}