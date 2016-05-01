<?php

class OrderController {

	public function actionIndex() {
		if(Client::logged()) {
			$userItem = UserItem::withUser(Client::get());
			if($userItem->issetContact()) {
				$contact = $userItem->getContact();
			} else {
				$contact = null;
			}
		} else {
			$contact = null;
		}

		View::template("user/contact/index.php", compact("contact"));
	}

	public function actionCheck() {
		if(!isset($_POST['contactData'])) {
			header("location: /order");
		}
		$data = $_POST['contactData'];

		try {
			echo OrderForm::check($data);
		} catch(WrongDataException $e) {
			die($e->getMessage().", привет=)");
		}
	}

	public function actionSubmit() {
		if(!isset($_POST['contactData'])) {
			header("location: /order");
		}
		$data = $_POST['contactData'];

		$user = Client::get();
		$data['id'] = $user->getID();

		try {
			OrderForm::submit($data);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("wrong data from register form", $e);
		}

		header("location: /user/orders");
	}

}