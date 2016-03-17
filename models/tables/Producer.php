<?php

class Producer extends AbstractTable {

	const TABLE = "producer";

//main info
	private $id;
	private $name;
	private $image;
	private $status;

	//getters
	public function getID() : int {
		return parent::get($this->id);
	}

	public function getName() : string {
		return parent::get($this->name);
	}

	public function getImage() : Image {
		return parent::get($this->image);
	}

	public function getStatus() : bool {
		return parent::get($this->status);
	}
	//getters end

	//setters
	protected function setID(int $id) {
		$this->id = parent::set($id, $this->validator->checkID);
	}

	public function setName(string $name) {
		$this->name = parent::set($name, $this->validator->checkName);
	}

	public function setImage(Image $image) {
		$this->image = parent::set($image, $this->validator->checkImage);
	}

	public function setStatus(bool $status) {
		$this->status = parent::set($status, $this->validator->checkStatus);
	}
	//setters end
//main info end

//construct
	public function __construct() {
		$this->validator = new ProducerValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id     = $arr['id'];
		$obj->name   = $arr['name'];
		$obj->status = $arr['status'];

		$image      = Image::findFirst(array("id" => $arr['image_id']));
		$obj->image = $image;

		return $obj;
	}
//construct end

}