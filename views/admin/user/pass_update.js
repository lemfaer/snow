jQuery(document).ready(function($) {

	var bool = false;

	$(".ad_update.password").click(function(event) {
		var password = $(this).parents(".form-group").find("#ad-user-password");;
		if(!bool) {
			$(password).val("");
			bool = true;
		}
	});

});