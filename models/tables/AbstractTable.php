<?php

abstract class AbstractTable extends AbstractRecord {

//main info
	protected $id;
	protected $status;

	public function getID() : int {
		return self::get($this->id);
	}

	public function getStatus() : bool {
		return self::get($this->status);
	}

	protected function setID(int $id) { //void
		$this->id = self::set($id, $this->validator->checkID);
	}

	public function setStatus(bool $status) { //void
		$this->status = self::set($status, $this->validator->checkStatus);
	}

	protected function get($prop, $null = false) { //type of prop
		if(is_null($prop) && !$null) {
			throw new NullAccessException();
		}
		return $prop;
	}

	protected function set($value, Closure $checkMethod) { //type of value
		if(!$checkMethod($value)) {
			throw new WrongDataException($value);
		}
		return $value;
	}

	public function isNull() : bool {
		$bool = false;

		//no id check here

		//properties check
		$func = function($name, $value) use(&$bool) {
			$bool = $bool || is_null($value);
		};
		self::reflect($func);

		//status check
		$bool = $bool || is_null($this->status);

		return $bool;
	}

	public function isSaved() : bool {
		if(is_null($this->id) || $this->isNull()) {
			return false;
		}

		$class = get_class($this);
		try {
			$obj = $class::findFirst(array("id" => $this->id));
		} catch(QueryException $e) {
			throw new BadLogicException("object with id must be in database");
		}
		
		$bool = true;
		$rc = new ReflectionClass($obj);
		$func = function($name, $value) use($rc, $obj, &$bool) {
			$prop = $rc->getProperty($name);
			$prop->setAccessible(true);
			$bool = $bool && $value === $prop->getValue($obj);
		};
		self::reflect($func);

		return $bool;
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
		try {
			$result = DB::query($query, $binds);
		} catch(QueryException $e) {
			throw new RecordSelectException($e);
		}

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
		try {
			$result = DB::query($query, $binds);
		} catch(QueryException $e) {
			throw new RecordSelectException($e);
		}
		
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
		try {
			$result = DB::query($query, $binds);
		} catch(QueryException $e) {
			throw new RecordSelectException($e);
		}

		$objectList = $result->fetchAll();
		foreach ($objectList as $key => $value) {
			$objectList[$key] = $class::withArray($value);
		}

		return $objectList;
	}

	public function insert() {
		if(isset($this->id) || $this->isNull() || $this->errorInfo()) {
			throw new WrongDataException();
		}

		$class = get_class($this);
		$table = $class::TABLE;

		$insertArr = array();
		$func = function($name, $value) use(&$insertArr) {
			if($value instanceof self) {
				$name = $name."_id";
				$value = $value->getID();
			}
			$insertArr[$name] = $value;
		};
		self::reflect($func);
		$insertArr['status'] = $this->status; 

		$insert = self::buildInsert($insertArr);
		$binds = self::buildBinds($insertArr);

		$query = "INSERT into $table SET $insert";
		try {
			$result = DB::query($query, $binds);
		} catch(QueryException $e) {
			throw new RecordInsertException($e);
		}

		$id = DB::getConnection()->lastInsertId();
		$this->setID($id);
		
		return true;
	}

	public function update() {

	}

	public function delete() {
		
	}
//active record functions end

//get array
	public function getArray() : array {
		$arr['id'] = $this->id;
		$func = function($name, $value) use(&$arr) {
			if($value instanceof self) {
				$value = $value->getArray();
			}
			$arr[$name] = $value;
		};
		self::reflect($func);
		$arr['status'] = $this->status;
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