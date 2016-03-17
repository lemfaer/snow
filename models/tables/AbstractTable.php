<?php

abstract class AbstractTable extends AbstractRecord {

//main info
	abstract public function getID() : int;
	abstract protected function setID(int $id);

	protected function get($prop) { //type of prop
		if(!isset($prop)) {
			throw new Exception("Access to null", 1);
		}
		return $prop;
	}

	protected function set($value, Closure $valueCheckMethod) { //type of value
		if(!$valueCheckMethod($value)) {
			throw new Exception("Wrond data", 1);
		}
		return $value;
	}
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

	private static function buildInsert(array $insertArr) : string {
		$insert = array();
		foreach ($insertArr as $key => $value) {
			$insert[] = "$key = :$key";
		}
		$insert = implode(", ", $insert);

		return $insert;
	}

	private static function buildBinds(array $arr) : array {
		$binds = array();
		foreach ($arr as $key => $value) {
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
		if($this->errorInfo() || $this->getID()) {
			return false;
		} // to exception

		$class = get_class($this);
		$table = $class::TABLE;

		$insertArr = array();
		$func = function($name, $value) use(&$insertArr) {
			if($value instanceof self) {
				$name = $name."_id";
				$value = $value->getID();
			}
			if($name === "id") {
				return;
			}
			$insertArr[$name] = $value;
		};
		self::reflect($func);

		$insert = self::buildInsert($insertArr);
		$binds = self::buildBinds($insertArr);

		$query = "INSERT into $table SET $insert";
		$result = DB::query($query, $binds);

		$id = DB::getConnection()->lastInsertId();
		$this->setID($id);
		
		return true;
	}

	public function update() : bool {

	}

	public function delete() : bool {
		
	}
//active record functions end

//get array
	public function getArray() : array {
		$arr = array();
		$func = function($name, $value) use(&$arr) {
			if($value instanceof self) {
				$value = $value->getArray();
			}
			$arr[$name] = $value;
		};
		self::reflect($func);
		return $arr;
	}
//get array end

//reflection
	private function reflect(Closure $func) {
		$rc = new ReflectionClass($this);
		foreach ($rc->getProperties() as $prop) {
			if(!$prop->isPrivate()) {
				continue;
			} 
			$prop->setAccessible(true);
			$name = $prop->getName();
			$value = $prop->getValue($this);
			$func($name, $value);
		}
	}
//reflection end

}