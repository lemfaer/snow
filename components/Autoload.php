<?php
	
	function __autoload($className) {

		$pathArray = array("/components/", "/models/", "/controllers/");

		foreach($pathArray as $path) {
			$path = ROOT.$path.$className.".php";

			if(file_exists($path)) {
				require_once($path);
			}
		}

	}