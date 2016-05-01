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

	public function getIndentList() : array {
		$id = $this->id;
		try {
			$contact = Contact::findFirst(array("user_id" => $id));
		} catch(RecordNotFoundException $e) {
			return array();
		}

		$id = $contact->getID();
		try {
			$indentList = Indent::findAll(array("contact_id" => $id));
		} catch(RecordNotFoundException $e) {
			return array();
		}

		foreach ($indentList as $i => $indent) {
			$indentList[$i] = IndentItem::withIndent($indent);
		}

		return $indentList;
	}
	//getters end

	//setters
	public function setFirstName(string $first_name) {
		$first_name = mb_convert_case($first_name, MB_CASE_TITLE, "UTF-8");
		$this->first_name = parent::set($first_name, "checkFirstName");
	}

	public function setLastName(string $last_name) {
		$last_name = mb_convert_case($last_name, MB_CASE_TITLE, "UTF-8");
		$this->last_name = parent::set($last_name, "checkLastName");
	}

	public function setEmail(string $email) {
		$email = mb_convert_case($email, MB_CASE_LOWER, "UTF-8");
		$this->email = parent::set($email, "checkEmail");
	}

	public function setLogin(string $login) {
		$this->login = parent::set($login, "checkLogin");
	}

	public function setPassword(string $password) {
		$password = parent::set($password, "checkPassword");
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
		if(!$arr['id']) {
			return new Anonym();
		}

		$obj = new self();

		$obj->id         = (int)    $arr['id'];
		$obj->first_name = (string) $arr['first_name'];
		$obj->last_name  = (string) $arr['last_name'];
		$obj->email      = (string) $arr['email'];
		$obj->login      = (string) $arr['login'];
		$obj->password   = (string) $arr['password'];
		$obj->hash       = (string) $arr['hash'];
		$obj->status     = (bool)   $arr['status'];

		return $obj;
	}
//construct end

//active record functions
	/**
	 * Находит все записи по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @throws RecordNotFoundException записи не найдены
	 * @return array<AbstractRecord> записи
	 */
	public static function findAll(array $whereArr = array(), string $order = "id ASC", int $limit = self::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array {
		$userList = parent::findAll($whereArr, $order, $limit, $offset, $nullStatus);

		foreach ($userList as $i => $user) {
			if($user instanceof Anonym) {
				unset($userList[$i]);
			}
		}

		return array_values($userList);
	}
//active record functions end

}

class Anonym extends User {

	public function __construct() {
		$this->id = 0;
	}

	public function getID() : int {
		return $this->id;
	}

	public function getName() : string {
		return "Аноним";
	}

	public function isNull() : bool {
		return true;
	}

	public function isSaved() : bool {
		return true;
	}

	protected function get($prop) {
		throw new NullAccessException();
	}

	protected function set($value, string $checkMethod) {
		throw new NullAccessException();
	}

	public function insert() {
		throw new NullAccessException();
	}

	public function update() {
		throw new NullAccessException();
	}

	public function delete() {
		throw new NullAccessException();
	}

	public function getArray() : array {
		return array("id" => $this->id);
	}

}