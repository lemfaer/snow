var adminForm = {
	"name" : null,
};

jQuery(document).ready(function($) {

	function checkResult(data) {
		var name = adminForm.name;
		$.each(data.single, function(key, value) {
			var input  = $("#ad-" + name + '-' + key);
			var fgroup = $(input).parents(".form-group");

			var text   = $(fgroup).find("font.message");
			var ico    = $(fgroup).find("i.ico");
			var status = fgroup;

			if(value) {
				$(text).text("Успех!");
				$(status).removeClass("has-error");
				$(status).addClass("has-success");
				$(ico).removeClass("fa-error");
				$(ico).addClass("fa-success");
			} else {
				$(text).text(data.error[key]);
				$(status).removeClass("has-success");
				$(status).addClass("has-error");
				$(ico).removeClass("fa-success");
				$(ico).addClass("fa-error");
			}
		});
	}

	$(".form-group").on("focusout", function(event) {
		if(!$(this).hasClass("ajax")) {
			return;
		}
		
		event.preventDefault();
		var input = $(this).find(".form-control");
		
		var name = adminForm.name;
		var link = "/admin/" + name + "/crup/check";

		var key = $(input).attr("id").replace("ad-" + name + '-', '');
		var value = $(input).val();
		data = {};
		data[name] = {};
		data[name][key] = value;

		$.post(link, data, function(data) {
			checkResult(data);
		}, "json");
	});

	$("#ad-" + adminForm.name).submit(function(event) {
		var dom = this;
		event.preventDefault();

		var name = adminForm.name;
		var link = "/admin/" + name + "/crup/check";

		var data = {};
		data[name] = {};
		$(".form-group.ajax").each(function(index, elem) {
			var input = $(elem).find(".form-control");
			var key = $(input).attr("id").replace("ad-" + name + '-', '');
			var value = $(input).val();
			data[name][key] = value;
		});

		$.post(link, data, function(data) {
			if(data.success) {
				dom.submit();
			}
			checkResult(data);
		}, "json");
	});

	$(".ad_update").click(function(event) {
		var fgroup = $(this).parents(".form-group");
		var input  = $(fgroup).find(".form-control");
		var text   = $(this).find("font.up_message");
		var ico    = $(this).find("i.up_ico");

		console.log("enab" + $(input).prop("enabled"));
		console.log("disab" + $(input).prop("disabled"));

		console.log("atr" + $(input).attr("disabled"));

		if($(input).prop("disabled")) {
			$(input).prop("disabled", false);
			$(text).text("Не менять");
			$(ico).removeClass("fa-edit");
			$(ico).addClass("fa-error");

			$(fgroup).addClass("ajax");
		} else {
			$(input).prop("disabled", true);
			$(text).text("Изменить");
			$(ico).removeClass("fa-error");
			$(ico).addClass("fa-edit");

			$(fgroup).removeClass("ajax");
			$(fgroup).removeClass("has-error");
			$(fgroup).removeClass("has-success");
		}
	});

});