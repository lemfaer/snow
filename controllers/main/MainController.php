<?php

class MainController {

	const NEW_COUNT = 10;
	const NEW_SORT  = "rand()";
	const REC_COUNT = 8;
	const REC_SORT  = "rand()";
	
	public function actionIndex() {
		try {
			$newList = Product::findAll(array("is_new" => '1'), 
				self::NEW_SORT, self::NEW_COUNT);
		} catch(RecordNotFoundException $e) {
			$newList = array();
		}

		try {
			$recomendedList = Product::findAll(array("is_recomended" => '1'), 
				self::REC_SORT, self::REC_COUNT);
		} catch(RecordNotFoundException $e) {
			$recomendedList = array();
		}

		try {
			View::template("/main/index.php", compact("newList", "recomendedList"));
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("main view not found", $e);
		}
	}

}