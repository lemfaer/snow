<?php

class ImageValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Image";

	const PATH_ERROR = "Указан неправильный путь";
//const end

//validate methods
	public function checkPath(string $path) : bool {
		$error = array("path" => self::PATH_ERROR);
		$path = ROOT."/images/".$path;
		//return parent::log(file_exists($path), $error);
		return true;
	}
//validate methods end

}