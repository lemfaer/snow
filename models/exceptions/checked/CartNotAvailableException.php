<?php

class CartNotAvailableException extends CheckedException {

	public function __construct($message, $prev = null) {
		parent::__construct($message, $prev);
	}

}