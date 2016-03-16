jQuery(document).ready(function($) {

	function checkResult(data) {
		$.each(data.single, function(key, value) {
			var input  = $("#reg-check-" + key);
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
		regData = {
			"key"   : $(this).attr("id").replace("reg-check-", ''),
			"value" : $(this).val(),
		}
		$.post("/register/check", {regData : regData}, function(data) {
			checkResult(data);
		}, "json");
	});

	$("#form").submit(function(event) {
		var dom = this;
		event.preventDefault();

		var regData = {};
		$(".check.ajax").each(function(index, elem) {
			regData[index] = {};
			regData[index].key   = $(elem).attr("id").replace("reg-check-", '');
			regData[index].value = $(elem).val();
		});

		regData.captcha = grecaptcha.getResponse();

		$.post("/register/check", {regData : regData}, function(data) {
			if(data.success) {
				dom.submit();
			} else {
				grecaptcha.reset();
			}
			checkResult(data);
		}, "json");
	});

	$("#cpass").on("focusout", function(event) {
		event.preventDefault();
		var pass = $("input[type='password']").not(this).val();
		var cpass = $(this).val();
		var status = $(this).siblings(".reg-status");

		$(pass).focusout();

		if(pass === cpass) {
			$(status).removeClass("error");
			$(status).addClass("ok");
		} else {
			$(status).removeClass("ok");
			$(status).addClass("error");
		}

		if(!pass.length && !cpass.length) {
			$(status).removeClass("ok");
			$(status).removeClass("error");
		}
	});

});