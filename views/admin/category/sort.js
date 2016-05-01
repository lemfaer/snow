function updateSort(sort, parent) {
	if(!$(parent).data("select2")) {
		return;
	}

	var id = $(parent).select2("val");

	// function select from select.js
	select(sort, "/admin/select/sort", 
		{"parent_id" : id}, "Выбирите порядок", "sort");
}

jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	var parent = $("#ad-" + name + "-parent");
	var sort   = $("#ad-" + name + "-sort_order");

	$(sort).select2({"placeholder": "Выбирите порядок"});

	$(parent).on("select2:select", function(event) {
		updateSort(sort, parent);
	});

});