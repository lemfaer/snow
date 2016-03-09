<?php

	return array(

		"category" => "shopCategory/index",
		"category/([a-z]+)" => "shopCategory/index/$1",
		"category/([a-z]+)/([a-z]+)" => "shopCategory/redirect/$1/$2",

		"products/([0-9]+)" => "shopCatalog/index/$1",
		"products/([0-9]+)/page-([0-9]+)" => "shopCatalog/index/$1/$2",

		"product/([0-9]+)" => "shopProduct/index/$1",

		"register" => "userRegister/index",
		"register/submit" => "userRegister/submit",  

		"test" => "test/test",
	);