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
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$.post("/cart/mini", {"mini": null}, function(data) {
				$("#mini-cart").html(data);
			});	
		});						
	</script>
<!-- js script end -->

</head>