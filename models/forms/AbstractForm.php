<?php

/**
 * Описывает структуру классов выполняющих проверку форм
 * и выполняющих необходимые действия после отправки.
 * 
 * @package models_forms
 * @author  Alan Smithee
 * @abstract
 */
abstract class AbstractForm {

	/**
	 * Изначальная реализация метода check
	 * Выполняет валидацию данных полученных из формы
	 * 
	 * Выполняет валидацию данных из формы на основе нужного валидатора 
	 * и метода валидации. Формирует массив для отправки обратно на форму
	 * 
	 * @param array $data массив переданный из формы
	 * @param Closure $valMethod замыкание возвращает метод для валидации полученных данных
	 * @param AbstractValidator $validator валидатор
	 * @return type
	 */
	protected static function checkParamsDefault(array $data, Closure $valMethod, AbstractValidator $validator) : array {
		$check = true;
		foreach ($data as $key => $value) {
			$method = $valMethod($key);
			if(!is_array($method)) {
				$method = array($validator, $method);
			}
			$paramCheck = call_user_func($method, $value);

			$result['single'][$key] = $paramCheck;
			if(!$paramCheck) {
				$error = $validator->errorInfo();
				$result['error'][$key] = array_pop($error);
			}
			$check = $paramCheck && $check;
		}

		$result['success'] = $check;

		return $result;
	}

	/**
	 * Выполняет проверку данных полученных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	abstract public static function check(array $data) : string;

	/**
	 * Выполняет необходимые действия с данными
	 * 
	 * @param array $data массив переданный из формы
	 * @return void
	 */
	abstract public static function submit(array $data);

}