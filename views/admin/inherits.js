jQuery(document).ready(function($) {

	var name     = crup.name; // object crup from /views/admin/crup.js
	var parent   = $("#ad-" + name + "-parent");
	var category = $("#ad-" + name + "-category");

	$(parent).select2({"placeholder": "Выбирите категорию"});
	$(category).select2({"placeholder": "Выбирите подкатегорию"});

	$.post("/admin/select/inherits", {"parent_id": 0}, function(data) {
		$(parent).select2({
			placeholder: "Выбирите категорию",
			data: data,
		});
		if($(parent).hasClass("update")) {
			var id = $(parent).attr("data-id");
			$(parent).select2("val", id);
			$(parent).trigger("select2:select");
		}
	}, "json");
	
	$(parent).on("select2:select", function(event) {
		if($(category).length === 0) {
			return;
		}

		var id = $(this).select2("val");

		$(category).html('');
		$(category).parents(".form-group").removeClass("has-error");
		$(category).parents(".form-group").removeClass("has-success");

		$.post("/admin/select/inherits", {"parent_id": id}, function(data) {
			if(data) {
				$(category).select2({
					placeholder: "Выбирите подкатегорию",
					data: data,
				}).select2("val", "");;

				if($(category).hasClass("update")) {
					var id = $(category).attr("data-id");
					$(category).select2("val", id);
				}
			} else {
				$(category).select2("val", "");
			}
		}, "json");
	});

});