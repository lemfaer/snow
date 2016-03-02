<?php

abstract class AbstractRecord {

	protected static function findFirstDefault($class, $table, $where, $nullStatus) {
		$status = ($nullStatus) ? ("") : ("AND status = '1'");
		$query = "SELECT * FROM $table 
			WHERE $where $status 
			LIMIT 1";
		$result = DB::query($query);
		$arr = $result->fetch();

		$object = new $class();
		$object->setByArray($arr);

		return $object;
	}

	protected static function findAllDefault($class, $table, $where, $limit, $offset, $order, $nullStatus) {
		$status = ($nullStatus) ? ("") : ("AND status = '1'");
		$query = "SELECT * FROM $table 
			WHERE $where $status 
			ORDER BY $order 
			LIMIT $limit 
			OFFSET $offset";
		$result = DB::query($query);

		$objectList = $result->fetchAll();
		foreach ($objectList as $key => $value) {
			$object = new $class();
			$object->setByArray($value);
			$objectList[$key] = $object;
		}

		return $objectList;
	}

	abstract public static function findFirst($where, $nullStatus);

	abstract public static function findAll($where, $limit, $offset, $order, $nullStatus);

	abstract public function insert();

	abstract public function update();

	abstract public function delete();

	//reflection
	abstract public function getArray();

	abstract protected function setByArray($arr);

}