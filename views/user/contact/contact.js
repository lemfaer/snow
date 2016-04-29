jQuery(document).ready(function($) {

	function checkResult(data) {
		$.each(data.single, function(key, value) {
			var input  = $("#contact-check-" + key);
			var text   = $(input).siblings(".reg-text");
			var status = $(input).siblings(".reg-status");

			if(value) {
				$(text).removeClass("error");
				$(status).removeClass("error");
				$(status).addClass("ok");
			} else {
				$(text).addClass("error");
				$(text).text(data.error[key]);
				$(status).addClass("error");
				$(status).removeClass("ok");
			}
		});
	}

	$(".check.ajax").on("focusout", function(event) {
		event.preventDefault();
		
		var key = $(this).attr("id").replace("contact-check-", '');
		var value = $(this).val();
		contactData = {};
		contactData[key] = value;

		$.post("/order/check", {contactData : contactData}, function(data) {
			checkResult(data);
		}, "json");
	});

	$("#form").submit(function(event) {
		var dom = this;
		event.preventDefault();

		var contactData = {};
		$(".check.ajax").each(function(index, elem) {
			var key = $(elem).attr("id").replace("contact-check-", '');
			var value = $(elem).val();
			contactData[key] = value;
		});

		$.post("/order/check", {contactData : contactData}, function(data) {
			if(data.success) {
				dom.submit();
			}
			checkResult(data);
		}, "json");
	});

});