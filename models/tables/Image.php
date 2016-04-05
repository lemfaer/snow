<?php

class Image extends AbstractTable {

	const TABLE = "image";

//main info
	//protected $id
	private $path700;
	private $path135;
	private $path50;
	//protected $status

	//getters
	public function getPath() : string {
		return parent::get($this->path700);
	}

	public function getPath135() : string {
		return parent::get($this->path135);
	}

	public function getPath50() : string {
		return parent::get($this->path50);
	}
	//getters end

	//setters
	public function setPath(string $path) {
		$this->path700 = parent::set($path, "checkPath");
	}

	public function setPath135(string $path135) {
		$this->path135 = parent::set($path135, "checkPath");
	}

	public function setPath50(string $path50) {
		$this->path50 = parent::set($path50, "checkPath");
	}

	}
	//setters end
//main info end

//link
	public function link() {
		return $this->path700;
	}
//link end

//construct
	public function __construct() {
		$this->validator = new ImageValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id      = (int)    $arr['id'];
		$obj->path700 = (string) $arr['path700'];
		$obj->path135 = (string) $arr['path135'];
		$obj->path50  = (string) $arr['path50'];
		$obj->status  = (bool)   $arr['status'];

		return $obj;
	}
//construct end

}