<?php

class View {

	public static function template(string $contentView, array $compact = array()) {
		$contentView = ROOT."/views/".$contentView;
		$cart = Cart::getCart();
		extract($compact);

		require_once(ROOT."/views/template/index.php");
	}

	public static function empty(string $contentView, array $compact = array()) {
		$contentView = ROOT."/views/".$contentView;
		extract($compact);

		require_once($contentView);
	}

}