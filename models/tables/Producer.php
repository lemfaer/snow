<?php

class Producer extends AbstractRecord {

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
	private function setID(int $id) {
		$this->id = $id;
	}

	public function setName(string $name) {
		$this->name = $name;
	}

	public function setImage(Image $image) {
		$this->image = $image;
	}

	public function setStatus(bool $status) {
		$this->status = $status;
	}
	//setters end
//main info end

//construct
	protected static function withArray(array $arr) : AbstractRecord {
		$obj = new self();

		$obj->id 		= $arr['id'];
		$obj->name 		= $arr['name'];
		$obj->status 	= $arr['status'];

		$obj->image = Image::findFirst(array("id" => $arr['image_id']));

		return $obj;
	}
//construct end

//abstract methods realization
	public function insert() {}

	public function update() {}

	public function delete() {}
//abstract methods realization end

}