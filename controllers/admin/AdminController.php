<?php

class AdminController {

//router
	private $routeArr;

	private function controller(string $name) : self {
		foreach ($this->routeArr as $key => $value) {
			if($name === $key) {
				$class = "Admin".$value."Controller";
				return new $class();
			}
		}
	}
//router end

//construct
	public function __construct() {
		$this->routeArr = include(ROOT."/config/adminRoutes.php");
	}
//construct end

//check
	/**
	 * Проверяет авторизирован ли пользователь 
	 * и является ли пользователь администратором
	 * 
	 * @return void
	 */
	private function checkAdmin() {}
//check end

//actions
	public function actionIndex() {
		$this->checkAdmin();
		View::admin("index/index.php");
	}

	public function actionCreate(string $name) {
		$this->checkAdmin();
		$this->controller($name)->actionCreate($name);
	}

	public function actionRead(string $name) {
		$this->checkAdmin();
		$this->controller($name)->actionRead($name);
	}

	public function actionUpdate(string $name, int $id) {
		$this->checkAdmin();
		$this->controller($name)->actionUpdate($name, $id);
	}

	public function actionDelete(string $name, int $id) {
		$this->checkAdmin();
		$this->controller($name)->actionDelete($name, $id);
	}

	public function actionDeleteSubmit(string $name, int $id) {
		$this->checkAdmin();
		if(!isset($_POST[$name])) {
			header("location: /admin/$name");
		}
		$this->controller($name)->actionDeleteSubmit($name);
	}

	public function actionCRUPCheck(string $name) {
		$this->checkAdmin();
		if(!isset($_POST[$name])) {
			header("location: /admin/$name");
		}
		$this->controller($name)->actionCRUPCheck($name);
	}

	public function actionCRUPSubmit(string $name) {
		$this->checkAdmin();
		if(!isset($_POST[$name])) {
			header("location: /admin/$name");
		}
		$this->controller($name)->actionCRUPSubmit($name);
	}
//actions end

}