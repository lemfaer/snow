<?php
	
	function __autoload($className) {

		$pathArray = array(
			"/components/",
			"/controllers/",
			"/controllers/admin/",
			"/controllers/cart/",
			"/controllers/main/",
			"/controllers/order/",
			"/controllers/preview/",
			"/controllers/shop/",
			"/controllers/user/",
			"/models/", 
			"/models/exceptions/checked/",
			"/models/exceptions/unchecked/",
			"/models/forms/",
			"/models/forms/admin/",
			"/models/items/",
			"/models/items/validators/",
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