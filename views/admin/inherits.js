function updateParent(parent) {
	// function select from select.js
	select(parent, "/admin/select/inherits",
		{"parent_id" : 0}, "Выберите категорию", "parent");
}

function updateCategory(category, parent) {
	if(!$(parent).data("select2")) {
		return;
	}

	var id = $(parent).select2("val");

	// function select from select.js
	select(category, "/admin/select/inherits", 
		{"parent_id" : id}, "Выберите подкатегорию", "category");
}

jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	var parent   = $("#ad-" + name + "-parent");
	var category = $("#ad-" + name + "-category");

	$(category).select2({"placeholder": "Выберите подкатегорию"});

	updateParent(parent);

	$(parent).on("select2:select", function(event) {
		updateCategory(category, parent);
	});

});