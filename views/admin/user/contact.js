jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	$(".add-clone.contact").click(function(event) {
		$(this).hide("slow");
	});

	$("#ad-" + name).on("click", ".remove-clone.contact", function(event) {
		$(".add-clone").show("slow");
	});

});