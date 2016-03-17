<?php

class Product extends AbstractTable {

	const TABLE = "product";

//main info
	private $id;
	private $name;
	private $producer; //class
	private $price;
	private $year;
	private $short_description;
	private $description;
	private $category; //class
	private $is_new;
	private $is_recomended;
	private $status;

	//getters
	public function getID() : int {
		return parent::get($this->id);
	}

	public function getName() : string {
		return parent::get($this->name);
	}

	public function getProducer() : Producer {
		return parent::get($this->producer);
	}
        
    public function getPrice() : int {
    	return parent::get($this->price);
    }

    public function getYear() : int {
		return parent::get($this->year);
    }

	public function getShortDescription() : string {
		return parent::get($this->short_description);
	}

	public function getDescription() : string {
		return parent::get($this->description);
	}

	public function getCategory() : Category {
		return parent::get($this->category);
	}

	public function isNew() : bool {
		return parent::get($this->is_new);
	}

	public function isRecomended() : bool {
		return parent::get($this->is_recomended);
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

	public function setProducer(Producer $producer) : bool {
		if ($this->validator->checkProducer($producer)) {
			$this->producer = $producer;
			return true;
		}
		return false;
	}

	public function setPrice(int $price) : bool {
		if ($this->validator->checkPrice($price)) {
			$this->price = $price;
			return true;
		}
		return false;
	}

	public function setYear(int $year) : bool {
		if ($this->validator->checkYear($year)) {
			$this->year = $year;
			return true;
		}
		return false;
	}

	public function setShortDescription(string $short_description) : bool {
		if ($this->validator->checkShortDescription($short_description)) {
			$this->short_description = $short_description;
			return true;
		}
		return false;
	}

	public function setDescription(string $description) : bool {
		if ($this->validator->checkDescription($description)) {
			$this->description = $description;
			return true;
		}
		return false;
	}

	public function setCategory(Category $category) : bool {
		if ($this->validator->checkCategory($category)) {
			$this->category = $category;
			return true;
		}
		return false;
	}

	public function setNew(bool $is_new) : bool {
		if ($this->validator->checkNew($is_new)) {
			$this->is_new = $is_new;
			return true;
		}
		return false;
	}

	public function setRecomended(bool $is_recomended) : bool {
		if ($this->validator->checkRecomended($is_recomended)) {
			$this->is_recomended = $is_recomended;
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

//available
	public function isAvailable() : bool {
		$avCount = Available::findCount(array("product_id" => $this->id));
		return $avCount == true;
	}
//available end

//first image
	public function getImage() : Image {
		try {
			$query = "SELECT image_id FROM product_has_image WHERE product_id = $this->id LIMIT 1";
			$result = DB::query($query);
			$result = $result->fetch();
			$id = array_shift($result);
			return Image::findFirst(array("id" => $id));
		} catch(Exception $e) {
			$image = new Image();
			$image->setPath("http://i65.tinypic.com/k6ey0.gif");
			return $image;
		}
	}
//first image end

//construct
	public function __construct() {
		$this->validator = new ProductValidator();
	}

	protected static function withArray(array $arr) : AbstractTable {
		$obj = new self();

		$obj->id                = $arr['id'];
		$obj->name              = $arr['name'];
		$obj->price             = $arr['price'];
		$obj->year              = $arr['year'];
		$obj->short_description = $arr['short_description'];
		$obj->description       = $arr['description'];
		$obj->is_new            = $arr['is_new'];
		$obj->is_recomended     = $arr['is_recomended'];
		$obj->status            = $arr['status'];

		$category      = Category::findFirst(array("id" => $arr['category_id']));
		$obj->category = $category; //class

		$producer      = Producer::findFirst(array("id" => $arr['producer_id']));
		$obj->producer = $producer; //class

		return $obj;
	}
//construct end

}