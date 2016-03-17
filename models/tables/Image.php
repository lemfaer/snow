<?php

class Image extends AbstractTable {

	const TABLE = "image";

//main info
	private $id;
	private $path;
	private $status;

	//getters
	public function getID() : int {
		return parent::get($this->id);
	}

	public function getPath() : string {
		return parent::get($this->path);
	}

	public function getStatus() : bool {
		return parent::get($this->status);
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

	public function setPath(string $path) : bool {
		if ($this->validator->checkPath($path)) {
			$this->path = $path;
			return true;
		}
		return false;
	}

	public function setStatus(bool $status) : bool {
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

		$obj->id     = $arr['id'];
		$obj->path   = $arr['path'];
		$obj->status = $arr['status'];

		return $obj;
	}
//construct end

}