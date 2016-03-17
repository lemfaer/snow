<?php

class Producer extends AbstractTable {

	const TABLE = "producer";

//main info
	private $id;
	private $name;
	private $image;
	private $status;

	//getters
	public function getID() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getImage() {
		return $this->image;
	}

	public function getStatus() {
		return $this->status;
	}
	//getters end

	//setters
	protected function setID(int $id) : bool {
		if ($this->validator->checkID($id)) {
			$this->id = $id;
			return true;
		}
		return false;
	}

	public function setName(string $name) {
		if ($this->validator->checkName($name)) {
			$this->name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
			return true;
		}
		return false;
	}

	public function setImage(Image $image) {
		if ($this->validator->checkImage($image)) {
			$this->image = $image;
			return true;
		}
		return false;
	}

	public function setStatus(bool $status) {
		if ($this->validator->checkStatus($status)) {
			$this->status = $status;
			return true;
		}
		return false;
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new ProducerValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id 		= $arr['id'];
		$obj->name 		= $arr['name'];
		$obj->status 	= $arr['status'];

		$obj->image = Image::findFirst(array("id" => $arr['image_id']));

		return $obj;
	}
//construct end

}

class ProducerValidator extends AbstractValidator {

//const
	const CLASS_NAME = "Producer";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const NAME_ERROR = "Неправильный ввод имени";
//const end

//check
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}
	
	public function checkImage(Image $image) : bool {
		$error = array("image" => parent::IMAGE_OBJECT_ERROR);
		return parent::checkObject($image, $error);
	}
//check end

}