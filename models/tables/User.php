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
	public function getID() {
		return $this->id;
	}

	public function getFirstName() {
		return $this->first_name;
	}

	public function getLastName() {
		return $this->last_name;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getLogin() {
		return $this->login;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getStatus() {
		return $this->status;
	}
	//getters end

	//setters
	private setID($id) {
		$this->id = $id;
	}

	public function setFirstName($first_name) {
		$this->first_name = $first_name;
	}

	public function setLastName($last_name) {
		$this->last_name = $last_name;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setLogin($login) {
		$this->login = $login;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function setStatus($status) {
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