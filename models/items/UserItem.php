<?php

/**
 * Класс содержит основную и контактную информацию о пользователе
 * 
 * Класс содержит основную и контактную информацию о пользователе
 * Методы класса дают возможность получить доступ, 
 * изменять содержимое основной и контактной информации 
 * о пользователе, сохранять изменения в базе данных. 
 * 
 * @package models_items
 * @author  Alan Smithee
 * @final
 */
class UserItem extends AbstractRecord {

//main info
	/**
	 * @var User    $user    Объект, содержащий основную информацию о пользователе
	 * @var Сontact $contact Объект, содержащий контактную информацию о пользователе
	 */
	private $user;
	private $contact;

	//getters
	/**
	 * Возвращает объект, содержащий основную информацию о пользователе
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return User информация о товаре
	 */
	public function getUser() : User {
		return parent::get($this->user);
	}

	/**
	 * Возвращает объект, содержащий контактную информацию о пользователе
	 * 
	 * @throws NullAccessException поле не заполнено
	 * @return Contact информация о товаре
	 */
	public function getContact() : Contact {
		return parent::get($this->contact);
	}
	//getters end

	//setters
	/**
	 * Устанавливает основную информацию о пользователе
	 * 
	 * @param User $user основная информация о пользователе
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setUser(User $user) {
		$this->user = parent::set($user, "checkUser");
	}

	/**
	 * Устанавливает контактную информацию о пользователе
	 * 
	 * @param Contact $contact контактная информация о пользователе
	 * @throws WrongDataException передано неправильное значение
	 * @return void
	 */
	public function setContact(Contact $contact) {
		$this->contact = parent::set($contact, "checkContact");
	}
	//setters end
//main info end

//init
	/**
	 * Инициализирует контактную информацию о пользователе
	 * на основе объекта User в свойстве $user
	 * 
	 * @throws WrongDataException объект User не установлен
	 * @return void
	 */
	private function contact() {
		try {
			$id = $this->getUser()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "user not set", $e);
		}

		try {
			$contact = Contact::findFirst(array("user_id" => $id), true);
		} catch(RecordNotFoundException $e) {
			$contact = null;
		}

		$this->contact = $contact; 
	}
//init end

//check
	/**
	 * Проверяет сохранена ли контактная информация о пользователе в базе данных
	 * 
	 * Возвращает true если в базе данных присутствует контактная информация
	 * Возвращает false если в базе данных отсутствует контактная информация
	 * 
	 * @throws WrongDataException объект User не установлен 
	 * @return bool сохранена ли контактная информация
	 */
	public function isIn() {
		try {
			$id = $this->getUser()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "user not set", $e);
		}

		return Contact::findCount(array("user_id" => $id), true) > 0;
	}
//check end

//construct
	/**
	 * Конструктор
	 * 
	 * @param User $user объект, содержащий основную информацию о пользователе
	 * @throws WrongDataException передан неправильный объект User
	 * @return UserItem обьект класса
	 */
	public static function withUser(User $user) : UserItem {
		$obj = new self();

		$obj->setUser($user); // no exception check

		try {
			$obj->contact();
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("user has been set", $e);
		}

		return $obj;
	}

	/**
	 * Приватный конструктор
	 * Устанавливает валидатор
	 */
	private function __construct() {
		$this->validator = new UserItemValidator();
	}
//construct end

//abstract methods realization
	/**
	 * Находит количество записей по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @return int количество найденных записей
	 */
	public static function findCount(array $whereArr = array(), bool $nullStatus = false) : int {
		return User::findCount($whereArr, $nullStatus);
	}

	/**
	 * Находит первую запись по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @throws RecordNotFoundException запись не найдена
	 * @return AbstractRecord первая запись
	 */
	public static function findFirst(array $whereArr = array(), bool $nullStatus = false) : AbstractRecord {
		$user = User::findFirst($whereArr, $nullStatus);
		$userItem = self::withUser($user);
		return $userItem;
	}

	/**
	 * Находит все записи по параметрам
	 * 
	 * @param array $whereArr параметры запроса поиска
	 * @param bool $nullStatus включать ли записи со статусом '0'
	 * @throws RecordNotFoundException записи не найдены
	 * @return array<AbstractRecord> записи
	 */
	public static function findAll(array $whereArr = array(), string $order = "id ASC", int $limit = parent::LIMIT_MAX, int $offset = 0, bool $nullStatus = false) : array {
		$userList = User::findAll($whereArr, $order, $limit, $offset, $nullStatus);
		foreach ($userList as $i => $user) {
			$userList[$i] = self::withUser($user);
		}
		return $userList;
	}

	/**
	 * Добавляет запись в базу данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function insert() {
		if($this->isIn()) { // no exception check
			throw new WrongDataException($this, "already in database");
		}

		try {
			$id = $this->getUser()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "user not set", $e);
		}

		if(isset($this->contact)) {
			try {
				$this->contact->getID();
				$ioru = true;
			} catch(NullAccessException $e) {
				$ioru = false;
			}

			try {
				$this->contact->setUser($this->user);

				if($ioru) {
					$this->contact->insert();
				} else {
					if(!$this->contact->isSaved()) {
						$this->contact->update();
					}
				}
			} catch(WrongDataException $e) {
				throw new UncheckedLogicException("data has been checked", $e);
			}
		}
	}

	/**
	 * Обновляет запись в базе данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function update() {
		if(isset($this->contact)) {
			try {
				$this->contact->getID();
				$ioru = false;
			} catch(NullAccessException $e) {
				$ioru = true;
			}

			try {
				$this->contact->setUser($this->user);

				if($ioru) {
					$this->contact->insert();
				} else {
					if(!$this->contact->isSaved()) {
						$this->contact->update();
					}
				}
			} catch(WrongDataException $e) {
				throw new UncheckedLogicException("data has been checked", $e);
			}
		}
	}

	/**
	 * Удаляет запись из базы данных на основе свойств обьекта
	 * 
	 * @throws WrongDataException неправильные свойства обьекта
	 * @return void
	 */
	public function delete() {
		try {
			$id = $this->getUser()->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($this, "user not set", $e);
		}

		try {
			if(isset($this->contact)) {
				$this->contact->getID(); // id isset check
				$this->contact->delete();
			}
		} catch(NullAccessException $e) {}

		try {
			$contactList = Contact::findAll(array("user_id" => $id), true);
		} catch(RecordNotFoundException $e) {
			$contactList = array();
		}

		foreach ($contactList as $contact) {
			$contact->delete();
		}
	}
//abstract methods realization

//isset/unset contact
	/**
	 * Проверяет наличие объекта, содержащего контактную информацию о пользователе
	 * 
	 * Возвращает true если контактную информация установлена
	 * Возвращает false если контактную информация не установлена
	 * 
	 * @return bool установлена ли контактная информация
	 */
	public function issetContact() : bool {
		return isset($this->contact);
	}

	/**
	 * Удаляет значение объекта, содержащего контактную информацию
	 * 
	 * @return void
	 */
	public function unsetContact() {
		unset($this->contact);
	}
//isset/unset contact end

}