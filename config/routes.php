<?php

	return array(

		"category" => "category/index",
		"category/([a-z]+)" => "category/index/$1",
		"category/([a-z]+)/([a-z]+)" => "category/redirect/$1/$2",

		"products/([0-9]+)" => "catalog/index/$1",
		"products/([0-9]+)/page-([0-9]+)" => "catalog/index/$1/$2",

		"product/([0-9]+)" => "product/index/$1",

		"cart" => "cart/index",
		"cart/mini" => "cart/mini",
		"cart/inc" => "cart/inc",
		"cart/dec" => "cart/dec",
		"cart/add" => "cart/add",
		"cart/add/options"  => "cart/addOptions",
		"cart/delete" => "cart/delete",
		"cart/subtotal" => "cart/subTotal",
		"cart/total" => "cart/total",

		"register" => "register/index",
		"register/check" => "register/check",
		"register/submit" => "register/submit",

		"login" => "login/index",
		"login/check" => "login/check",
		"login/submit" => "login/submit",

		"test" => "test/test",

		"admin" => "admin/index",
	);