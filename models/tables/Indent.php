<?php

class Indent extends AbstractTable {

	const TABLE = "indent";

//main info
	//protected $id
	private $contact;
	private $state;
	//protected $status

	//getters
	public function getContact() : Contact {
		return parent::get($this->contact);
	}

	public function getState() : State {
		return parent::get($this->state);
	}
	//getters end

	//setters
	public function setContact(Contact $contact) {
		$this->contact = parent::set($contact, "checkContact");
	}

	public function setState(State $state) {
		$this->state = parent::set($state, "checkState");
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new IndentValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = (int)  $arr['id'];
		$obj->status = (bool) $arr['status'];

		try {
			$contact = Contact::findFirst(array("id" => $arr['contact_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['contact_id'], "wrong id in db", $e));
		}
		$obj->contact = $contact;

		try {
			$state = State::findFirst(array("id" => $arr['state_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['state_id'], "wrong id in db", $e));
		}
		$obj->state = $state;

		return $obj;
	}
//construct end

}