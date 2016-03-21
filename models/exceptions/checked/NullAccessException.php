<?php

class NullAccessException extends CheckedException {

	public function __construct() {
		parent::__construct("Access to not inited value");
	}

}