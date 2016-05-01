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
 * @final
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
		$cart = self::get();
		foreach ($cart as $key => $value) {
			if($id === $value['available']->getID()) {
				return $value;
			}
		}
	}

	/**
	 * Возвращает количество экземпляров продукта в корзине по идентификатору
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @return int количество экземпляров продукта
	 */
	public static function getCount(int $id) : int {
		try {
			$one = self::getOne($id);
			return $one['count'];
		} catch(CartNotExistsException $e) {
			return 0;
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
	public static function get() : array {
		if(!isset(self::$cart)) {
			$_SESSION['cart'] = $_SESSION['cart'] ?? array();
			$arr = $_SESSION['cart'];

			$cart = array();
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

//calculation
	/**
	 * Разчитывает промежуточную цену продукта
	 * 
	 * @param int $id идентификатор available
	 * @throws WrongDataException передан неправильный продукт
	 * @return int промежуточная цена
	 */
	public static function subTotal($id) : int {
		try {
			$one   = self::getOne($id);
		} catch(CartNotExistsException $e) {
			return 0;
		}
		$count = $one['count'];
		$price = $one['available']->getProduct()->getPrice();
		$subTotal = $count * $price;

		return $subTotal;
	}

	/**
	 * Разчитывает цену товаров в корзине
	 * 
	 * @return int цена товаров в корзине
	 */
	public static function total() : int {
		$cart = self::get();
		$total = 0;
		foreach ($cart as $one) {
			$count = $one['count'];
			$price = $one['available']->getProduct()->getPrice();
			$total += $count * $price;
		}

		return $total;
	}
//calculation end

//check
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
			throw new CartNotExistsException("product must be in cart",
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
//check end

//add, delete
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
		try {
			self::inc($id);
		} catch(CartNotExistsException $e) {
			$_SESSION['cart'][$id] = 1;
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

//empty
	/**
	 * Удаляет все продукты из корзины
	 * 
	 * @return void
	 */
	public static function empty() {
		$cart = self::get();

		try {
			foreach ($cart as $one) {
				self::delete($one['available']->getID());
			}
		} catch(NullAccessException $e) {
			throw new UncheckedLogicException("object without id in cart", $e);
		} catch(WrongDataException $e) {
			throw new UncheckedLogicException("wrong id in cart", $e);
		} catch(CartNotExistsException $e) {
			throw new UncheckedLogicException("id from cart not in cart", $e);
		}
	}
//empty end

	/**
	 * Приватный конструктор
	 */
	private function __construct() {}

}