<?php

class ImageValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Image";

	const IMAGE_MIN_X = 700;
	const IMAGE_MIN_Y = 700;

	const PATH_ERROR = "Указан неправильный путь";

	const IMAGE_TYPE_ERROR = "Передан файл с неправильным расширение";
	const IMAGE_MIN_XY_ERROR   = "Размер изображения меньше 700x700";
//const end

//validate methods
	public function checkPath(string $path) : bool {
		$error = array("path" => self::PATH_ERROR);
		$path = ROOT."/images/".$path;
		//return parent::log(file_exists($path), $error);
		return true;
	}

	private function checkImage($im) : bool {
		$error = array("image" => self::IMAGE_MIN_XY_ERROR);
		$bool  = (imagesx($im) >= self::IMAGE_MIN_X)
			&& (imagesy($im) >= self::IMAGE_MIN_Y);
		return  parent::log($bool, $error);
	}

	public function checkUploadedFile(array $uf) : bool {
		$error = array("image" => self::IMAGE_TYPE_ERROR);
		$type = $uf['type'];
		if($type !== "image/jpeg") {
			return parent::log(false, $error);
		}

		$url = $uf['tmp_name'];
		$im  = imagecreatefromjpeg($url); 
		return self::checkImage($im);
	}
//validate methods end

}