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
		$this->id = parent::set($id, $this->validator->checkID);
	}

	public function setFirstName(string $first_name) : bool {
		$this->first_name = parent::set($first_name, $this->validator->checkFirstName);
	}

	public function setLastName(string $last_name) : bool {
		$this->last_name = parent::set($last_name, $this->validator->checkLastName);
	}

	public function setEmail(string $email) : bool {
		$this->email = parent::set($email, $this->validator->checkEmail);
	}

	public function setLogin(string $login) : bool {
		$this->login = parent::set($login, $this->validator->checkLogin);
	}

	public function setPassword(string $password) : bool {
		$password = parent::set($password, $this->validator->checkPassword);
		$this->password = md5(md5($password));
	}

	public function setStatus(bool $status) : bool {
		$this->status = parent::set($status, $this->validator->checkStatus);
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