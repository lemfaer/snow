<?php

class QueryException extends Exception {

	protected $query;

	public function __construct(string $query, string $message = null) {
		$m[] = "with Query($query)";
		if($message) {
			$m[] = $message;
		}
		parent::__construct(implode(", ", $m), 0, null);
		$this->query = $query;
	}

	public function getQuery() : string {
		return $query;
	}

}