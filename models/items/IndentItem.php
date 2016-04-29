<?php

/**
 * Класс описывает структуру заказа
 * 
 * Класс описывает структуру заказа содержащую описание заказа
 * и список товаров в заказе. Методы класса дают возможность
 * получить доступ, изменять содержимое заказа и сохранять 
 * изменения в базе данных. 
 * 
 * @package models_items
 * @author  Alan Smithee
 * @final
 */
final class IndentItem extends AbstractRecord {

//main info
	/**
	 * @var Indent $indent    Объект, содержащий основную информацию о заказе
	 * @var array  $cargoList Массив, содержащий список товаров в заказе
	 */
	private $indent;
	private $cargoList = array();

	//getters
	/**
	 * Возвращает объект, содержащий основную информацию о заказе
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return Indent информация о товаре
	 */
	public function getIndent() : Indent {
		return parent::get($this->indent);
	}

	/**
	 * Возвращает массив, содержащий список товаров в заказе
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return array список товаров в заказе
	 */
	public function getCargoList() : array {
		return parent::get($this->cargoList);
	}
	//getters end

	//setters
	/**
	 * Устанавливает основную информацию о заказе
	 * 
	 * @param Indent $indent основная информация о заказе
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setIndent(Indent $indent) {
		$this->indent = parent::set($indent, "checkIndent");
	}

	/**
	 * Устанавливает список товаров в заказе
	 * 
	 * @param array $cargoList список товаров в заказе
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setCargoList(array $cargoList) {
		$this->cargoList = parent::set($cargoList, "checkCargoList");
	}
	//setters end
//main info end

//calculation
	public function total() : int {
		$total = 0;

		foreach ($this->cargoList as $cargo) {
			$total += $cargo->subTotal();
		}

		return $total;
	}

	public function count() : int {
		$count = 0;

		foreach ($this->cargoList as $cargo) {
			$count += $cargo->getCount();
		}

		return $count;
	}
//calculation end

//init
	/**
	 * Инициализирует массив товаров в заказе 
	 * на основе объекта Indent в свойстве $indent
	 * 
	 * @throws WrongDataException объект Indent не установлен
	 * @return void
	 */
	private function cargoList() {
		try {
			$id = $this->getIndent()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "indent not set", $e);
		}
		
		try {
			$arr = Cargo::findAll(array("indent_id" => $id), true);
		} catch(RecordNotFoundException $e) {
			$this->cargoList = array();
			return;
		}

		$this->cargoList = $arr;
	}
//init end

//check
	/**
	 * Проверяет сохраненен ли список товаров в заказе в базе данных
	 * 
	 * Возвращает true если в базе данных присутствует список товаров этого заказа
	 * Возвращает false если в базе данных отсутствует список товаров этого заказа
	 * 
	 * @throws WrongDataException объект Indent не установлен 
	 * @return bool сохраненен ли список товаров
	 */
	public function isIn() : bool {
		try {
			$id = $this->getIndent()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "indent not set", $e);
		}

		return Cargo::findCount(array("indent_id" => $id), true) > 0;
	}
//check end

//construct
	/**
	 * Конструктор
	 * 
	 * @param Indent $indent объект, содержащий основную информацию о заказе
	 * @throws WrongDataException передан неправильный объект Indent
	 * @return IndentItem обьект класса
	 */
	public static function withIndent(Indent $indent) : IndentItem {
		$obj = new self();

		$obj->setIndent($indent); // no exception check
		
		try {
			$obj->cargoList();
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("indent has been set", $e);
		}

		return $obj;
	}

	/**
	 * Приватный конструктор
	 * Устанавливает валидатор
	 */
	private function __construct() {
		$this->validator = new IndentItemValidator();
	}
//construct end

//abstract methods realization
	/**
	 * Находит количество записей по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @return int количество найденных записей
	 */
	public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int {
		return Indent::findCount($whereArr, $nullStatus);
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
		$indent = Indent::findFirst($whereArr, $nullStatus);
		$indentItem = self::withIndent($indent);
		return $indentItem;
	}

	/**
	 * Находит все записи по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @throws RecordNotFoundException записи не найдены
	 * @return array<AbstractRecord> записи
	 */
	public static function findAll(array $whereArr = array(), string $order = "id ASC", int $limit = parent::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array {
		$indentList = Indent::findAll($whereArr, $order, $limit, $offset, $nullStatus);
		foreach ($indentList as $i => $indent) {
			$indentList[$i] = self::withIndent($indent);
		}
		return $indentList;
	}

	/**
	 * Добавляет запись в базу данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function insert() {
		if($this->isIn()) { // no exception check
			throw new WrongDataException($this, "already in database");
		}

		try {
			$id = $this->getIndent()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "indent not set", $e);
		}

		try {
			foreach ($this->cargoList as $i => $cargo) {
				$cargo->setIndent($this->indent);
				if(!$cargo->isSaved()) {
					$cargo->insert();
				}
				$this->cargoList[$i] = $cargo;
			}
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		}
	}

	/**
	 * Обновляет запись в базе данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function update() {
		$this->delete();
		$this->insert();
	}

	/**
	 * Удаляет запись из базы данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function delete() {
		try {
			$id = $this->getIndent()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "indent not set", $e);
		}

		foreach ($this->cargoList as $i => $cargo) {
			try {
				$cargo->getID();
				$cargo->delete();
				$this->cargoList[$i] = $cargo;
			} catch(NullAccessException $e) {}
		}

		try {
			$cargoList = Cargo::findAll(array("indent_id" => $id), true);
		} catch(RecordNotFoundException $e) {
			$cargoList = array();
		}

		try {
			foreach ($cargoList as $cargo) {
				$cargo->delete();
			}
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data in item must be valide", $e);
		}
	}
//abstract methods realization end

}