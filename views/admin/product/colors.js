jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	function updateColor(clone) {
		var colors = $(clone).find("[id^='ad-" + name + "-color_']");

		// function select from select.js
		select(colors, "/admin/select/colors", 
			{"color" : null}, "Выберите цвет");
	}

//observer
	// function observer from observer.js
	observer($("#ad-" + name + "-color_0")
		.parents(".clone-block").find(".clones")[0],
		updateColor);
//observer end

	updateColor($("[id^='ad-" + name + "-color_']").parents(".clone"));

});