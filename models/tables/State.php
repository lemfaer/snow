<?php

class State extends AbstractTable {

//const
	const TABLE = "state";

	const STATE_NEW_ID    = 1;
	const STATE_TREAT_ID  = 2;
	const STATE_BRING_ID  = 3;
	const STATE_DONE_ID   = 4;
//const end

//default
	protected static $def = array();

	protected static $isDefaultInit = false;

	private static function initDefault() {
		if(!self::$isDefaultInit) {
			self::$def['new']    = self::findFirst(array("id" => self::STATE_NEW_ID), true);
			self::$def['treat']  = self::findFirst(array("id" => self::STATE_TREAT_ID), true);
			self::$def['bring']  = self::findFirst(array("id" => self::STATE_BRING_ID), true);
			self::$def['done']   = self::findFirst(array("id" => self::STATE_DONE_ID), true);

			self::$isDefaultInit = true;
		}
	}

	public static function default(string $name) : self {
		if(!self::$isDefaultInit) {
			self::initDefault();
		}

		if(isset(self::$def[$name])) {
			return self::$def[$name];
		}

		throw new WrongDataException($name, "wrong name");
	}
//default end

//main info
	//protected $id
	private $name;
	//protected $status

	//getters
	public function getName() : string {
		return parent::get($this->name);
	}
	//getters end

	//setters
	public function setName(string $name) {
		$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
		$this->name = parent::set($name, "checkName");
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new StateValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = (int)    $arr['id'];
		$obj->name   = (string) $arr['name'];
		$obj->status = (bool)   $arr['status'];

		return $obj;
	}
//construct end

}