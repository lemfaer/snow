<?php

abstract class AbstractRecord {

	const LIMIT_MAX = 9999;

	//construct
	protected function withArray($arr) {
		return null;
	}

	public function getArray() {
		$rc = new ReflectionClass($this);
		$arr = array();
		foreach ($rc->getProperties() as $value) {
			$value->setAccessible(true);
			$name = $value->getName();
			$value = $value->getValue($this);

			if(is_object($value)) {
				$name .= "_id";
				$value = $value->getArray();
			}
			$arr[$name] = $value;
		}
		return $arr;
	}

	public static function findFirst($where, $nullStatus = false) {
		$class = get_called_class();
		$table = $class::TABLE;

		$status = ($nullStatus) ? ("") : ("AND status = '1'");
		$query = "SELECT * FROM $table 
			WHERE $where $status
			ORDER BY id ASC
			LIMIT 1";
		$result = DB::query($query);
		
		$arr = $result->fetch();
		$object = $class::withArray($arr);

		return $object;
	}

	public static function findCount($where, $nullStatus = false) {
		$class = get_called_class();
		$table = $class::TABLE;

		$status = ($nullStatus) ? ("") : ("AND status = '1'");
		$query = "SELECT count(*) FROM $table 
			WHERE $where $status";
		$result = DB::query($query);

		return array_shift($result->fetch());
	}

	public static function findAll($where, $order = "id ASC", $limit = self::LIMIT_MAX, $offset = 0, $nullStatus = false) {
		$class = get_called_class();
		$table = $class::TABLE;

		$status = ($nullStatus) ? ("") : ("AND status = '1'");
		$query = "SELECT * FROM $table 
			WHERE $where $status 
			ORDER BY $order 
			LIMIT $limit 
			OFFSET $offset";
		$result = DB::query($query);

		$objectList = $result->fetchAll();
		foreach ($objectList as $key => $value) {
			$objectList[$key] = $class::withArray($value);
		}

		return $objectList;
	}

	abstract public function insert();

	abstract public function update();

	abstract public function delete();

}