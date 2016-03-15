jQuery(document).ready(function($) {

	function checkResult(data) {
		$.each(data.single, function(key, value) {
			var input  = $(".check[name=" + key + "]");
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

	$(".check").on("focusout", function(event) {
		event.preventDefault();
		regData = {
			"key"   : $(this).attr("name"),
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
		$(".check").each(function(index, elem) {
			regData[index] = {};
			regData[index].key   = $(elem).attr("name");
			regData[index].value = $(elem).val();
		});
		var pd;
		$.post("/register/check", {regData : regData}, function(data) {
			if(data.check) {
				dom.submit();
			}
			checkResult(data);
		}, "json");
	});

});