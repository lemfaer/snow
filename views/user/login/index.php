<script type="text/javascript" src="/views/user/login/login.js" charset="utf-8"></script>

<div class="main">
	<div class="shop_top">
		<div class="container">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="login-page">
					<h4 class="title">для новых пользователей</h4>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis</p>
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
										name="loginData[password]" 
										class="inputbox" size="18" autocomplete="off">
								</p>
								<div class="remember">
									<p id="login-form-remember">
										<label for="modlgn_remember">
											<a href="#">Забыли пароль?</a>
										</label>
									</p>
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