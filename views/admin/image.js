jQuery(document).ready(function($) {
	
	$(".ad_update").click(function(event) {
		var fgroup = $(this).parents(".form-group");
		var input  = $(fgroup).find(".form-control.image");
		if(input.length === 0) {
			return;
		}
		var image = $(fgroup).find(".image-view");

		if($(input).prop("disabled")) {
			$(input).show();
			$(image).hide();
		} else {
			$(input).hide();
			$(image).show();
		}
	});

});