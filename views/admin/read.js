var read = {
	name: null,
};

jQuery(document).ready(function($) {

	$(".ad-add-link").click(function(event) {
		var name = read.name;
		var link = "/admin/" + name + "/create";
		
		window.location.href = link;
	});

	$(".ad-update-link").click(function(event) {
		var id   = $(this).attr("data-id");
		var name = read.name;
		var link = "/admin/" + name + "/update/" + id;

		window.location.href = link;
	});

	$(".ad-update-link").click(function(event) {
		var id   = $(this).attr("data-id");
		var name = read.name;
		
	});

});