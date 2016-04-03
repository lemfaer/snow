<?php

/**
 * Описывает структуру форм для создания или редактирования записей в базе данных
 * (CRUP = CReate + UPdate)
 * 
 * @package models_forms_admin
 * @author  Alan Smithee
 * @abstract
 */
abstract class AbstractCRUPForm extends AbstractForm {

	/**
	 * Создает или редактирует запись в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @return void
	 */
	public static function submit(array $data) {
		$class = get_called_class();
		if(isset($data['id'])) {
			$class::update($data);
		} else {
			$class::create($data);
		}
	}

	/**
	 * Создает новую запись в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @return void
	 */
	abstract public static function create(array $data);

	/**
	 * Редактирует запись в базе данных на основе данных из формы
	 * 
	 * @param array $data массив переданный из формы
	 * @return void
	 */
	abstract public static function update(array $data);

}