<?php

abstract class AbstractForm {

	protected static function checkParamsDefault(array $data, Closure $valMethod, AbstractValidator $validator) : array {
		$check = true;
		foreach ($data as $key => $value) {
			$method = $valMethod($key);
			$paramCheck = ($validator->$method)($value);
			$result['single'][$key] = $paramCheck;
			$check = $paramCheck && $check;
		}

		$result['error'] = $validator->errorInfo();
		$result['success'] = $check;

		return $result;
	}

	abstract static function check(array $data) : string;

	abstract static function submit(array $data);

}