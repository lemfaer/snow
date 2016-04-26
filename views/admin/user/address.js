jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	function map(clone) {
		var address = $(clone).find("[id^='ad-" + name + "-contact-address_']");

		$(address).each(function(index, el) {
			console.log(index);
			var autocomplete = 
				new google.maps.places.Autocomplete($(el)[0], {
					language: "ru",
					componentRestrictions: {country: "ua"}
				});
		});
	}

//observer
	// function observer from observer.js
	observer($("#ad-" + name + "-contact-address_0")
		.parents(".clone-block").find(".clones")[0], map);
//observer end
});