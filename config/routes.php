<?php

	return array(

		"category" => "shopCategory/index",
		"category/([a-z]+)" => "shopCategory/index/$1",
		"category/([a-z]+)/([a-z]+)" => "shopCategory/redirect/$1/$2",

		"products/([0-9]+)" => "shopCatalog/index/$1",
		"products/([0-9]+)/page-([0-9]+)" => "shopCatalog/index/$1/$2",

		"product/([0-9]+)" => "shopProduct/index/$1",

		"cart/" => "cart/index",
		"cart/get/([0-9]+)" => "cart/get/$1",
		"cart/inc/([0-9]+)" => "cart/inc/$1",
		"cart/dec/([0-9]+)" => "cart/dec/$1",
		"cart/add/([0-9]+)" => "cart/add/$1",
		"cart/delete/([0-9]+)" => "cart/delete/$1",

		"register" => "userRegister/index",
		"register/check" => "userRegister/check",
		"register/submit" => "userRegister/submit",

		"login" => "userLogin/index",
		"login/check" => "userLogin/check",
		"login/submit" => "userLogin/submit",

		"test" => "test/test",
	);