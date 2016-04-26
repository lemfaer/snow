<?php

class Cargo extends AbstractTable {

	const TABLE = "cargo";

//main info
	//protected $id
	private $intent;
	private $available;
	private $count;
	//protected $status

	//getters
	public function getIntent() : Intent {
		return parent::get($this->intent);
	}

	public function getAvailable() : Available {
		return parent::get($this->available);
	}

	public function getCount() : int {
		return parent::get($this->count);
	}
	//getters end

	//setters
	public function setIntent(Intent $intent) {
		$this->intent = parent::set($intent, "checkIntent");
	}

	public function setAvailable(Available $available) {
		$this->available = parent::set($available, "checkAvailable");
	}

	public function setCount(int $count) {
		$count = parent::set($count, "checkCount");
		if(isset($this->available)) {
			if($this->validator->checkCountAvailable($count, $this->available)) {
				$this->count = $count;
				return;
			}
		}
		throw new WrongDataException($count, implode(", ", $this->errorInfo()));
	}
	//setters end
//main info end

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
			$intent = Intent::findFirst(array("id" => $arr['intent_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['intent_id'], "wrong id in db", $e));
		}
		$obj->intent = $intent;

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