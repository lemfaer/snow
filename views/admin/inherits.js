jQuery(document).ready(function($) {

	$("#ad-size-parent").select2({"placeholder": "Выбирите категорию"});
	$("#ad-size-category").select2({"placeholder": "Выбирите подкатегорию"});

	$.post("/admin/select/inherits", {"parent_id": 0}, function(data) {
		var parent = $("#ad-size-parent");
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
	
	$("#ad-size-parent").on("select2:select", function(event) {
		var id = $(this).select2("val");

		$.post("/admin/select/inherits", {"parent_id": id}, function(data) {
			$("#ad-size-category").html('');
			if(data) {
				var category = $("#ad-size-category");
				$(category).select2({
					placeholder: "Выбирите подкатегорию",
					data: data,
				});
				$("#ad-size-category").select2("val", "");
				if($(category).hasClass("update")) {
					var id = $(category).attr("data-id");
					$(category).select2("val", id);
				}
			}
			$("#ad-size-category").parents(".form-group").removeClass("has-error");
			$("#ad-size-category").parents(".form-group").removeClass("has-success");
		}, "json");
	});

});