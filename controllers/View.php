<?php

class View {

	const HTML_COMMENT_PATTERN = "/<!--(.*?)-->/";

	public static function empty(string $contentPath, array $compact = array()) {
		$contentPath = ROOT."/views/".$contentPath;
		$content = file_get_contents($contentPath);
		
		$content = preg_replace(self::HTML_COMMENT_PATTERN, '', $content);

		extract($compact);

		eval("?>".$content);
	}

	public static function template(string $contentPath, array $compact = array()) {
		$code = file_get_contents(ROOT."/views/template/index.php");
		$code = preg_replace(self::HTML_COMMENT_PATTERN, '', $code);

		$cart   = Cart::get();
		$client = Client::logged() ? Client::get() : null;

		$compact = array_replace(compact("cart", "client"), $compact);

		eval("?>".$code);
	}

	public static function admin(string $contentPath, array $compact = array()) {
		$code = file_get_contents(ROOT."/views/admin/template/index.php");
		$code = preg_replace(self::HTML_COMMENT_PATTERN, '', $code);
		eval("?>".$code);
	}

}