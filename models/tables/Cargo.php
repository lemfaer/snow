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

}