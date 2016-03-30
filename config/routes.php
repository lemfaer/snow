<?php

	return array(

		"category" => "category/index",
		"category/([a-z]+)" => "category/index/$1",
		"category/([a-z]+)/([a-z]+)" => "category/redirect/$1/$2",

		"products/([0-9]+)" => "catalog/index/$1",
		"products/([0-9]+)/page-([0-9]+)" => "catalog/index/$1/$2",

		"product/([0-9]+)" => "product/index/$1",

		"cart"        => "cart/index",
		"cart/inc"    => "cart/inc",
		"cart/dec"    => "cart/dec",
		"cart/add"    => "cart/add",
		"cart/mini"   => "cart/mini",
		"cart/total"  => "cart/total",
		"cart/delete" => "cart/delete",
		"cart/subtotal" => "cart/subTotal",
		"cart/add/options"  => "cart/addOptions",

		"register"        => "register/index",
		"register/check"  => "register/check",
		"register/submit" => "register/submit",

		"login"        => "login/index",
		"login/check"  => "login/check",
		"login/submit" => "login/submit",


		//admin
		"test" => "test/test",

		"admin" => "admin/index",

		"admin/([a-z]+)" => "admin/read/$1",
		"admin/([a-z]+)/create" => "admin/create/$1",
		"admin/([a-z]+)/read"   => "admin/read/$1",
		"admin/([a-z]+)/update/([0-9]+)" => "admin/update/$1/$2",
		"admin/([a-z]+)/delete/([0-9]+)" => "admin/delete/$1/$2",

		"admin/([a-z]+)/crup/check"  => "admin/CRUPCheck/$1",
		"admin/([a-z]+)/crup/submit" => "admin/CRUPSubmit/$1",

	);