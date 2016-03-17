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
	protected function setID(int $id) {
		$this->id = parent::set($id, $this->validator->checkID);
	}

	public function setPath(string $path) {
		$this->path = parent::set($path, $this->validator->checkPath);
	}

	public function setStatus(bool $status) {
		$this->status = parent::set($status, $this->validator->checkStatus);
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