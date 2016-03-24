<?php

/**
 * Класс обрабатывает запросы связанные с корзиной на сайте
 * 
 * Класс содержит инфомацию о продуктах в корзине, их количестве
 * Класс содержит методы добавления, удаления, 
 * увеличения и уменьшения на 1 количества товаров, 
 * для обработки пользовательских запросов.
 * 
 * @package models
 * @author  Alan Smithee
 * @static
 */
final class Cart {

//cart
	/**
	 * @var array "корзина" - массив, содержит информацию о продуктах в корзине
	 */
	private static $cart;

	/**
	 * Возвращает один продукт из корзины по идентификатору
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @throws CartNotExistsException продукт не в корзине
	 * @return array
	 */
	public static function getOne(int $id) : array {
		self::check($id);
		$cart = self::getCart();
		foreach ($cart as $key => $value) {
			if($id === $value['available']->getID()) {
				return $value;
			}
		}
	}

	/**
	 * Инициализирует и возвращает корзину
	 * 
	 * Инициализирует и возвращает массив содержащий описание продукта
	 * и количество его экземпляров в корзине
	 * 
	 * @return array корзина
	 */
	public static function getCart() : array {
		if(!isset(self::$cart)) {
			$_SESSION['cart'] = $_SESSION['cart'] ?? array();
			$arr = $_SESSION['cart'];

			foreach ($arr as $id => $count) {
				try {
					$cart[] = array(
						"available" => Available::findFirst(array("id" => $id)),
						"count"     => $count,
					);
				} catch(NullAccessException $e) {
					throw new UncheckedLogicException("not inited object from db", $e);
				} catch(RecordNotFoundException $e) {
					throw new UncheckedLogicException("wrong data in session cart array", $e);
				}
			}

			self::$cart = $cart;
		}

		return self::$cart;
	}
//cart end

//add, delete
	/**
	 * Проверяет наличие продукта в бд, количество доступных экземпляров
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @return void
	 */
	private static function checkAvailable(int $id) {
		try {
			$count = Available::findFirst(array("id" => $id))->getCount();
		} catch(RecordNotFoundException $e) {
			throw new WrongDataException($id, "wrong available id");
		}
		if($count < 1) {
			throw new WrongDataException($count, "available count < 1, available.id = $id");
		}
	}

	/**
	 * Проверяет продукт и корзину
	 * 
	 * Проверяет наличие продукта в бд, количество доступных экземпляров,
	 * наличие в корзине, данные в корзине
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @throws CartNotExistsException продукт не в корзине
	 * @return void
	 */
	private static function check(int $id) {
		self::checkAvailable($id);
		$count = Available::findFirst(array("id" => $id))->getCount();
		if(!isset($_SESSION['cart'][$id])) {
			throw new UncheckedLogicException("product must be in cart",
				new WrongDataException($id, "product not in cart"));
		}
		if($_SESSION['cart'][$id] < 1) {
			throw new UncheckedLogicException("count must be > 1",
				new WrongDataException($_SESSION['cart'][$id], "count < 1"));
		}
		if($_SESSION['cart'][$id] > $count) {
			throw new UncheckedLogicException("count must be <= available", 
				new WrongDataException($_SESSION['cart'][$id], "count > available($count)"));
		}
	}

	/**
	 * Увеличивает количество продукта в корзине на 1
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @throws CartNotExistsException продукт не в корзине
	 * @throws CartNotAvailableException продуктов больше не доступно
	 * @return void
	 */
	public static function inc(int $id) {
		self::check($id);
		$count = Available::findFirst(array("id" => $id))->getCount();
		if($_SESSION['cart'][$id] < $count) {
			$_SESSION['cart'][$id] += 1;
		} else {
			throw new CartNotAvailableException("count must be < available");
		}
	}

	/**
	 * Уменьшает количество продукта в корзине на 1, удаляет если кол-во = 1
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @throws CartNotExistsException продукт не в корзине
	 * @return void
	 */
	public static function dec(int $id) {
		self::check($id);
		if($_SESSION['cart'][$id] > 1) {
			$_SESSION['cart'][$id] -= 1;
		} else {
			self::delete($id);
		}
	}

	/**
	 * Добавляет продукт в корзину или увеличивает кол-во на 1
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @throws CartNotAvailableException продуктов больше не доступно
	 * @return void
	 */
	public static function add(int $id) {
		self::checkAvailable($id);

		if(!isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id] = 1;
		} else {
			try {
				self::inc($id);
			} catch(CartNotExistsException $e) {
				throw new UncheckedLogicException("cart[id] must be inited", $e);
			}
		}
	}

	/**
	 * Удаляет продукт из корзины
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @throws CartNotExistsException продукт не в корзине
	 * @return void
	 */
	public static function delete(int $id) {
		self::check($id);
		unset($_SESSION['cart'][$id]);
	}
//add, delete end

	/**
	 * Приватный конструктор
	 */
	private function __construct() {}

}