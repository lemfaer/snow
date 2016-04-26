<?php

class IndentValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Indent";
//const end

//validate methods
	public function checkContact(Contact $contact) : bool {
		$error = array("contact" => parent::CONTACT_OBJECT_ERROR);
		return parent::checkObject($contact, $error);
	}

	public function checkState(State $state) : bool {
		$error = array("state" => parent::STATE_OBJECT_ERROR);
		return parent::checkObject($state, $error);
	}
//validate methods end

}