var select_top = {};

function select(item, link, data, plh, first) {
	if(item.length === 0 || !$(item).data('select2')) {
		return;
	}

	$(item).html("<option></option>");
	$(item).select2({placeholder: plh});

	$(item).parents(".form-group").removeClass("has-error");
	$(item).parents(".form-group").removeClass("has-success");

	$.post(link, data, function(data) {
		if(!data) {
			$(item).select2("val", "");
			return;
		}

		if(select_top[first]) {
			data.unshift(select_top[first]);
		}

		$(item).select2({
			placeholder: plh,
			data: data,
		});

		$(item).select2("val", "");

		$(item).each(function(index, el) {
			if($(el).hasClass("update")) {
				var id = $(el).attr("data-id");
				$(el).select2("val", id);
				$(el).trigger("select2:select");
			}
		});
	}, "json");
}