jQuery(document).ready(function($) {

	$("#ad-size-category").select2({"placeholder": "Выбирите категорию"});
	$("#ad-size-subcategory").select2({"placeholder": "Выбирите подкатегорию"});

	$.post("/admin/select/inherits", {"parent_id": 0}, function(data) {
		$("#ad-size-category").select2({
			placeholder: "Выбирите категорию",
			data: data,
		});
	}, "json");
	
	$("#ad-size-category").on("select2:select", function(event) {
		var id = $(this).select2("val");
		$.post("/admin/select/inherits", {"parent_id": id}, function(data) {
			$("#ad-size-subcategory").html('');
			if(data) {
				$("#ad-size-subcategory").select2({
					placeholder: "Выбирите подкатегорию",
					data: data,
				});
			}
			$("#ad-size-subcategory").select2("val", "");
		}, "json");
	});

});