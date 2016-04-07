jQuery(document).ready(function($) {

	var init   = true;
	var parent = $("#ad-category-parent");
	var sort   = $("#ad-category-sort_order");

	$(sort).select2({"placeholder": "Выбирите порядок"});

	$(parent).on("select2:select", function(event) {
		if($(sort).length === 0) {
			return;
		}

		var id = $(this).select2("val");

		$(sort).html('');
		$(sort).parents(".form-group").removeClass("has-error");
		$(sort).parents(".form-group").removeClass("has-success");

		var first = {
			id: 0, 
			text: "В начало",
		};

		$.post("/admin/select/inherits", {"parent_id": id}, function(data) {
			if(data) {
				data.unshift(first);
				$(sort).select2({
					placeholder: "Выбирите порядок",
					data: data,
				}).select2("val", "");

				if($(sort).hasClass("update")) {
					var id = $(sort).attr("data-id");
					if(init) {
						$(sort).select2("val", id);
						init = false;
					} else {
						$(sort).select2("val", 0);
					}
				}
			} else {
				$(sort).select2({
					placeholder: "Выбирите порядок",
					data: [first],
				}).select2("val", "");
				if($(sort).hasClass("update")) {
					$(sort).select2("val", 0);
				}
			}
		}, "json");
	});

});