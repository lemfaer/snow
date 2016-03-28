var price = {

	calculate : function() {
		$(".id").each(function(index, el) {
			var subtotal = $(el).siblings(".pr-info").find("#subtotal");
			var id = $(el).text();
			$.post("/cart/subtotal", {"id": id}, function(data) {
				$(subtotal).text(data);
			});
		});

		$.post("/cart/total/", {"total": null}, function(data) {
			$("#total").text(data);
		});
	}

};