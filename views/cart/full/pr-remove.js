jQuery(document).ready(function($) {

	$(".pr-remove").click(function(event) {
		event.preventDefault();

		var remove = $(this).parent(".cart-item");
		var id = $(this).siblings(".id").text();

		$.post("/cart/delete", {"id": id}, function(data) {
			$(remove).fadeOut("slow", function() {
				$(this).remove();
			});
			mini.update(); // from mini.js
			price.calculate(); // from price.js
		});

	});

});