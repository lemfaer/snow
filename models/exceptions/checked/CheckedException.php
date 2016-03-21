<?php

class CheckedException extends Exception {

	public function __construct($message, CheckedException $prev = null) {
		parent::__construct($message, 0, $prev);
	}

}