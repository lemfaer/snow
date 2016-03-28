<?php

class View {

	const HTML_COMMENT_PATTERN = "/<!--(.*?)-->/";

	public static function template(string $contentPath, array $compact = array()) {
		$code = file_get_contents(ROOT."/views/template/index.php");
		$code = preg_replace(self::HTML_COMMENT_PATTERN, '', $code);
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