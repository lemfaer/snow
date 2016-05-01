<?php

class PageNotFoundException extends CheckedException {

	private $url;

	public function __construct($message, $prev = null) {
		$this->url = $_SERVER['REQUEST_URI'];
		$message = "Page not found with Url({$this->url}), $message";
		parent::__construct($message, $prev);
	}

}