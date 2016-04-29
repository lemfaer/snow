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
		return IMAGE.parent::get($this->path700);
	}

	public function getPath135() : string {
		return IMAGE.parent::get($this->path135);
	}

	public function getPath50() : string {
		return IMAGE.parent::get($this->path50);
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
	//setters end
//main info end

//link
	public function link() {
		$sub = "//images.".$_SERVER['HTTP_HOST'];
		return $sub.$this->path700;
	}

	public function link135() {
		$sub = "//images.".$_SERVER['HTTP_HOST'];
		return $sub.$this->path135;
	}

	public function link50() {
		$sub = "//images.".$_SERVER['HTTP_HOST'];
		return $sub.$this->path50;
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

	public static function withUploadedFile(array $uf) : Image {
		$val = new ImageValidator();
		if(!$val->checkUploadedFile($uf)) {
			throw new WrongDataException($uf, implode(", ", $val->errorInfo()));
		}
		
		$url = $uf['tmp_name'];
		$im = new Imagick($url);

		return self::withImagick($im);
	}

	public static function withImagick(Imagick $im) : Image {
		$val = new ImageValidator();
		if(!$val->checkImagick($im)) {
			throw new WrongDataException($im, implode(", ", $val->errorInfo()));
		}

		$obj = new self();
		$obj->imagick($im);

		$obj->setStatus(true);
		$obj->insert();

		return $obj;
	}
//construct end

//imagick
	public function imagick(Imagick $im) {
		$im700 = $im;
		$im700->adaptiveResizeImage(700, 700);
		$this->path700 = $this->create($im700);

		$im135 = $im;
		$im135->adaptiveResizeImage(135, 135);
		$this->path135 = $this->create($im135);

		$im50 = $im;
		$im50->adaptiveResizeImage(50, 50);
		$this->path50 = $this->create($im50);
	}

	private function create(Imagick $im) {
		$dir = substr(md5(microtime()), mt_rand(0, 30), 2).'/'.
			substr(md5(microtime()), mt_rand(0, 30), 2);
		
		$relPath = "/$dir";
		$absPath = IMAGE.$relPath;
		if(!file_exists($absPath)) {
			mkdir($absPath, 0777, true);
		}

		$name = substr($im->getImageSignature(), 0, 10).".jpg";

		$relPath = $relPath."/".$name;
		$absPath = $absPath."/".$name;

		$im->writeImage($absPath);
		
		return $relPath;
	}
//imagick end

//destruct
	public function __destruct() {
		if(!isset($this->id)) { // here must be isSaved
			unlink($this->getPath());
			unlink($this->getPath135());
			unlink($this->getPath50());
		}
	}
//destruct end

}