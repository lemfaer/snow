jQuery(document).ready(function($) {

//vars
	var id;
	var qty;
	var val;
	var min;
	var max;
	var qtyUp;
	var qtyDown;
	var qtyInput;
//vars end

//define
	function define(qtySmth) {
		qty = $(qtySmth).parents(".pr-qty");
		id  = $(qty).siblings(".id").text();
		
		qtyUp    = $(qty).find(".qty-up");
		qtyDown  = $(qty).find(".qty-down");
		qtyInput = $(qty).find(".qty-field input");

		min = 1;
		val = parseInt($(qtyInput).val());
		max = parseInt($(qtyInput).attr("available"));
	}
//define end

//check
	function check() {
		$(qtyUp).removeClass("disabled");
		$(qtyDown).removeClass("disabled");

		if(val < min) {
			$(qty).siblings(".pr-remove").click();
		} 
		if(val === min) {
			$(qtyDown).addClass("disabled")
		} 
		if(val === max) {
			$(qtyUp).addClass("disabled");
		}
	}
//check end

	$(".qty-up").click(function(event) {
		//define and check
			define(this);
			check();

			if($(this).hasClass("disabled")) {
				return;
			}
		//define and check end

		$.post("/cart/inc", {"id" : id}, function(data) {
			$(qtyInput).val(data);
			define(qtyUp);
			check();
			mini.update(); // from mini.js
			price.calculate(); // from price.js
		});
	});

	$(".qty-down").click(function(event) {
		//define and check
			define(this);
			check();

			if($(this).hasClass("disabled")) {
				return;
			}
		//define and check end

		$.post("/cart/dec", {"id" : id}, function(data) {
			$(qtyInput).val(data);
			define(qtyDown);
			check();
			mini.update(); // from mini.js
			price.calculate(); // from price.js
		});
	});

//load check
	$(".qty-field").each(function(index, el) {
		define(el);
		check();
	});
	mini.update(); // from mini.js
	price.calculate(); // from price.js
//load check end

});