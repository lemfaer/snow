<?php

class ImageValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Image";

	const IMAGE_MIN_X = 700;
	const IMAGE_MIN_Y = 700;

	const PATH_ERROR = "Указан неправильный путь";

	const IMAGE_NULL_ERROR   = "Изображение не передано";
	const IMAGE_TYPE_ERROR   = "Передан файл с неправильным расширением";
	const IMAGE_MIN_XY_ERROR = "Размер изображения меньше 700x700";
//const end

//validate methods
	public function checkPath(string $path) : bool {
		$error = array("path" => self::PATH_ERROR);
		$path = ROOT."/images/".$path;
		return parent::log(file_exists($path), $error);
	}

	public function checkImagick(Imagick $im) : bool {
		$error = array("image" => self::IMAGE_MIN_XY_ERROR);
		$bool  = ($im->getImageWidth() >= self::IMAGE_MIN_X)
			&& ($im->getImageHeight() >= self::IMAGE_MIN_Y);
		return parent::log($bool, $error);
	}

	public function checkUploadedFile(array $uf) : bool {
		$bool = false;
		$type = $uf['type'];
		$error = array("image" => self::IMAGE_NULL_ERROR);
		if($type) {
			$error = array("image" => self::IMAGE_TYPE_ERROR);
			if($type === "image/jpeg") {
				$bool = true;
			}
		}
		if($bool) {
			$url = $uf['tmp_name'];
			$im  = new Imagick($url); 
			return self::checkImagick($im);
		} else {
			return parent::log(false, $error);
		}
	}
//validate methods end

}