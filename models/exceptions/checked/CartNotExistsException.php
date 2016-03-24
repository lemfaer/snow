<?php

class CartNotExistsException extends CheckedException {

	public function __construct($message, $prev = null) {
		parent::__construct($message, $prev);
	}

}