<?php

class AdminColorController extends AdminController {
	
	public function actionCreate(string $name) {
		View::admin("color/create.php");
	}

	public function actionRead(string $name) {
		try {
			$colorList = Color::findAll(array(), "id ASC", 500, 0, true);
		} catch(RecordNotFoundException $e) {
			$colorList = array();
		}
		View::admin("color/read.php", compact("colorList"));
	}

	public function actionUpdate(string $name, int $id) {
		try {
			$color = Color::findFirst(array("id" => $id), true);
		} catch(RecordNotFoundException $e) {
			die("no such record");
		}
		View::admin("color/update.php", compact("color"));
	}

	public function actionDelete(string $name, int $id) {
		View::admin("color/delete.php");
	}

	public function actionCRUPCheck(string $name) {
		echo CRUPColorForm::check($_POST[$name]);
	}

	public function actionCRUPSubmit(string $name) {
		CRUPColorForm::submit($_POST[$name]);
	}

}