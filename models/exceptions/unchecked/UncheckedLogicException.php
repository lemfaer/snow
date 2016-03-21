<?php

final class UncheckedLogicException extends UncheckedException {

	public function __construct($message, Exception $prev = null) {
		parent::__construct($message, $prev);
	}

}