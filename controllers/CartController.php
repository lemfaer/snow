<?php

class CartController {

	public function actionIndex() {
		View::template("CartView/index.php");
	}

	public function actionMini() {
		if(!isset($_POST['mini'])) {
			header("location: /cart");
		}

		try {
			$cart = Cart::getCart();
			View::empty("CartView/mini.php", compact("cart"));
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("data must be added to cart first", $e);
		}
	}

	public function actionAddOptions() {
		if(!isset($_POST['opt'])) {
			header("location: /cart");
		}

		try {
			$id = Available::findFirst($_POST['opt'])->getID();
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data from view must be in db", $e);
		}

		$_POST['add'] = true;
		$this->actionAdd($id);
	}

	public function actionInc($id) {
		// if(!isset($_POST['inc'])) {
		// 	header("location: /cart");
		// }

		$bool = true;
		try {
			Cart::inc($id);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("data must be added to cart first", $e);
		} catch(CartNotAvailableException $e) {
			$bool = false;
		}

		echo json_encode($bool);
	}

	public function actionDec($id) {
		// if(!isset($_POST['dec'])) {
		// 	header("location: /cart");
		// }

		$bool = true;
		try {
			Cart::dec($id);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("data must be added to cart first", $e);
		}

		echo json_encode($bool);
	}

	public function actionAdd($id) {
		// if(!isset($_POST['add'])) {
		// 	header("location: /cart");
		// }

		$bool = true;
		try {
			Cart::add($id);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotAvailableException $e) {
			$bool = false;
		}

		echo json_encode($bool);
	}

	public function actionDelete($id) {
		// if(!isset($_POST['delete'])) {
		// 	header("location: /cart");
		// }

		$bool = true;
		try {
			Cart::delete($id);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("data must be added to cart first", $e);
		}

		echo json_encode($bool);
	}

}