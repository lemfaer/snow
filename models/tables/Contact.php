<?php

class Contact extends AbstractTable {

	const TABLE = "contact";

//main info
	//protected $id
	private $name;
	private $phone;
	private $address;
	private $user;
	//protected $status

	//getters
	public function getName() : string {
		return parent::get($this->name);
	}

	public function getPhone() : string {
		return parent::get($this->phone);
	}

	public function getAddress() : string {
		return parent::get($this->address);
	}

	public function getUser() : User {
		return parent::get($this->user);
	}
	//getters end

	//setters
	public function setName(string $name) {
		$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
		$this->name = parent::set($name, "checkName");
	}

	public function setPhone(string $phone) {
		$this->phone = parent::set($phone, "checkPhone");
	}

	public function setAddress(string $address) {
		$this->address = parent::set($address, "checkAddress");
	}

	public function setUser(User $user) {
		$this->user = parent::set($user, "checkUser");
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new ContactValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id      = (int)    $arr['id'];
		$obj->name    = (string) $arr['name'];
		$obj->phone   = (string) $arr['phone'];
		$obj->address = (string) $arr['address'];
		$obj->status  = (bool)   $arr['status'];

		try {
			$user = User::findFirst(array("id" => $arr['user_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['user_id'], "wrong id in db", $e));
		}
		$obj->user = $user;

		return $obj;
	}
//construct end

}