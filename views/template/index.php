<!DOCTYPE HTML>
<html>
<head>
<title>Free Snow Bootstrap Website Template | Checkout :: w3layouts</title>

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
	<link rel="stylesheet" type="text/css" href="/template/css/style.css" />
<!-- css links end -->

<!-- js links -->
	<script type="text/javascript" src="/template/js/jquery.min.js"></script>
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
<!-- js script end -->

</head>

<body>

<!-- header -->
<div class="header">
	<div class="container">
		<div class="row">
			<!-- <div class="col-md-12"> -->
				<div class="header-left">
					<div class="logo">
						<a href="index.html"><img src="/template/images/logo.png" alt=""/></a>
					</div>
					<div class="menu">
						<a class="toggleMenu" href="#">
							<img src="/template/images/nav.png" alt="" />
						</a>
						<ul class="nav" id="nav">
							<li><a href="/category">Shop</a></li>
							<li><a href="team.html">Team</a></li>
							<li><a href="shop.html">Events</a></li>
							<li><a href="experiance.html">Experiance</a></li>
							<li><a href="shop.html">Company</a></li>
							<li><a href="contact.html">Contact</a></li>
							<div class="clear"></div>
						</ul>
						
					</div>							
					<div class="clear"></div>
				</div>
				<div class="header_right">
					<ul class="icon1 sub-icon1 profile_img">
						<li>
							<a class="active-icon c1" href="#"> </a>
							<ul class="sub-icon1 list">
								
								<?php foreach ($cart as $one): ?>
									<?php $product = $one['available']->getProduct(); ?>
									<?php $count   = $one['count']; ?>

									<?php $price = '$'.$product->getPrice(); ?>
									<?php $image = $product->getImage()->link(); ?>
									<?php $link  = "/product/".$product->getID(); ?>
									<?php $name  = $product->getProducer()->getName()
										." ".$product->getName()
										." ".$product->getYear(); ?>

									<li>
										<div class="list_img">
											<img src=<?= $image; ?> alt=""/>
										</div>
										<div class="list_desc">
											<h4><a href="<?= $link; ?>"><?= $name; ?></a></h4>
											<div>
												<font class="mc-price"><?= $price; ?></font>
												<?php if ($count > 1): ?>
													<font class="mc-price">x</font>
													<font class="mc-price"><?= $count; ?></font>
												<?php endif; ?>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
								
								<div class="clear"></div>
								<div class="login_buttons">
									<div class="check_button">
										<a href="checkout.html">Check out</a>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</ul>
						</li>
					</ul>
					<ul class="icon1 sub-icon1 profile_img">
						<li>
							<a class="active-icon c1" href="#"> </a>
							<ul class="sub-icon1 list">
								<div class="clear"></div>
								<div class="login_buttons">
									<div class="check_button">
										<a href="checkout.html">Check out</a>
									</div>
									<div class="clear"></div>
								</div>
								<div class="clear"></div>
							</ul>
						</li>
					</ul>


					<!-- NO SEARCH
					<div class="search-box">
						<div id="sb-search" class="sb-search">
							<form>
								<input class="sb-search-input" placeholder="Enter your search term..."
									type="search" name="search" id="search">
								<input class="sb-search-submit" type="submit" value="">
								<span class="sb-icon-search"> </span>
							</form>
						</div>
					</div>
					<script>
						new UISearch( document.getElementById( 'sb-search' ) );
					</script>
					-->


					<div class="clear"></div>
				</div>
			<!-- </div> -->
		</div>
	</div>
</div>
<!-- header end -->

<!-- main -->
	<?php 
		require_once($contentView);
	?>
<!-- main end -->

<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="footer_box">
					<h4>Products</h4>
					<li><a href="#">Mens</a></li>
					<li><a href="#">Womens</a></li>
					<li><a href="#">Youth</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="footer_box">
					<h4>About</h4>
					<li><a href="#">Careers and internships</a></li>
					<li><a href="#">Sponserships</a></li>
					<li><a href="#">team</a></li>
					<li><a href="#">Catalog Request/Download</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="footer_box">
					<h4>Customer Support</h4>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Shipping and Order Tracking</a></li>
					<li><a href="#">Easy Returns</a></li>
					<li><a href="#">Warranty</a></li>
					<li><a href="#">Replacement Binding Parts</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="footer_box">
					<h4>Newsletter</h4>
					<div class="footer_search">
						<form>
							<input type="text" value="Enter your email" onfocus="this.value = '';" 
								onblur="if (this.value == '') {this.value = 'Enter your email';}">
							<input type="submit" value="Go">
						</form>
					</div>
					<ul class="social">	
						<li class="facebook"><a href="#"><span> </span></a></li>
						<li class="twitter"><a href="#"><span> </span></a></li>
						<li class="instagram"><a href="#"><span> </span></a></li>	
						<li class="pinterest"><a href="#"><span> </span></a></li>	
						<li class="youtube"><a href="#"><span> </span></a></li>
					</ul>
				</ul>
			</div>
		</div>
		<div class="row footer_bottom">
			<div class="copy">
				<p>© 2014 Template by <a href="http://w3layouts.com" target="_blank">w3layouts</a></p>
			</div>
			<dl id="sample" class="dropdown">
				<dt><a href="#"><span>Change Region</span></a></dt>
				<dd>
					<ul>
						<li><a href="#">
							Australia<img class="flag" src="images/as.png" alt="" />
							<span class="value">AS</span>
						</a></li>
						<li><a href="#">
							Sri Lanka<img class="flag" src="images/srl.png" alt="" />
							<span class="value">SL</span>
						</a></li>
						<li><a href="#">
							Newziland<img class="flag" src="images/nz.png" alt="" />
							<span class="value">NZ</span>
						</a></li>
						<li><a href="#">
							Pakistan<img class="flag" src="images/pk.png" alt="" />
							<span class="value">Pk</span>
						</a></li>
						<li><a href="#">
							United Kingdom<img class="flag" src="images/uk.png" alt="" />
							<span class="value">UK</span>
						</a></li>
						<li><a href="#">
							United States<img class="flag" src="images/us.png" alt="" />
							<span class="value">US</span>
						</a></li>
					</ul>
				</dd>
			</dl>
		</div>
	</div>
</div>
<!-- footer end -->

</body>	

</html>