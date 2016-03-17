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
	protected function setID(int $id) : bool {
		if ($this->validator->checkID($id)) {
			$this->id = $id;
			return true;
		}
		return false;
	}

	public function setName(string $name) : bool {
		if ($this->validator->checkName($name)) {
			$this->name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
			return true;
		}
		return false;
	}

	public function setImage(Image $image) : bool {
		if ($this->validator->checkImage($image)) {
			$this->image = $image;
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