function updateProducer(producer) {
	// function select from select.js
	select(producer, "/admin/select/producers", 
		{"producer": null}, "Выберите изготовителя");
}

jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	updateProducer($("#ad-" + name + "-producer"));

});