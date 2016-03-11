<?php

class Image extends AbstractRecord {

	const TABLE = "image";

//main info
	private $id;
	private $path;
	private $status;

	//getters
	public function getID() : int {
		return $this->id;
	}

	public function getPath() : string {
		return $this->path;
	}

	public function getStatus() : bool {
		return $this->status;
	}
	//getters end

	//setters
	private function setID(int $id) {
		$this->id = $id;
	}

	public function setPath(string $path) {
		$this->path = $path;
	}

	public function setStatus(bool $status) {
		$this->status = $status;
	}
	//setters end
//main info end

//link
	public function link() {
		return $this->path;
	}
//link end

//construct
	protected static function withArray(array $arr) : AbstractRecord {
		$obj = new self();

		$obj->id 		= $arr['id'];
		$obj->path 		= $arr['path'];
		$obj->status 	= $arr['status'];

		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}

	public function delete() {}
//abstract methods realization end

}