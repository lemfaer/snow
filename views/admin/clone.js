jQuery(document).ready(function($) {

	$(".add-clone").click(function(event) {
		event.preventDefault();
		var parent = $(this).parents(".clone-block");
		var label  = $(parent).find(".field-header label");
		var sample = $(parent).find(".sample");
		
		var clone     = $(sample).clone();
		var clonePath = $(parent).find(".clones");
		var num       = $(sample).attr("next");

		$(label).fadeIn('slow');

		$(clone).attr("this", $(clone).attr("next"));
		$(clone).removeAttr("next");

		$(clone).removeClass("sample");
		$(clone).addClass("clone");

		$(clone).find(".form-group").each(function(index, el) {
			$(el).addClass("ajax");
			var input = $(el).find(".form-control");
			var label = $(el).find(".control-label");

			$(input).prop("disabled", false);
			if($(input).hasClass("select2-lazy")) {
				$(input).removeClass("select2-lazy");
				$(input).select2();
			}
			$(input).attr("id",   $(input).attr("id").replace("0", num));
			$(input).attr("name", $(input).attr("name").replace("0", num));
			$(label).attr("for",  $(label).attr("for").replace("0", num));
		});

		$(clone).hide().fadeIn('slow');
		$(clonePath).append(clone);

		num = parseInt(num) + 1;
		$(sample).attr("next", num);
	});

	$(".clone-block").on("click", ".remove-clone", function(event) {
		event.preventDefault();
		var clblock   = $(this).parents(".clone-block");
		var remove    = $(this).parents(".clone");
		var sampleLab = $(clblock).find(".sample").find(".field-header label");
		var label     = $(clblock).find(".field-header label").not(sampleLab);
		
		if($(clblock).find(".clone").length === 1) {
			$(label).fadeOut("slow");
		}
		$(remove).fadeOut("slow", function() {
			$(remove).remove();
		});
	});

});
