<?php

class WrongDataException extends CheckedException {

	private $data;

	public function __construct($data = null, $message = null, Exception $prev = null) {
		$this->data = $data;
		if(is_object($data)) {
			$data = "Class ".get_class($data);
		} elseif(is_array($data)) {
			$data = "Array(".json_encode($data).")";
		}

		$m = array();
		if((string) $data !== '') {
			$m[] = "unexpected data: $data";
		}
		if(isset($message)) {
			$m[] = $message;
		}

		parent::__construct(implode(", ", $m), $prev);
	}

	public function getData() {
		return $this->data;
	}

}