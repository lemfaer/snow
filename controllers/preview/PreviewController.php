<?php

final class PreviewController {

//shop
	public function actionShopCategory() {
		$id = 1;

		try {
			$category = Category::findFirst(array("id" => $id));
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("category not found", $e);
		}

		try {
			$categoryList = Category::findAll(array("parent_id" => $id), "sort_order ASC");
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("categories not found", $e);
		}

		try {
			View::template("/shop/category/index.php", compact("category", "categoryList"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("category view not found", $e);
		}
	}

	public function actionShopCatalog() {
		$id = 2;
		$page = 1;

		try {
			$category = Category::findFirst(array("id" => $id));
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("category not found", $e);
		}
		
		$order  = "id DESC";
		$limit  = 12;
		$offset = ($page - 1) * $limit;
		$total  = Product::findCount(array("category_id" => $id));

		try {
			$productList = Product::findAll(array("category_id" => $id), $order,
				$limit, $offset);
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("products not found", $e);
		}

		$pagination = new Pagination($total, $page, $limit, "page-");

		try {
			View::template("/shop/catalog/index.php", 
				compact("category", "productList", "pagination"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("catalog view not found", $e);
		}
	}

	public function actionShopProduct() {
		$id = 10;

		try {
			$productItem = ProductItem::findFirst(array("id" => $id));
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("product not found", $e);
		}

		try {
			$recomendedList = Product::findAll(array("is_recomended" => '1'), 
				"rand()", 4);
		} catch(RecordNotFoundException $e) {
			$recomendedList = array();
		}

		try {
			View::template("/shop/product/index.php", compact("productItem", "recomendedList"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("product view not found", $e);
		}
	}
//shop end

//user
	public function actionUserRegister() {
		try {
			View::template("/user/register/index.php");
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("register form view not found", $e);
		}
	}

	public function actionUserLogin() {
		try {
			View::template("/user/login/index.php");
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("login form view not found", $e);
		}
	}

	public function actionUserOrders() {
		$id = 2;

		$user = User::findFirst(array("id" => $id));
		$indentList = $user->getIndentList();

		try {
			View::template("/user/order/index.php", compact("indentList"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("myorders view not found", $e);
		}
	}
//user end

//indent
	public function actionIndentCart() {
		$product1 = Available::findFirst(array("id" => 150));
		$count1 = 1;

		$product2 = Available::findFirst(array("id" => 268));
		$count2 = 3;

		$cart = array(
			array(
				"available" => $product1,
				"count" => $count1
			),
			array(
				"available" => $product2,
				"count" => $count2
			)
		);

		try {
			View::template("/cart/full/index.php", compact("cart"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("full cart view not found", $e);
		}
	}

	public function actionIndentOrder() {
		$id = 11;

		$contact = Contact::findFirst(array("id" => $id));

		try {
			View::template("/user/contact/index.php", compact("contact"));
		} catch(FileNotFoundException $e) {
			throw new UncheckedLogicException("contact form view not found", $e);
		}
	}
//indent end

//admin
	public function actionAdminRead() {
		$name   = "category";
		$client = User::findFirst(array("id" => 2));

		try {
			$class = "Category";
		} catch(WrongDataException $e) {
			throw new PageNotFoundException("table not found", $e);
		}

		$nameList = $name."List";
		try {
			${$nameList} = $class::findAll(array(), "id ASC", 500, 0, true);
		} catch(RecordNotFoundException $e) {
			${$nameList} = array();
		}

		$contentPath = "/admin/$name/read.php";
		View::empty("/admin/template/index.php", compact($nameList, "client", "contentPath"));
	}

	public function actionAdminCreate() {
		$name   = "user";
		$client = User::findFirst(array("id" => 2));

		$contentPath = "/admin/$name/create.php";
		View::empty("/admin/template/index.php", compact("client", "contentPath"));
	}

	public function actionAdminUpdate() {
		$name   = "product";
		$client = User::findFirst(array("id" => 2));
		$id     = 10;

		try {
			$class = "ProductItem";
		} catch(WrongDataException $e) {
			throw new PageNotFoundException("table not found", $e);
		}

		try {
			${$name} = $class::findFirst(array("id" => $id), true);
		} catch(RecordNotFoundException $e) {
			throw new PageNotFoundException("record not found", $e);
		}

		$contentPath = "/admin/$name/update.php";
		View::empty("/admin/template/index.php", compact($name, "client", "contentPath"));
	}
//admin end

} 