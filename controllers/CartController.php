<?php

class CartController {

	public function actionIndex() {

	}

	public function actionGet($id) {
		try {
			$one = Cart::getOne($id); // view var
			View::empty("CartView/get.php");
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("data from view must be valide", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("data must be added to cart first", $e);
		}
	}

	public function actionInc($id) {
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

}