<?php

class QueryEmptyResultException extends CheckedException {

	protected $query;

	public function __construct(string $query) {
		parent::__construct("Empty result with Query($query)");
		$this->query = $query;
	}

	public function getQuery() : string {
		return $this->query;
	}

}