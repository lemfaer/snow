<?php

/**
 * Класс для отображения файлов представления
 * 
 * @package controllers
 * @author  Alan Smithee
 * @final
 * @static
 */
final class View {

	const HTML_COMMENT_PATTERN = "/<!--(.*?)-->/";

	/**
	 * Отображает выбранное представление
	 * 
	 * @param string $contentPath путь к файлу представления
	 * @param array $compact необходимые данные для отображения
	 * @throws FileNotFoundException файл не найден
	 * @return void
	 */
	public static function empty(string $contentPath, array $compact = array()) {
		$relPath = $contentPath;
		$absPath = ROOT."/views".$relPath;

		if(!file_exists($absPath)) {
			throw new FileNotFoundException($absPath);
		}

		$content = file_get_contents($absPath);
		$content = preg_replace(self::HTML_COMMENT_PATTERN, '', $content);

		extract($compact);
		eval("?>".$content);
	}

	/**
	 * Отображает выбранное представление с шаблоном
	 * 
	 * @param string $contentPath путь к файлу представления
	 * @param array $compact необходимые данные для отображения
	 * @throws FileNotFoundException файл не найден
	 * @return void
	 */
	public static function template(string $contentPath, array $compact = array()) {
		$cart   = Cart::get();
		$client = Client::logged() ? Client::get() : null;

		$compact = array_replace(compact("cart", "client"), $compact);

		self::empty("/template/index.php", compact("contentPath", "compact", "cart", "client"));
	}

	/**
	 * Отображает выбранное представление с шаблоном администраторской панели
	 * 
	 * @param string $contentPath путь к файлу представления
	 * @param array $compact необходимые данные для отображения
	 * @throws FileNotFoundException файл не найден
	 * @return void
	 */
	public static function admin(string $contentPath, array $compact = array()) {
		$contentPath = "/admin".$contentPath;

		$client = Client::get();

		$compact = array_replace(compact("client"), $compact);

		self::empty("/admin/template/index.php", compact("contentPath", "compact", "client"));
	}

	/**
	 * Приватный конструктор
	 */
	private function __construct() {}

}