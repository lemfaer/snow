<?php

class RecordSelectException extends Exception {

	public function __construct(QueryException $e) {
		parent::__construct('', 0, $e);
	}

}