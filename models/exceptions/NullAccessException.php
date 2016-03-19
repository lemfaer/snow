<?php

class NullAccessException extends Exception {

	public function __construct() {
		parent::__construct();
	}

}