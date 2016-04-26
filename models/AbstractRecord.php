<?php

abstract class AbstractRecord {

//const
	const LIMIT_MAX = 9999;
//const end

//validator
	protected $validator;

	public function errorInfo() : array {
		return $this->validator->errorInfo();
	}
//validator end

//main info
	/**
	 * Выполняет действия перед возвращением свойств
	 * 
	 * @param mixed $prop 
	 * @throws NullAccessException поле не заполнено
	 * @return mixed (type of $prop) переданное свойство
	 */
	protected function get($prop) {
		if(!isset($prop)) {
			throw new NullAccessException();
		}
		return $prop;
	}

	/**
	 * Выполняет действия перед установкой значений в свойства
	 * 
	 * @param mixed $value переданное значение
	 * @param string $checkMethod метод для проверки переданного значения
	 * @throws WrongDataException передано неправильное значение
	 * @return mixed (type of $value) переданное значение
	 */
	protected function set($value, string $checkMethod) {
		if(!$this->validator->$checkMethod($value)) {
			throw new WrongDataException($value, implode(", ", $this->errorInfo()));
		}
		return $value;
	}
//main info end

//active record functions
	abstract public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int;

	abstract public static function findFirst(array $whereArr = array(), bool $nullStatus = false) : self;

	abstract public static function findAll(array $whereArr, string $order = "id ASC", int $limit = self::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array;

	abstract public function insert();

	abstract public function update();

	abstract public function delete();

}