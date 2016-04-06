var crup = {
	name: null,
};

function checkAjax(input) {
	var name = crup.name;
	var link = "/admin/" + name + "/crup/check";

	var key = $(input).attr("id").replace("ad-" + name + '-', '');
	var value = $(input).val();
	data = {};
	data[name] = {};
	data[name][key] = value;

	$.post(link, data, function(data) {
		checkResult(data);
	}, "json");
}

function checkResult(data) {
	var name = crup.name;
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
			$(ico).removeClass("fa-remove");
			$(ico).addClass("fa-check");
		} else {
			$(text).text(data.error[key]);
			$(status).removeClass("has-success");
			$(status).addClass("has-error");
			$(ico).removeClass("fa-check");
			$(ico).addClass("fa-remove");
		}
	});
}

jQuery(document).ready(function($) {

	$("#ad-" + crup.name).on("focusout", 
		".form-group.ajax .form-control:not(.select2):not(.image)", 
		function(event) {
			checkAjax(this);
		}
	);

	$("#ad-" + crup.name).on("select2:select", 
		".form-group.ajax .form-control", 
		function(event) {
			checkAjax(this);
		}
	);


	$("#ad-" + crup.name).submit(function(event) {
		var dom = this;
		event.preventDefault();

		var name = crup.name;
		var link = "/admin/" + name + "/crup/check";

		var data = {};
		data[name] = {};

		$("#ad-status").iCheck("update");
		var status = $("#ad-status").prop("checked");
		$("#ad-status-text").val(status);

		$(".form-group.ajax").each(function(index, elem) {
			var input = $(elem).find(".form-control");
			var key = $(input).attr("id").replace("ad-" + name + '-', '');
			var value = $(input).val();
			data[name][key] = value;
		});
		data[name].status = status; 

		$.post(link, data, function(data) {
			if($(".form-group.has-error").length === 0) {
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

		if($(input).prop("disabled")) {
			$(input).prop("disabled", false);
			$(text).text("Не менять");
			$(ico).removeClass("fa-edit");
			$(ico).addClass("fa-remove");

			$(fgroup).addClass("ajax");
		} else {
			$(input).prop("disabled", true);
			$(text).text("Изменить");
			$(ico).removeClass("fa-remove");
			$(ico).addClass("fa-edit");

			$(fgroup).removeClass("ajax");
			$(fgroup).removeClass("has-error");
			$(fgroup).removeClass("has-success");
		}
	});

	$(".ad-read-link").click(function(event) {
		var name = crup.name;
		var link = "/admin/" + name;

		window.location.href = link;
	});

});