<?php

class Product extends AbstractTable {

	const TABLE = "product";

//main info
	//protected $id
	private $name;
	private $producer; //class
	private $price;
	private $year;
	private $short_description;
	private $description;
	private $category; //class
	private $is_new;
	private $is_recomended;
	//protected $status

	//getters
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
	//getters end

	//setters
	public function setName(string $name) {
		$name = mb_convert_case($name, MB_CASE_TITLE, "UTF-8");
		$this->name = parent::set($name, "checkName");
	}

	public function setProducer(Producer $producer) {
		$this->producer = parent::set($producer, "checkProducer");
	}

	public function setPrice(int $price) {
		$this->price = parent::set($price, "checkPrice");
	}

	public function setYear(int $year) {
		$this->year = parent::set($year, "checkYear");
	}

	public function setShortDescription(string $short_description) {
		$this->short_description = parent::set($short_description, 
			"checkShortDescription");
	}

	public function setDescription(string $description) {
		$this->description = parent::set($description, "checkDescription");
	}

	public function setCategory(Category $category) {
		$this->category = parent::set($category, "checkCategory");
	}

	public function setNew(bool $is_new) {
		$this->is_new = parent::set($is_new, "checkNew");
	}

	public function setRecomended(bool $is_recomended) {
		$this->is_recomended = parent::set($is_recomended, "checkRecomended");
	}
	//setters end
//main info end

//available
	public function isAvailable() : bool {
		$avCount = Available::findCount(array("product_id" => $this->id));
		return $avCount > 0;
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

		$obj->id                = (int)    $arr['id'];
		$obj->name              = (string) $arr['name'];
		$obj->price             = (int)    $arr['price'];
		$obj->year              = (int)    $arr['year'];
		$obj->short_description = (string) $arr['short_description'];
		$obj->description       = (string) $arr['description'];
		$obj->is_new            = (bool)   $arr['is_new'];
		$obj->is_recomended     = (bool)   $arr['is_recomended'];
		$obj->status            = (bool)   $arr['status'];

		try {
			$category = Category::findFirst(array("id" => $arr['category_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['category_id'], "wrong id in db", $e));
		}
		$obj->category = $category; //class

		try {
			$producer = Producer::findFirst(array("id" => $arr['producer_id']), true);
		} catch(RecordNotFoundException $e) {
			throw new UncheckedLogicException("data in db must be valide",
				new WrongDataException($arr['producer_id'], "wrong id in db", $e));
		}
		$obj->producer = $producer; //class

		return $obj;
	}
//construct end

}