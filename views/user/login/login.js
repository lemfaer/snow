jQuery(document).ready(function($) {

	$("#log-error").hide();
	
	$("#login-form").submit(function(event) {
		var dom = this;
		event.preventDefault();

		var loginData = {};
		
		var elo = $("#modlgn_username").val();
		loginData.elo = elo;

		var password = $("#modlgn_passwd").val();
		loginData.password = $.md5($.md5(password));

		$.post("/login/check", {loginData : loginData}, function(data) {
			if(data.success) {
				$("#modlgn_hash").val(loginData.password);
				$("#log-error").hide();
				dom.submit();
			} else {
				$("#log-error p").text(data.error);
				$("#log-error").show();
			}
		}, "json");
	});

});