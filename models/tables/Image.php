<?php

class Image extends AbstractTable {

	const TABLE = "image";

//main info
	//protected $id
	private $path;
	//protected $status

	//getters
	public function getPath() : string {
		return parent::get($this->path);
	}
	//getters end

	//setters
	public function setPath(string $path) {
		$this->path = parent::set($path, "checkPath");
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

		$obj->id     = (int)    $arr['id'];
		$obj->path   = (string) $arr['path'];
		$obj->status = (bool)   $arr['status'];

		return $obj;
	}
//construct end

}