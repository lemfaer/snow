function updateState(state) {
	// function select from select.js
	select(state, "/admin/select/states", 
		{"state": null}, "Выберите статус", "state");
}

jQuery(document).ready(function($) {

	var name = crup.name; // object crup from /views/admin/crup.js

	updateState($("#ad-" + name + "-state"));

});