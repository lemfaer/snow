<?php

class RecordNotFoundException extends QueryEmptyResultException {

	public function __construct(QueryEmptyResultException $e) {
		parent::__construct($e->getQuery(), $e);
		$this->message = "Record not found with Query(".$e->getQuery().")";
	}

}