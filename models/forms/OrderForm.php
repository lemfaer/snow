<?php

/**
 * Обрабатыает запросы связанные с Order формой 
 * 
 * @package models_forms
 * @author  Alan Smithee
 * @final
 */
final class OrderForm extends AbstractForm {

	/**
	 * Выполняет валидацию данных полученных из формы Order
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданые данные невозможно проверить
	 * @return string массив в формате json, ответ на ajax запрос
	 */
	public static function check(array $data) : string {
		$validator = new ContactValidator();

		$method = function(string $key) : string {
			switch ($key) {
				case "name":
					$m = "checkName";
					break;
				case "phone":
					$m = "checkPhone";
					break;
				case "address":
					$m = "checkAddress";
					break;
				default:
					throw new WrongDataException($key);
			}
			return $m;
		};

		$result = parent::checkParamsDefault($data, $method, $validator);
		return json_encode($result);
	}

	/**
	 * Создает новый заказ пользователя на сайте
	 * 
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return void
	 */
	public static function submit(array $data) {
		if(!Cart::get()) {
			throw new WrongDataException("empty cart", $e);
		}

		try {
			try {
				$user = User::findFirst(array("id" => $data['id']), true);
			} catch(RecordNotFoundException $e) {
				throw new WrongDataException($data['id'], "wrong id", $e);
			}

			$cart = Cart::get();

			$contact = self::contact($user, $data);
			$indent  = self::indent($contact, $cart);

			Cart::empty();
		} catch(WrongDataException $e) {
			throw new WrongDataException($data, null, $e);
		}
	}

	/**
	 * Выполняет действия связанные с объектом Contact
	 * 
	 * @param User $user пользователь
	 * @param array $data массив переданный из формы
	 * @throws WrongDataException переданы неправильные данные
	 * @return Contact контактные данные пользователя
	 */
	private static function contact(User $user, array $data) : Contact {
		$req = array("name", "phone", "address");
		if($k = array_diff_key(array_flip($req), $data)) {
			throw new WrongDataException($k, " keys not exists");
		}

		try {
			$userID = $user->getID();
		} catch(NullAccessException $e) {
			throw new WrongDataException($user, "id not set", $e);
		}

		$name    = $data['name'];
		$phone   = $data['phone'];
		$address = $data['address'];

		try {
			$contact = Contact::findFirst(array("user_id" => $userID), true);
		} catch(RecordNotFoundException $e) {
			$contact = new Contact();
		} finally {
			$contact = ($user instanceof Anonym) ? (new Contact()) : ($contact); 
		}

		$ioru = !$contact->isSaved(); 

		$contact->setUser($user);
		$contact->setName($name);
		$contact->setPhone($phone);
		$contact->setAddress($address);
		$contact->setStatus(true);

		if($ioru) {
			$contact->insert();
		} else {
			if(!$contact->isSaved()) {
				$contact->update();
			}
		}

		return $contact;
	}

	/**
	 * Создает новый заказ на основе контактных данных и содержимого корзины
	 * 
	 * @param Contact $contact контактные данные пользователя
	 * @param array $cart содержимое корзины
	 * @throws WrongDataException переданы неправильные данные
	 * @return Indent заказ
	 */
	private static function indent(Contact $contact, array $cart) : Indent {
		if(!$cart) {
			throw new WrongDataException($cart, "cart is empty");
		}

		//indent
			$indent = new Indent();

			$indent->setContact($contact);
			$indent->setState(State::default("new"));
			$indent->setStatus(true);

			$indent->insert();
		//indent end

		//indentItem
			$indentItem = IndentItem::withIndent($indent);

			$cargoList = array();
			foreach ($cart as $one) {
				$cargo = new Cargo();

				$cargo->setAvailable($one['available']);
				$cargo->setCount($one['count']);
				$cargo->setStatus(true);

				$cargoList[] = $cargo;
			}

			$indentItem->setCargoList($cargoList);
			$indentItem->update();
		//indentItem end

		return $indent;
	}

}