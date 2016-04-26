<?php

class IndentItemValidator extends AbstractValidator {

//const
	const CARGOLIST_CLASS_ERROR = 
		"Переданный массив содержит не обьекты класса Cargo";

	const CARGO_DATA_ERROR = 
		"Один или несколько переданных обьектов cargo не содержат необходимых данных";
//const end

//validate methods
	public function checkIndent(Indent $indent) : bool {
		$error = array("indent" => parent::INDENT_OBJECT_ERROR);
		return parent::checkObject($indent, $error);
	}

	public function checkCargoList(array $cargoList) : bool {
		$errorClass = array("cargoList" => self::CARGOLIST_CLASS_ERROR);
		$errorData  = array("cargoList" => self::CARGO_DATA_ERROR);

		foreach ($cargoList as $cargo) {
			if(!parent::checkClass($cargo, "Cargo", $errorClass)) {
				return false;
			}

			$rc = new ReflectionClass($cargo);
			$rp = $rc->getProperty("indent");
			$rp->setAccessible(true);
			$rp->setValue($cargo, new Indent());

			if($cargo->isNull()) {
				return parent::log(false, $errorData);
			}
		}

		return parent::log(true, array("cargoList" => ""));
	}
//validate methods

}