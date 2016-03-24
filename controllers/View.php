<?php

class View {

	const HTML_COMMENT_PATTERN = "/<!--(.*?)-->/";

	public static function template(string $contentPath, array $compact = array()) {
		$contentPath = ROOT."/views/".$contentPath;

		$head    = file_get_contents(ROOT."/views/template/head.php");
		$header  = file_get_contents(ROOT."/views/template/header.php");
		$content = file_get_contents($contentPath);
		$footer  = file_get_contents(ROOT."/views/template/footer.php");

		$code = $head.$header.$content.$footer;
		$code = preg_replace(self::HTML_COMMENT_PATTERN, '', $code);

		$cart = Cart::getCart();
		extract($compact);

		eval("?>".$code);
	}

	public static function empty(string $contentPath, array $compact = array()) {
		$contentPath = ROOT."/views/".$contentPath;
		$content = file_get_contents($contentPath);
		
		$content = preg_replace(self::HTML_COMMENT_PATTERN, '', $content);

		extract($compact);

		eval("?>".$content);
	}

}