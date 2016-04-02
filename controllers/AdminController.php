<?php

class AdminController {

//class name
	private $classNameArr = array(
		"product"  => "ProductItem",
		"category" => "Category",
		"user"     => "User",
		"producer" => "Producer",
		"char"     => "Characteristic",
		"size"     => "Size",
		"color"    => "Color",
	);

	private function className(string $name) : string {
		return $this->classNameArr[$name];
	}
//class name end

//form name
	private $formNameArr = array(
		"size"  => "CRUPSizeForm",
		"color" => "CRUPColorForm",
	);

	private function formName(string $name) : string {
		return $this->formNameArr[$name];
	}
//form name end

//check
	/**
	 * Проверяет авторизирован ли пользователь 
	 * и является ли пользователь администратором
	 * 
	 * @return void
	 */
	private function checkAdmin() {}
//check end

//action view
	public function actionIndex() {
		$this->checkAdmin();
		View::admin("index/index.php");
	}

	public function actionCreate(string $name) {
		$this->checkAdmin();
		View::admin("$name/create.php");
	}

	public function actionRead(string $name) {
		$this->checkAdmin();

		$class = $this->className($name);
		$nameList = $name."List";
		try {
			${$nameList} = $class::findAll(array(), "id ASC", 500, 0, true);
		} catch(RecordNotFoundException $e) {
			${$nameList} = array();
		}

		View::admin("$name/read.php", compact($nameList));
	}

	public function actionUpdate(string $name, int $id) {
		$this->checkAdmin();

		$class = $this->className($name);
		try {
			${$name} = $class::findFirst(array("id" => $id), true);
		} catch(RecordNotFoundException $e) {
			die("no such record");
		}

		View::admin("$name/update.php", compact($name));
	}

	public function actionDelete(string $name, int $id) {
		$this->checkAdmin();
		//$this->controller($name)->actionDelete($name, $id);
	}
//action view end

//action check/submit
	public function actionDeleteSubmit(string $name, int $id) {
		$this->checkAdmin();
		if(!isset($_POST[$name])) {
			header("location: /admin/$name");
		}
		//$this->controller($name)->actionDeleteSubmit($name);
	}

	public function actionCRUPCheck(string $name) {
		$this->checkAdmin();
		if(!isset($_POST[$name])) {
			header("location: /admin/$name");
		}

		$form = $this->formName($name);
		try {
			echo $form::check($_POST[$name]);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("wrong data from view", $e);
		}
	}

	public function actionCRUPSubmit(string $name) {
		$this->checkAdmin();
		if(!isset($_POST[$name])) {
			header("location: /admin/$name");
		}

		$form = $this->formName($name);
		try {	
			$form::submit($_POST[$name]);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("wrong data from view", $e);
		}
		
		header("location: /admin/$name");
	}
//action check/submit end

//action select
	public function actionInherit() {
		$this->checkAdmin();
		if(!isset($_POST["parent_id"])) {
			header("location: /admin/");
		}

		$id = $_POST['parent_id'];  
		try {
			$categoryList = Category::findAll(array("parent_id" => $id));
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($categoryList as $k => $c) {
			$arr[$k] = array(
				"id"   => $c->getID(),
				"text" => $c->getName(),
			);
		}
		echo json_encode($arr);
	}

	public function actionValue() {
		$this->checkAdmin();
		if(!isset($_POST["name_id"])) {
			header("location: /admin/");
		}

		$id = $_POST['name_id'];  
		try {
			$valueList = CharValue::findAll(array("name_id" => $id));
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($valueList as $v) {
		 	$arr[$k] = array(
				"id"   => $v->getID(),
				"text" => $v->getValue(),
			);
		} 
		echo json_encode($arr);
	}

	public function actionSize() {
		$this->checkAdmin();
		if(!isset($_POST["category_id"])) {
			header("location: /admin/");
		}

		$id = $_POST['category_id'];  
		try {
			$sizeList = Size::findAll(array("category_id" => $id));
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($sizeList as $k => $s) {
			$arr[$k] = array(
				"id"   => $s->getID(),
				"text" => $s->getName(),
			);
		}
		echo json_encode($arr);
	}
//action select end

}