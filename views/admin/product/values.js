function updateValue(clone) {
	var name  = crup.name; // object crup from /views/admin/crup.js
	if(!$(clone).find("[id^='ad-" + name + "-char_name_']").data("select2")) {
		return;
	}

	var values = $(clone).find("[id^='ad-" + name + "-char_value_']");
	var id = $(clone).find("[id^='ad-" + name + "-char_name_']").select2("val");

	// function select from select.js
	select(values, "/admin/select/values", 
		{"name_id": id}, "Выберите значение");
}

jQuery(document).ready(function($) {

	var name  = crup.name; // object crup from /views/admin/crup.js

	$(".clones").on("select2:select", "[id^='ad-" + name + "-char_name_']", 
		function(event) {
			updateValue($(this).parents(".clone"));
		}
	);

	$("#ad-" + name + "-category").on("select2:select", function(event) {
		updateValue($(".clone"));
	});

//observer
	// function observer from observer.js
	observer($("#ad-" + name + "-char_value_0")
		.parents(".clone-block").find(".clones")[0],
		updateValue);
//observer end

});