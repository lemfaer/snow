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

//active record functions
	abstract public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int;

	abstract public static function findFirst(array $whereArr = array(), bool $nullStatus = false) : self;

	abstract public static function findAll(array $whereArr, string $order = "id ASC", int $limit = self::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array;

	abstract public function insert();

	abstract public function update();

	abstract public function delete();

}