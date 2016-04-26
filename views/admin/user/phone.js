jQuery(document).ready(function($) {
	
	var name = crup.name; // object crup from /views/admin/crup.js

	function mask(clone) {
		var phones = $(clone).find("[id^='ad-" + name + "-contact-phone_']");
		$(phones).mask("+38 (999) 999-99-99");
	}

//observer
	// function observer from observer.js
	observer($("#ad-" + name + "-contact-phone_0")
		.parents(".clone-block").find(".clones")[0], mask);
//observer end
});