<?php

abstract class AbstractTable extends AbstractRecord {

//main info
	abstract public function getID();
	abstract protected function setID(int $id) : bool;
//main info end

//construct
	abstract protected static function withArray(array $arr) : self;
//construct end

//active record functions
	private static function buildWhere(array $whereArr, bool $nullStatus) : string {
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

	private static function buildBinds(array $whereArr) : array {
		$binds = array();
		foreach ($whereArr as $key => $value) {
			if(is_array($value)) {
				$value = implode(",", $value);
			}
			$binds[":$key"] = $value;
		}

		return $binds;
	} 

	public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int {
		$class = get_called_class();
		$table = $class::TABLE;

		$where = self::buildWhere($whereArr, $nullStatus);
		$binds = self::buildBinds($whereArr);

		$query = "SELECT count(*) FROM $table 
			$where";
		$result = DB::query($query, $binds);

		$result = $result->fetch();
		return array_shift($result);
	}

	public static function findFirst(array $whereArr = array(), bool $nullStatus = false) : AbstractRecord {
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

	public static function findAll(array $whereArr, string $order = "id ASC", int $limit = self::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array {
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

	public function insert() : bool {

	}

	public function update() : bool {

	}

	public function delete() : bool {
		
	}
//active record functions end

//get array
	public function getArray() : array {
		$rc = new ReflectionClass($this);
		$arr = array();
		foreach ($rc->getProperties() as $value) {
			$value->setAccessible(true);
			$name = $value->getName();
			$value = $value->getValue($this);

			if(is_object($value)) {
				if($value instanceof self) {
					$value = $value->getArray();
				} else {
					continue;
				}
			}
			$arr[$name] = $value;
		}
		return $arr;
	}
//get array end

}