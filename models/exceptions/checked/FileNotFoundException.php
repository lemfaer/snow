<?php

class FileNotFoundException extends CheckedException {

	protected $path;

	public function __construct(string $path) {
		parent::__construct("Empty result with Path($path)");
		$this->path = $path;
	}

	public function getPath() : string {
		return $this->path;
	}

}