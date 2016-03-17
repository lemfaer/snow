<?php
	
	function __autoload($className) {

		$pathArray = array(
			"/components/",
			"/controllers/", 
			"/models/", 
			"/models/tables/", 
			"/models/tables/validators/",
		);

		foreach($pathArray as $path) {
			$path = ROOT.$path.$className.".php";

			if(file_exists($path)) {
				require_once($path);
			}
		}

	}