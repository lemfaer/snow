jQuery(document).ready(function($) {
	
	//vars
		var thisGroup;
		var thatGroup;
	//vars end

	//define
		function define(label) {
			var name;
			name = $(label).siblings(".op-radio").attr("fgn-name");
			thatGroup = $("[op-name='" + name + "']");
			name = $(thatGroup).find(".op-radio").attr("fgn-name");
			thisGroup = $("[op-name='" + name + "']");
		}
	//define end

	//check
		function check(label) {
			return $(label).siblings(".op-radio:enabled").length === 1;
		}
	//check end

	function poEvent(radio, that) {
		var thatRadio = $(that).find(".op-radio");
		$(thatRadio).prop("disabled", false);
		
		var valueStr = $(radio).attr("fgn-id");
		if(!valueStr) {
			return;
		}
		var valueArr = valueStr.split(",");

		valueArr.forEach(function(value) {
			thatRadio = $(thatRadio).not("[value='" + value + "']");
		});
		$(thatRadio).prop("disabled", true);
	}

	$(".op-label").hover(function() {
		//check, define
			if(!check(this)) {
				return;
			}
			define(this);
		//check, define end

		poEvent($(this).siblings(".op-radio"), thatGroup);

	}, function() {
		//check, define
			if(!check(this)) {
				return;
			}
			define(this);
		//check, define end

		poEvent($(thisGroup).find(".op-radio:checked"), thatGroup);
		poEvent($(thatGroup).find(".op-radio:checked"), thisGroup);

	});

	$(".op-label").on("click", function(event) {
		var radio = $(this).siblings(".op-radio");
		if($(radio).prop("checked")) {
			event.preventDefault();
			$(radio).attr("checked", false);
		}
	});

});