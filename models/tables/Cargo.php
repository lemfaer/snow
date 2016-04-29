<?php

class Cargo extends AbstractTable {

	const TABLE = "cargo";

//main info
	//protected $id
	private $indent;
	private $available;
	private $count;
	//protected $status

	//getters
	public function getIndent() : Indent {
		return parent::get($this->indent);
	}

	public function getAvailable() : Available {
		return parent::get($this->available);
	}

	public function getCount() : int {
		return parent::get($this->count);
	}
	//getters end

	//setters
	public function setIndent(Indent $indent) {
		$this->indent = parent::set($indent, "checkIndent");
	}

	public function setAvailable(Available $available) {
		$this->available = parent::set($available, "checkAvailable");
	}

	public function setCount(int $count) {
		$count = parent::set($count, "checkCount");
		if(isset($this->available)) {
			if($this->validator->checkAvailableCount($count, $this->available)) {
				$this->count = $count;
				return;
			}
		}
		throw new WrongDataException($count, implode(", ", $this->errorInfo()));
	}
	//setters end
//main info end

//subtotal
	public function subTotal() : int {
		if(!isset($this->available)) {
			throw new WrongDataException($this, "available not set");
		}
		if(!$this->available->isSaved()) {
			throw new WrongDataException($this->available, "wrong available");
		}

		return $this->available->getProduct()->getPrice() * $this->count;
	}
//subtotal end

//construct
	public function __construct() {
		$this->validator = new CargoValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = (int)  $arr['id'];
		$obj->count  = (int)  $arr['count'];
		$obj->status = (bool) $arr['status'];

		try {
			$indent = Indent::findFirst(array("id" => $arr['indent_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['indent_id'], "wrong id in db", $e));
		}
		$obj->indent = $indent;

		try {
			$available = Available::findFirst(array("id" => $arr['available_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['available_id'], "wrong id in db", $e));
		}
		$obj->available = $available;

		return $obj;
	}
//construct end

//active record functions
	/**
	 * Добавляет запись в базу данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function insert() {
		if($this->isNull()) {
			throw new WrongDataException($this, "object not filled");
		}
		if($error = $this->errorInfo()) {
			throw new WrongDataException($this, "object filled with errors: "
				.implode(", ", $error));
		}

		try {
			$count = $this->available->getCount() - $this->count;
			$this->available->setCount($count);
			if(!$this->available->isSaved()) {
				$this->available->update();
			}
		} catch(NullAccessException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		}

		parent::insert();
	}

	/**
	 * Обновляет запись в базе данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function update() {
		if(!isset($this->id)) {
			throw new WrongDataException($this, "id not set");
		}
		if($this->isNull()) {
			throw new WrongDataException($this, "object not filled");
		}
		if($error = $this->errorInfo()) {
			throw new WrongDataException($this, "object filled with errors: "
				.implode(", ", $error));
		}

		try {
			$cargo = Cargo::findFirst(array("id" => $this->id), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("id in object must be valide",
				new WrongDataException($this->id, "wrong id", $e));
		}

		try {
			$count = $cargo->available->getCount() + $cargo->count;
			$cargo->available->setCount($count);
			if(!$cargo->available->isSaved()) {
				$cargo->available->update();
			}
		} catch(NullAccessException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		}

		if($this->available->getID() === $cargo->available->getID()) {
			$this->available = $cargo->available;
		}

		try {
			$count = $this->available->getCount() - $this->count;
			$this->available->setCount($count);
			if(!$this->available->isSaved()) {
				$this->available->update();
			}
		} catch(NullAccessException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		}

		parent::update();
	}

	/**
	 * Удаляет запись из базы данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function delete() {
		if(!isset($this->id)) {
			throw new WrongDataException($this, "id not set");
		}

		try {
			$cargo = Cargo::findFirst(array("id" => $this->id), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("id in object must be valide",
				new WrongDataException($this->id, "wrong id", $e));
		}

		try {
			$count = $cargo->available->getCount() + $cargo->count;
			$cargo->available->setCount($count);
			if(!$cargo->available->isSaved()) {
				$cargo->available->update();
			}
		} catch(NullAccessException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data has been checked", $e);
		}

		if(isset($this->available) && $this->available->getID() === $cargo->available->getID()) {
			$this->available = $cargo->available;
		}

		parent::delete();
	}
//active record functions end

}