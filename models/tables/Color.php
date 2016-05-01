<?php

class Color extends AbstractTable {

	const TABLE = "color";

//main info
	//protected $id
	private $name;
	private $value;
	//protected $status

	//getters
	public function getName() : string {
		return parent::get($this->name);
	}

	public function getValue() : string {
		return parent::get($this->value);
	}
	//getters end

	//setters
	public function setName(string $name) {
		$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
		$this->name = parent::set($name, "checkName");
	}

	public function setValue(string $value) {
		$value = mb_convert_case($value, MB_CASE_UPPER, "UTF-8");
		$this->value = parent::set($value, "checkValue");
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new ColorValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		if(!$arr['id']) {
			return new DefaultColor();
		}

		$obj = new self();

		$obj->id     = (int)    $arr['id'];
		$obj->name   = (string) $arr['name'];
		$obj->value  = (string) $arr['value'];
		$obj->status = (bool)   $arr['status'];

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
		$colorList = parent::findAll($whereArr, $order, $limit, $offset, $nullStatus);

		foreach ($colorList as $i => $color) {
			if($color instanceof DefaultColor) {
				unset($colorList[$i]);
			}
		}

		return array_values($colorList);
	}
//active record functions end

}

class DefaultColor extends Color {

	public function __construct() {
		$this->id = 0;
	}

	public function getID() : int {
		return $this->id;
	}

	public function getName() : string {
		return "По умолчанию";
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