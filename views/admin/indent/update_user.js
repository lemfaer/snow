jQuery(document).ready(function($) {
	$(".update-user").click(function(event) {
		var id   = $(this).attr("user-id"); 
		var link = "/admin/user/update/" + id;

		window.location.href = link;
	});
});