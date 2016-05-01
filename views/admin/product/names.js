function updateName(clone) {
	var name = crup.name; // object crup from /views/admin/crup.js
	var names = $(clone).find("[id^='ad-" + name + "-char_name_']");
	var id    = $("#ad-" + name + "-category").select2("val");

	// function select from select.js
	select(names, "/admin/select/names", 
		{"category_id" : id}, "Выберите характеристику", "char_name");
}

jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	$("#ad-" + name + "-category").on("select2:select", function(event) {
		updateName($(".clone"));
	});

//observer
	// function observer from observer.js
	observer($("#ad-" + name + "-char_name_0")
		.parents(".clone-block").find(".clones")[0],
		updateName);
//observer end

});