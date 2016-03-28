var mini = {

	update : function() {
		$.post("/cart/mini", {"mini": null}, function(data) {
			$("#mini-cart").html(data);
		});
	}

};