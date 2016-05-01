<?php

class LogoutController {

	public function actionIndex() {
		if(!Client::logged()) {
			header("location: /login");
		}

		try {
			Client::logout();
		} catch(ClientNotExistsException $e) {
			throw new UncheckedLogicException("client must be logged", $e);
		}

		header("location: /");
	}

}