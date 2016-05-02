<?php

class AdminController {

//class name
	private $classNameArr = array(
		"product"  => "ProductItem",
		"category" => "Category",
		"user"     => "UserItem",
		"indent"   => "IndentItem",
		"producer" => "Producer",
		"char"     => "CharValue",
		"size"     => "Size",
		"color"    => "Color",
	);

	private function className(string $name) : string {
		if(!isset($this->classNameArr[$name])) {
			throw new WrongDataException($name, "wrong name");
		}

		return $this->classNameArr[$name];
	}
//class name end

//form name
	private $formNameArr = array(
		"product"  => "CRUPProductForm",
		"category" => "CRUPCategoryForm",
		"user"     => "CRUPUserForm",
		"indent"   => "CRUPIndentForm",
		"producer" => "CRUPProducerForm",
		"char"     => "CRUPCharForm",
		"size"     => "CRUPSizeForm",
		"color"    => "CRUPColorForm",
	);

	private function formName(string $name) : string {
		if(!isset($this->formNameArr[$name])) {
			throw new WrongDataException($name, "wrong name");
		}

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
	private function checkAdmin() {
		$user = Client::get();
		if(!$user->isAdmin()) {
			die("Нет доступа к админ. панели");
		}
	}
//check end

//construct
	public function __construct() {
		$this::handler();
	}
//construct end

//handler
	public static function handler(Exception $e = null) {
		if(!isset($e)) {
			set_exception_handler(array(__CLASS__, "handler"));
			return;
		}
		?>

		<script>
			var elem = document.getElementsByTagName("body")[0];

			if(elem) {
				elem.innerHTML = '';
			}
		</script>

		<?php
		try {
			if($e instanceof PageNotFoundException) {
				View::admin("/template/404.php");
			} else {
				View::admin("/template/error.php");
			}
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("error views not found", $e);
		}
	}
//handler end

//action view
	public function actionIndex() {
		self::view("/index/index.php");
	}

	public function actionCreate(string $name) {
		self::view("/$name/create.php");
	}

	public function actionRead(string $name) {
		try {
			$class = $this->className($name);
		} catch(WrongDataException $e) {
			throw new PageNotFoundException("table not found", $e);
		}

		$nameList = $name."List";
		try {
			${$nameList} = $class::findAll(array(), "id ASC", 500, 0, true);
		} catch(RecordNotFoundException $e) {
			${$nameList} = array();
		}

		self::view("/$name/read.php", compact($nameList));
	}

	public function actionUpdate(string $name, int $id) {
		try {
			$class = $this->className($name);
		} catch(WrongDataException $e) {
			throw new PageNotFoundException("table not found", $e);
		}

		try {
			${$name} = $class::findFirst(array("id" => $id), true);
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("record not found", $e);
		}

		self::view("/$name/update.php", compact($name));
	}

	private function view(string $path, array $compact = array()) {
		$this->checkAdmin();
		try {
			View::admin($path, $compact);
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("view not found", $e);
		}
	}
//action view end

//action check/submit
	public function actionCRUPCheck(string $name) {
		$this->checkAdmin();
		if(!isset($_POST[$name])) {
			header("location: /admin/$name");
		}

		$data = $_POST[$name];
		if(isset(Files::get()[$name])) {
			$data['file'] = Files::get()[$name];
		}

		$form = $this->formName($name);
		try {
			echo $form::check($data);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("wrong data from view", $e);
		}
	}

	public function actionCRUPSubmit(string $name) {
		$this->checkAdmin();
		if(!isset($_POST[$name])) {
			header("location: /admin/$name");
		}

		$data = $_POST[$name];
		if(isset(Files::get()[$name])) {
			$data['file'] = Files::get()[$name];
		}

		$form = $this->formName($name);
		try {	
			$form::submit($data);
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
			$categoryList = Category::findAll(array("parent_id" => $id), "sort_order ASC");
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($categoryList as $k => $c) {
			$arr[] = array(
				"id"   => $c->getID(),
				"text" => $c->getName(),
			);
		}
		echo json_encode($arr);
	}

	public function actionSort() {
		$this->checkAdmin();
		if(!isset($_POST["parent_id"])) {
			header("location: /admin/");
		}

		$id = $_POST['parent_id'];  
		try {
			$categoryList = Category::findAll(array("parent_id" => $id), "sort_order ASC");
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($categoryList as $k => $c) {
			$arr[] = array(
				"id"   => $c->getSortOrder(),
				"text" => $c->getName(),
			);
		}
		echo json_encode($arr);
	}

	public function actionName() {
		$this->checkAdmin();
		if(!isset($_POST["category_id"])) {
			header("location: /admin/");
		}

		$id = $_POST['category_id'];  
		try {
			$nameList = CharName::findAll(array("category_id" => $id));
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($nameList as $k => $n) {
		 	$arr[$k] = array(
				"id"   => $n->getID(),
				"text" => $n->getName(),
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
		foreach ($valueList as $k => $v) {
		 	$arr[$k] = array(
				"id"   => $v->getID(),
				"text" => $v->getValue(),
			);
		} 
		echo json_encode($arr);
	}

	public function actionColor() {
		$this->checkAdmin();
		if(!isset($_POST["color"])) {
			header("location: /admin/");
		}
 
		try {
			$colorList = Color::findAll();
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($colorList as $k => $c) {
			$arr[$k] = array(
				"id"   => $c->getID(),
				"text" => $c->getName(),
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
			$sizeList = Size::findAll(array("category_id" => $id), "CAST(name AS int)");
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

	public function actionProducer() {
		$this->checkAdmin();
		if(!isset($_POST["producer"])) {
			header("location: /admin/");
		}

		try {
			$producerList = Producer::findAll();
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($producerList as $k => $p) {
			$arr[$k] = array(
				"id"   => $p->getID(),
				"text" => $p->getName(),
			);
		}
		echo json_encode($arr);
	}

	public function actionState() {
		$this->checkAdmin();
		if(!isset($_POST["state"])) {
			header("location: /admin/");
		}
 
		try {
			$stateList = State::findAll();
		} catch(RecordNotFoundException $e) {
			echo json_encode(false);
			return;
		}
		
		$arr = array();
		foreach ($stateList as $k => $s) {
			$arr[$k] = array(
				"id"   => $s->getID(),
				"text" => $s->getName(),
			);
		}
		echo json_encode($arr);
	}
//action select end

}