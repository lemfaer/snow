<?php
/**
 * Класс описывает структуру классов-таблиц
 * 
 * Класс описывает структуру и поведение классов представляющих 
 * таблицы в базе данных. Класс реализует абстрактные методы
 * findCount, findFirst, findAll, insert, update, delete
 * для поиска, добавления, обновления, и удаления нужных записей 
 * 
 * @package  models_tables
 * @author   Alan Smithee
 * @abstract
 */
abstract class AbstractTable extends AbstractRecord {

//main info
	/**
	 * @var int  $id     Уникальный идентификатор, обязательное поле таблицы
	 * @var bool $status Статус, обязательное поле таблицы
	 */
	protected $id;
	protected $status;

	/**
	 * Возвращает идентификатор записи
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return int идентификатор
	 */
	public function getID() : int {
		return self::get($this->id);
	}

	/**
	 * Возвращает статус записи
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return bool статус
	 */
	public function getStatus() : bool {
		return self::get($this->status);
	}

	/**
	 * Устанавливает идентификатор записи
	 * 
	 * @param int $id идентификатор записи
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	protected function setID(int $id) {
		$this->id = self::set($id, $this->validator->checkID);
	}

	/**
	 * Устанавливает идентификатор записи
	 * 
	 * @param bool $status статус записи
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setStatus(bool $status) {
		$this->status = self::set($status, $this->validator->checkStatus);
	}

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
	 * @param Closure $checkMethod метод для проверки переданного значения
	 * @throws WrongDataException передано неправильное значение
	 * @return mixed (type of $value) переданное значение
	 */
	protected function set($value, Closure $checkMethod) {
		if(!$checkMethod($value)) {
			throw new WrongDataException($value, implode(", ", $this->errorInfo()));
		}
		return $value;
	}

	/**
	 * Проверяет заполнены ли свойства объекта значениями отличными от null
	 * Проверка исключает индентификатор объекта
	 * 
	 * Возвращает true если одно или несколько свойств не заполнены
	 * Возвращает false если все свойства(не включая идентификатор заполнены)
	 * 
	 * @return bool заполнен ли объект
	 */
	public function isNull() : bool {
		$bool = false;

		//no id check here

		//properties check
		$func = function($name, $value) use(&$bool) {
			$bool = $bool || !isset($value);
		};
		self::reflect($func);

		//status check
		$bool = $bool || !isset($this->status);

		return $bool;
	}

	/**
	 * Проверяет сохраненен ли объект в базе данных
	 * 
	 * Возвращает true если свойства обьекта совпадают со значениями в базе данных
	 * Возвращает false усли одно или несколько свойств не совпадают со значениями в базе данных
	 * 
	 * @return bool сохранен ли объект
	 */
	public function isSaved() : bool {
		if(!isset($this->id) || $this->isNull()) {
			return false;
		}

		$class = get_class($this);

		try {
			$obj = $class::findFirst(array("id" => $this->id), !$this->getStatus());
		} catch(QueryEmptyResultException $e) {
			throw new UncheckedQueryException("object with id must be in db", $e);
		}
		
		$bool = true;
		$rc = new ReflectionClass($obj);
		$func = function($name, $value) use($rc, $obj, &$bool) {
			$prop = $rc->getProperty($name);
			$prop->setAccessible(true);
			$valueDB = $prop->getValue($obj);
			
			if($value instanceof self and $valueDB instanceof self) {
				$value = $value->getID();
				$valueDB = $valueDB->getID();
			}

			$bool = $bool && $value === $valueDB;
		};
		self::reflect($func);

		return $bool;
	}
//main info end

//construct
	/**
	 * Конструктор
	 * 
	 * @param array $arr массив полученный из базы данных
	 * @return AbstractTable обьект класса
	 */
	abstract protected static function withArray(array $arr) : self;
//construct end

//active record functions
	/**
	 * Формирует составную часть запроса WHERE
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @return string составная часть запроса WHERE
	 */
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

	/**
	 * Формирует составную часть запроса SET
	 * 
	 * @param array $whereArr параметры запроса вставки/удаления
	 * @return string составная часть запроса SET
	 */
	private static function buildSet(array $insertArr) : string {
		$insert = array();
		foreach ($insertArr as $key => $value) {
			$insert[] = "$key = :$key";
		}
		$insert = "SET ".implode(", ", $insert);

		return $insert;
	}

	/**
	 * Формирует массив привязки параметров запроса к переменным
	 * 
	 * @param array $arr параметры запроса
	 * @return array массив привязки параметров запроса к переменным
	 */
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

	/**
	 * Находит количество записей по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @return int количество найденных записей
	 */
	public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int {
		$class = get_called_class();
		$table = $class::TABLE;

		$where = self::buildWhere($whereArr, $nullStatus);
		$binds = self::buildBinds($whereArr);

		$query = "SELECT count(*) FROM $table 
			$where";
			
		try {
			$result = DB::query($query, $binds);
		} catch(QueryEmptyResultException $e) {
			throw new UncheckedQueryException("findCount must return smth", $e);
		}

		$result = $result->fetch();
		return array_shift($result);
	}

	/**
	 * Находит первую запись по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @throws RecordNotFoundException запись не найдена
	 * @return AbstractRecord первая запись
	 */
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
		} catch(QueryEmptyResultException $e) {
			throw new RecordNotFoundException($e);
		}
		
		$arr = $result->fetch();
		$object = $class::withArray($arr);

		return $object;
	}

	/**
	 * Находит все записи по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @throws RecordNotFoundException записи не найдены
	 * @return array<AbstractRecord> записи
	 */
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
		} catch(QueryEmptyResultException $e) {
			throw new RecordNotFoundException($e);
		}

		$objectList = $result->fetchAll();
		foreach ($objectList as $key => $value) {
			$objectList[$key] = $class::withArray($value);
		}

		return $objectList;
	}

	/**
	 * Добавляет запись в базу данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
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

		$set = self::buildSet($insertArr);
		$binds = self::buildBinds($insertArr);

		$query = "INSERT into $table $set";

		try {
			$result = DB::query($query, $binds);
		} catch(QueryEmptyResultException $e) {
			throw new UncheckedQueryException("insert must return smth", $e);
		}

		$id = DB::getConnection()->lastInsertId();
		$this->id = $id;

		if(!$this->isSaved()) {
			throw new UncheckedLogicException("object must be inserted here");
		}
	}

	/**
	 * Обновляет запись в базе данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function update() {
		if(!isset($this->id) || $this->isNull() || $this->errorInfo() || $this->isSaved()) {
			throw new WrongDataException();
		}

		$class = get_class($this);
		$table = $class::TABLE;

		$updateArr = array();
		$func = function($name, $value) use(&$updateArr) {
			if($value instanceof self) {
				$name = $name."_id";
				$value = $value->getID();
			}
			$updateArr[$name] = $value;
		};
		self::reflect($func);

		$set = self::buildSet($insertArr);
		$binds = self::buildBinds($updateArr);

		$query = "UPDATE $table $set WHERE id = '$this->id'";

		try {
			$result = DB::query($query, $binds);
		} catch(QueryEmptyResultException $e) {
			throw new UncheckedQueryException("update must return smth", $e);
		}

		if(!$this->isSaved()) {
			throw new UncheckedLogicException("object must be updated here");
		}
	}

	/**
	 * Удаляет запись из базы данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function delete() {
		
	}
//active record functions end

//get array
	/**
	 * Возвращает сформированный на основе свойств обьекта массив
	 * для получения информации о записи
	 * 
	 * @return array массив на основе свойств обьекта
	 */
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
	/**
	 * Отражает приватные свойства наследуемых классов(поля таблицы)
	 * и вызывает передаваемую функцию с параметрами(string $name, string @value)
	 * 
	 * @param Closure функция обратного вызова
	 * @return void
	 */
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