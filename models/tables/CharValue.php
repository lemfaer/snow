<?php

class CharValue extends AbstractTable {

	const TABLE = "char_value";

//main info
	//protected $id
	private $name; //class
	private $value;
	//protected $status

	//getters
	public function getName() : CharName {
		return parent::get($this->name);
	}

	public function getValue() : string {
		return parent::get($this->value);
	}
	//getters end

	//setters
	public function setName(CharName $name) {
		$this->name = parent::set($name, $this->validator->checkName);
	}

	public function setValue(string $value) {
		$value = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
		$this->value = parent::set($value, $this->validator->checkValue);
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new CharValueValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = (int)    $arr['id'];
		$obj->value  = (string) $arr['value'];
		$obj->status = (bool)   $arr['status'];

		$name      = CharName::findFirst(array("id" => $arr['name_id']));
		$obj->name = $name;

		return $obj;
	}
//construct end

}