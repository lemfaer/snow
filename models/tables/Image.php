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

	public function setByUploadedFile(array $uf) {
		$uf = parent::set($uf, "checkUploadedFile");
		
		$url = $uf['tmp_name'];
		$im  = imagecreatefromjpeg($url);

		$this->setImage($im);
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
//construct end

//gd
	private function setImage($im) {
		$this->create700($im);
		$this->create135($im);
		$this->create50($im);
	}

	private function create700($im) {
		$im = imagescale($im, 700, 700);
		$this->path700 = $this->createImage($im);
	}

	private function create135($im) {
		$im = imagescale($im, 135, 135);
		$this->path135 = $this->createImage($im);
	}

	private function create50($im) {
		$im = imagescale($im, 50, 50);
		$this->path50 = $this->createImage($im);
	}

	private function createImage($im) : string {
		$dir = substr(md5(microtime()), mt_rand(0, 30), 2).'/'.
			substr(md5(microtime()), mt_rand(0, 30), 2);
		
		$relPath = "/$dir";
		$absPath = IMAGE.$relPath;
		if(!file_exists($absPath)) {
			mkdir($absPath, 0777, true);
		}

		ob_start();
		imagejpeg($im);
		$bin = ob_get_contents();
		ob_end_clean();
		$name = md5($bin).".jpg";

		$relPath = $relPath."/".$name;
		$absPath = $absPath."/".$name;

		imagejpeg($im, $absPath);
		
		return $relPath;
	}
//gd end

//destruct
	public function __destruct() {
		if(!isset($this->id)) { // here must be isSaved
			unlink(IMAGE.$this->path700);
			unlink(IMAGE.$this->path135);
			unlink(IMAGE.$this->path50);
		}
	}
//destruct end

}