<?php

class Image extends AbstractTable {

	const TABLE = "image";

//main info
	private $id;
	private $path;
	private $status;

	//getters
	public function getID() {
		return $this->id;
	}

	public function getPath() {
		return $this->path;
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

	public function setPath(string $path) {
		if ($this->validator->checkPath($path)) {
			$this->path = $path;
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

//link
	public function link() {
		return $this->path;
	}
//link end

//construct
	public function __construct() {
		$this->validator = new ImageValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id 		= $arr['id'];
		$obj->path 		= $arr['path'];
		$obj->status 	= $arr['status'];

		return $obj;
	}
//construct end

}

class ImageValidator extends AbstractValidator {

//const
	const CLASS_NAME = "Image";

	const PATH_ERROR = "Указан неправильный путь";
//const end

//check
	public function checkPath(string $path) : bool {
		$error = array("path" => self::PATH_ERROR);
		$path = ROOT."/images/".$path;
		//return parent::log(file_exists($path), $error);
		return true;
	}
//check end

}