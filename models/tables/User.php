<?php

class User extends AbstractRecord {

//main info
	private $id;
	private $first_name;
	private $last_name;
	private $email;
	private $login;
	private $password;
	private $status;

	//getters
	public function getID() : int {
		return $this->id;
	}

	public function getFirstName() : string {
		return $this->first_name;
	}

	public function getLastName() : string {
		return $this->last_name;
	}

	public function getEmail() : string {
		return $this->email;
	}

	public function getLogin() : string {
		return $this->login;
	}

	public function getPassword() : string {
		return $this->password;
	}

	public function getStatus() : bool {
		return $this->status;
	}
	//getters end

	//setters
	private setID(int $id) {
		$this->id = $id;
	}

	public function setFirstName(string $first_name) {
		$this->first_name = $first_name;
	}

	public function setLastName(string $last_name) {
		$this->last_name = $last_name;
	}

	public function setEmail(string $email) {
		$this->email = $email;
	}

	public function setLogin(string $login) {
		$this->login = $login;
	}

	public function setPassword(string $password) {
		$this->password = $password;
	}

	public function setStatus(bool $status) {
		$this->status = $status;
	}
	//setters end
//main info end

//abstract methods realization
	public function insert();

	public function update();

	public function delete();
//abstract methods realization end

}

class UserValidator extends Validator {
	
	public static function checkID($id) {
		
	}

}