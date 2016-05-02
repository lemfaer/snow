<?php

class OrderController {

	public function actionIndex() {
		if(!Cart::get()) {
			header("location: /cart");
		}

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

		try {
			View::template("/user/contact/index.php", compact("contact"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("contact form view not found", $e);
		}
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

		$data['id'] = Client::logged() ? (Client::get())->getID() : 0;

		try {
			OrderForm::submit($data);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("wrong data from register form", $e);
		}

		if(Client::logged()) {
			header("location: /user/orders");
		} else {
			header("location: /");
		}
	}

}