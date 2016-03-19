<?php

class WrongDataException extends Exception {

	public function __construct($data = null, string $message = null) {
		if(is_object($data)) {
			$data = "Class ".get_class($data);
		} elseif(is_array($data)) {
			$data = "Array(".json_encode($data).")";
		}

		$m = array();
		if(strval($data) !== '') {
			$m[] = "unexpected data: $data";
		}
		if($message) {
			$m[] = $message;
		}
		parent::__construct(implode(", ", $m), 0, null);
	}

}