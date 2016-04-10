jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	function updateSize(clone) {
		var sizes = $(clone).find("[id^='ad-" + name + "-size_']");
		var id = $("#ad-" + name + "-category").select2("val");

		// function select from select.js
		select(sizes, "/admin/select/sizes", 
			{"category_id" : id}, "Выберите размер");
	}

	$("#ad-" + name + "-category").on("select2:select", function(event) {
		updateSize($(".clone"));
	});

//observer
	// function observer from observer.js
	observer($("#ad-" + name + "-size_0")
		.parents(".clone-block").find(".clones")[0],
		updateSize);
//observer end

});