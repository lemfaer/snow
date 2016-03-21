<?php

class UncheckedException extends Exception {

	public function __construct($message, Exception $prev = null) {
		parent::__construct($message, 0, $prev);
	}

}