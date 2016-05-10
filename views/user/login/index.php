<script type="text/javascript" src="/views/user/login/login.js" charset="utf-8"></script>
<script type="text/javascript">document.title = "Вход";</script>

<div class="main">
<div class="shop_top">
<div class="container">

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="login-page">
		<h4 class="title">для новых пользователей</h4>

		<p>Учётная запись — хранимая в компьютерной системе совокупность данных о пользователе, необходимая для его опознавания (аутентификации) и предоставления доступа к его личным данным и настройкам. В качестве синонимов также используются разговорное учётка и сленговые варваризмы акк, акка́унт и экка́унт (от англ. account «учётная запись, личный счёт»).</p>

		<div class="button1">
			<a href="/register">
				<input type="submit" name="Submit" value="Регистрация">
			</a>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="login-title">
		<h4 class="title">Зарегистрированным пользователям</h4>

		<div id="loginbox" class="loginbox">
			<form action="/login/submit" method="post" name="login" id="login-form">
				<fieldset class="input">
					<p id="login-form-username">
						<label for="modlgn_username">Логин или email</label>
						<input id="modlgn_username" type="text" 
							name="loginData[elo]" 
							class="inputbox" size="18" autocomplete="off">
					</p>
					<p id="login-form-password">
						<label for="modlgn_passwd">Пароль</label>
						<input id="modlgn_passwd" type="password" 
							class="inputbox" size="18" autocomplete="off">
					</p>
					<input type="hidden" id="modlgn_hash" name="loginData[password]">
					<label id="log-error">
						<p style="text-align: center; color: #E92546;"></p>
					</label>
					<div class="remember">
						<input type="submit" name="Submit" class="button" value="Вход">
						<div class="clear"></div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<div class="clear"></div>
</div>

</div>
</div>
</div>