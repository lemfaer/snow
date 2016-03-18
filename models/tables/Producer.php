<?php

class Producer extends AbstractTable {

	const TABLE = "producer";

//main info
	//protected $id
	private $name;
	private $image; //class
	//protected $status

	//getters
	public function getName() : string {
		return parent::get($this->name);
	}

	public function getImage() : Image {
		return parent::get($this->image);
	}
	//getters end

	//setters
	public function setName(string $name) {
		$this->name = parent::set($name, $this->validator->checkName);
	}

	public function setImage(Image $image) {
		$this->image = parent::set($image, $this->validator->checkImage);
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