<?php

class ContactValidator extends AbstractTableValidator {

//const
	const CLASS_NAME = "Contact";
	//
	//кириллица, латиница, цифры, пробел, дефис. 1-99 символов
	const NAME_PATTERN = "/^[A-Za-zА-Яа-яЁё0-9\- ]{1,99}$/u";
	//+380 пбобел ([три цифры]) пробел [три цифры]-[две цифры]-[две цифры]
	const PHONE_PATTERN = "/^\+38 \([0-9]{3}\) [0-9]{3}\-[0-9]{2}\-[0-9]{2}$/u";
	//любой символ. 1-254 символов
	const ADDRESS_PATTERN = "/^.{1,254}$/u";

	const NAME_ERROR    = "Неправильный ввод имени";
	const PHONE_ERROR   = "Неправильный ввод телефона";
	const ADDRESS_ERROR = "Неправильный ввод адреса";
//const end

//validate methods
	public function checkName(string $name) : bool {
		$error = array("name" => self::NAME_ERROR);
		return parent::checkString($name, self::NAME_PATTERN, $error);
	}

	public function checkPhone(string $phone) : bool {
		$error = array("phone" => self::PHONE_ERROR);
		return parent::checkString($phone, self::PHONE_PATTERN, $error);
	}

	public function checkAddress(string $address) : bool {
		$error = array("address" => self::ADDRESS_ERROR);
		return parent::checkString($address, self::ADDRESS_PATTERN, $error);
	}

	public function checkUser(User $user) : bool {
		$error = array("user" => parent::USER_OBJECT_ERROR);
		return parent::checkObject($user, $error);
	}
//validate methods end

}