<?php

class CartController {

//view
	public function actionIndex() {
		try {
			View::template("/cart/full/index.php");
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("full cart view not found", $e);
		}
	}

	public function actionMini() {
		if(!isset($_POST['mini'])) {
			header("location: /cart");
		}

		try {
			$cart = Cart::get();
			try {
				View::empty("/cart/mini/mini.php", compact("cart"));
			} catch(FileNotFoundException $e) {
				throw new UncheckedLogicException("mini cart view not found", $e);
			}
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("data must be added to cart first", $e);
		}
	}
//view end

//calculation
	public function actionSubTotal() {
		if(!isset($_POST['id'])) {
			header("location: /cart");
		}
		$id = $_POST['id'];
		try {
			$subTotal = Cart::subTotal($id);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		}

		echo '$'.$subTotal;
	}

	public function actionTotal() {
		if(!isset($_POST['total'])) {
			header("location: /cart");
		}
		$total = Cart::total();

		echo '$'.$total;
	}
//calculation end

//add, inc/dec, delete
	public function actionAddOptions() {
		if(!isset($_POST['opt'])) {
			header("location: /cart");
		}

		try {
			$id = Available::findFirst($_POST['opt'])->getID();
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data from view must be in db", $e);
		}

		$_POST['id'] = $id;
		$this->actionAdd();
	}

	public function actionInc() {
		if(!isset($_POST['id'])) {
			header("location: /cart");
		}
		$id = $_POST['id'];

		try {
			Cart::inc($id);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("data must be added to cart first", $e);
		} catch(CartNotAvailableException $e) {}

		$count = Cart::getCount($id); //exceptions there --^
		echo json_encode($count);
	}

	public function actionDec() {
		if(!isset($_POST['id'])) {
			header("location: /cart");
		}
		$id = $_POST['id'];

		try {
			Cart::dec($id);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("data must be added to cart first", $e);
		} catch(CartNotAvailableException $e) {}

		$count = Cart::getCount($id); //exceptions there --^
		echo json_encode($count);
	}

	public function actionAdd() {
		if(!isset($_POST['id'])) {
			header("location: /cart");
		}
		$id = $_POST['id'];

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

	public function actionDelete() {
		if(!isset($_POST['delete'])) {
			header("location: /cart");
		}
		$id = $_POST['id'];

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
//add, inc/dec, delete end

}