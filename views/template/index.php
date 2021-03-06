<!DOCTYPE HTML>
<html>

<!-- REQUIRED -->
	<!-- $contentPath -->
	<!-- $compact -->
<!-- REQUIRED END -->

<head>

<!-- meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- meta end -->

<!-- css links -->
	<link rel="stylesheet" type="text/css" href="/template/css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="/template/css/fwslider.css" />
	<link rel="stylesheet" type="text/css" href="/template/css/magnific-popur.css" />
	<link rel="stylesheet" type="text/css" href="/template/css/flexslider.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/template/css/jquery.fancybox.css" media="screen" />
	<link rel="stylesheet" type="text/css" 
		href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' />
	<link rel="stylesheet" type="text/css" href="/template/css/row-eq-size.css" />
	<link rel="stylesheet" type="text/css" href="/template/css/style.css" />
<!-- css links end -->

<!-- js links -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/template/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/template/js/jquery.md5.js"></script>
	<script type="text/javascript" src="/template/js/jquery.fancybox.js"></script>
	<script type="text/javascript" src="/template/js/jquery.flexisel.js"></script>
	<script type="text/javascript" src="/template/js/jquery.magnific-popur.js"></script>
	<script type="text/javascript" src="/template/js/responsive-nav.js"></script>
	<script type="text/javascript" src="/template/js/classie.js"></script>
	<script type="text/javascript" src="/template/js/uisearch.js"></script>
	<script type="text/javascript" src="/template/js/fwslider.js"></script>
	<script type="text/javascript" src="/template/js/imagezoom.js"></script>
	<script type="text/javascript" src="/template/js/jquery.flexslider.js" defer></script>
	<script type="text/javascript" src="/views/cart/mini/mini.js"></script>
<!-- js links end -->

<!-- js script -->
	<script type="application/x-javascript"> 
		addEventListener("load", function() { 
			setTimeout(hideURLbar, 0); 
		}, false); 
		function hideURLbar() { 
			window.scrollTo(0,1); 
		} 
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".dropdown img.flag").addClass("flagvisibility");

			$(".dropdown dt a").click(function() {
				$(".dropdown dd ul").toggle();
			});

			$(".dropdown dd ul li a").click(function() {
				var text = $(this).html();
				$(".dropdown dt a span").html(text);
				$(".dropdown dd ul").hide();
				$("#result").html("Selected value is: " + getSelectedValue("sample"));
			});

			function getSelectedValue(id) {
				return $("#" + id).find("dt a span.value").html();
			}

			$(document).bind('click', function(e) {
				var $clicked = $(e.target);
				if (! $clicked.parents().hasClass("dropdown")) {
					$(".dropdown dd ul").hide();
				}
			});

			$("#flagSwitcher").click(function() {
				$(".dropdown img.flag").toggleClass("flagvisibility");
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
		});
	</script>
	<script type="text/javascript">
		$(window).load(function() {
			$('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails"
			});
		});
	</script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			mini.update();
		});						
	</script>
<!-- js script end -->

</head>

<body>

<div class="header">
	<div class="container">
		<div class="row">
			<div class="header-left">
				<div class="logo">
					<a href="/"><img src="/template/images/logo.png" alt=""/></a>
				</div>
				<div class="menu">
					<a class="toggleMenu" href="#">
						<img src="/template/images/nav.png" alt="" />
					</a>
					<ul class="nav" id="nav">
						<li><a href="/category">Магазин</a></li>
						<div class="clear"></div>
					</ul>
						
				</div>							
				<div class="clear"></div>
			</div>
			<div class="header_right">
				<ul class="icon1 sub-icon1 profile_img">
					<li>
						<a class="cart-icon" href="/cart"> </a>
						<ul class="sub-icon1 list">
								
							<div id="mini-cart"></div>
								
							<div class="clear"></div>
							<div class="login_buttons">
								<div class="check_button">
									<a href="/cart">Корзина</a>
								</div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
						</ul>
					</li>
				</ul>

				<?php if ($client): ?>
					<ul class="icon1 sub-icon1 profile_img">
						<li>
							<a class="user-icon" href="/user/orders"> </a>
							<ul class="sub-icon1 list">
								<div class="clear"></div>
								<div class="login_buttons">
									<a href="/user/orders">Мои заказы</a>
									<hr style="margin: 0.5em 0">
									<a href="/user/logout">
										Выход</a>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</ul>
						</li>
					</ul>
				<?php else: ?>
					<ul class="icon1 sub-icon1 profile_img">
						<li>
							<a class="login-icon" href="/login"> </a>
							<ul class="sub-icon1 list">
								<div class="clear"></div>
								<div class="login_buttons">
									<div class="check_button login">
										<a href="/login">Вход</a>
									</div>
									<div class="check_button register">
										<a href="/register">Регистрация</a>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</ul>
						</li>
					</ul>
				<?php endif ?>

				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

<!-- MAIN -->
	<?php View::empty($contentPath, $compact); ?>
<!-- MAIN END -->

<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<ul class="footer_box">
					<h4>Админ панель</h4>
					<li><a href="/preview/read">Просмотр</a></li>
					<li><a href="/preview/create">Добавление</a></li>
					<li><a href="/preview/update">Редактирование</a></li>
				</ul>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<ul class="footer_box">
					<h4>Заказы</h4>
					<li><a href="/preview/cart">Корзина</a></li>
					<li><a href="/preview/order">Оформление заказа</a></li>
				</ul>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<ul class="footer_box">
					<h4>Пользователь</h4>
					<li><a href="/preview/register">Регистрация</a></li>
					<li><a href="/preview/login">Вход</a></li>
					<li><a href="/preview/orders">Мои заказы</a></li>
				</ul>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<ul class="footer_box">
					<h4>Магазин</h4>
					<li><a href="/preview/category">Категории</a></li>
					<li><a href="/preview/catalog">Каталог</a></li>
					<li><a href="/preview/product">Продукт</a></li>
				</ul>
			</div>
		</div>
		<div class="row footer_bottom">
			<div class="copy">
				<p>© 2014 Template by <a href="http://w3layouts.com" target="_blank">w3layouts</a></p>
			</div>
		</div>
	</div>
</div>

</body>

</html>