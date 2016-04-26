<?php

class UserItemValidator extends AbstractValidator {

//const

//const end

//validate methods
	public function checkUser(User $user) : bool {
		$error = array("user" => parent::USER_OBJECT_ERROR);
		return parent::checkObject($user, $error);
	}

	public function checkContact(Contact $contact) : bool {
		$error = array("contact" => parent::CONTACT_OBJECT_ERROR);

		$rc = new ReflectionClass($contact);
		$rp = $rc->getProperty("user");
		$rp->setAccessible(true);
		$rp->setValue($contact, new User());

		return parent::log(!$contact->isNull(), $error);
	}
//validate methods end

}