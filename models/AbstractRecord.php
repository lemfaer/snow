<?php

abstract class AbstractRecord {

	const LIMIT_MAX = 9999;

	//construct
	protected function withArray(array $arr) {
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
				$value = $value->getArray();
			}
			$arr[$name] = $value;
		}
		return $arr;
	}

	private static function buildWhere(array $whereArr, $nullStatus) {
		$where = array();
		foreach ($whereArr as $key => $value) {
			if(is_array($value)) {
				$where[] = "FIND_IN_SET($key, :$key)";
			} else {
				$where[] = "$key = :$key";	
			}
		}

		(!$nullStatus) ? ($where[] = "status = '1'") : (null);
		$where = ($where = implode(" AND ", $where)) ? ("WHERE ".$where) : (null);

		return $where;
	}

	private static function buildBinds(array $whereArr) {
		$binds = array();
		foreach ($whereArr as $key => $value) {
			if(is_array($value)) {
				$value = implode(",", $value);
			}
			$binds[":$key"] = $value;
		}

		return $binds;
	} 

	public static function findFirst(array $whereArr = array(), $nullStatus = false) {
		$class = get_called_class();
		$table = $class::TABLE;

		$where = self::buildWhere($whereArr, $nullStatus);
		$binds = self::buildBinds($whereArr);

		$query = "SELECT * FROM $table 
			$where
			ORDER BY id ASC
			LIMIT 1";
		$result = DB::query($query, $binds);
		
		$arr = $result->fetch();
		$object = $class::withArray($arr);

		return $object;
	}

	public static function findCount(array $whereArr, $nullStatus = false) {
		$class = get_called_class();
		$table = $class::TABLE;

		$where = self::buildWhere($whereArr, $nullStatus);
		$binds = self::buildBinds($whereArr);

		$query = "SELECT count(*) FROM $table 
			$where";
		$result = DB::query($query, $binds);

		return array_shift($result->fetch());
	}

	public static function findAll(array $whereArr, $order = "id ASC", $limit = self::LIMIT_MAX, $offset = 0, $nullStatus = false) {
		$class = get_called_class();
		$table = $class::TABLE;

		$where = self::buildWhere($whereArr, $nullStatus);
		$binds = self::buildBinds($whereArr);

		$query = "SELECT * FROM $table 
			$where
			ORDER BY $order 
			LIMIT $limit 
			OFFSET $offset";
		$result = DB::query($query, $binds);

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