<?php

class State extends AbstractTable {

	const TABLE = "state";

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