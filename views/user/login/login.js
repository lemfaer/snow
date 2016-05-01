jQuery(document).ready(function($) {
	
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
				$("#modlgn_passwd").val(loginData.password);
				dom.submit();
			} else {
				console.log(data['error']);
			}
		}, "json");
	});

});