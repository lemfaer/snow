<?php

class Files {

	private static $_files;

	public static function get() : array {
		if(!isset(self::$_files)) {
			self::_files();
		}
		return self::$_files;
	}

//construct
	private static function _files() {
		$files = $_FILES;

		foreach ($files as $key => $value) {
			$files[$key] = array();
			foreach (self::rec($value) as $value) {
				$files[$key] = array_replace_recursive($files[$key], $value);
			}
		}

		self::$_files = $files;
	}

	private static function rec($tix, string $field = null) {
		if(is_array($tix)) {
			foreach ($tix as $key => $value) {
				$tix[$key] = self::rec($value, $field ?? $key);
			}
		} else {
			$tix = array($field => $tix);
		}

		return $tix;
	}
//construct end

}