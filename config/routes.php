<?php

	return array(

		"category/([a-z]+)/([a-z]+)" => "shopCategory/redirect/$1/$2",
		"category/([a-z]+)" => "shopCategory/index/$1",
		"category" => "shopCategory/index",

		"products/([0-9]+)/page-([0-9]+)" => "shopCatalog/index/$1/$2",
		"products/([0-9]+)" => "shopCatalog/index/$1",

		"product/([0-9]+)" => "shopProduct/index/$1",
	);