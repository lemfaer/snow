<?php

class RecordInsertException extends Exception {

	public function __construct(QueryException $e) {
		parent::__construct('', 0, $e);
	}

}