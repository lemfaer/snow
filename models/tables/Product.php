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
	public function getID() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getProducer() {
		return $this->producer;
	}
        
    public function getPrice() {
    	return $this->price;
    }

    public function getYear() {
		return $this->year;
    }

	public function getShortDescription() {
		return $this->short_description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getCategory() {
		return $this->category;
	}

	public function isNew() {
		return $this->is_new;
	}

	public function isRecomended() {
		return $this->is_recomended;
	}

	public function getStatus() {
		return $this->status;
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

class ProductValidator extends AbstractValidator {

//const
	const CLASS_NAME = "Product";

	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";

	const NAME_ERROR		= "Неправильный ввод имени";
	const PRICE_ERROR		= "Неправильный ввод цены";
	const YEAR_ERROR		= "Неправильный ввод года";
	const SHORTDESC_ERROR	= "Неправильный ввод краткого описания";
	const DESCRIPTION_ERROR	= "Неправильный ввод описания";
	const NEW_ERROR			= "Неправильное поле new";
	const RECOMENDED_ERROR	= "Неправильное поле recomended";
//const end

//check
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}

	public function checkProducer(Producer $producer) : bool {
		$error = array("producer" => parent::PRODUCER_OBJECT_ERROR);
		return parent::checkObject($producer, $error);
	}

	public function checkPrice(int $price) : bool {
		$error = array("price" => self::PRICE_ERROR);
		$bool = $price > 0;
		return parent::log($bool, $error);
	}

	public function checkYear(int $year) : bool {
		$error = array("year" => self::YEAR_ERROR);
		$bool = $year >= (int)date("Y", 0) && $year <= (int)date("Y");
		return parent::log($bool, $error); 
	}

	public function checkShortDescription(string $short_description) : bool {
		$error = array("short_description" => self::SHORTDESC_ERROR);
		return parent::log(true, $error);
	}

	public function checkDescription(string $description) : bool {
		$error = array("description" => self::DESCRIPTION_ERROR);
		return parent::log(true, $error);
	}

	public function checkCategory(Category $category) : bool {
		$error = array("category" => parent::CATEGORY_OBJECT_ERROR);
		return parent::checkObject($category, $error);
	}

	public function checkNew(bool $is_new) : bool {
		$error = array("is_new" => self::NEW_ERROR);
		return parent::log(true, $error);
	}

	public function checkRecomended(bool $is_recomended) : bool {
		$error = array("is_recomended" => self::RECOMENDED_ERROR);
		return parent::log(true, $error);
	}
//check end

}