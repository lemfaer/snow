<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" src="/views/UserRegisterView/register-check.js"></script>

<div class="main">
	<div class="shop_top">
		<div class="container">

			<form method="post" id="form" action="<?="/register/submit"?>"> 
				<div class="register-top-grid">
					<h3>ПЕРСОНАЛЬНАЯ ИНФОРМАЦИЯ</h3>
					<div>
						<span>Имя<label></label></span>
						<input type="text" name="regData[first_name]" class="check ajax" 
							id="reg-check-first_name" autocomplete="off" required>
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
					<div>
						<span>Фамилия<label></label></span>
						<input type="text" name="regData[last_name]" class="check ajax"
							id="reg-check-last_name" autocomplete="off" required> 
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
					<div>
						<span>Email<label></label></span>
						<input type="text" name="regData[email]" class="check ajax"
							id="reg-check-email" autocomplete="off" required> 
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
					<div class="clear"> </div>
				</div>

				<div class="clear"> </div>
				<br>

				<div class="register-bottom-grid">
					<h3>РЕГИСТРАЦИОННАЯ ИНФОРМАЦИЯ</h3>
					<div>
						<span>Логин<label></label></span>
						<input type="text" name="regData[login]" class="check ajax"
							id="reg-check-login" autocomplete="off" required>
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
					<div>
						<span>Пароль<label></label></span>
						<input type="password" name="regData[password]" class="check ajax"
							id="reg-check-password" autocomplete="off" required>
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
					<div>
						<span>Подтвердите Пароль<label></label></span>
						<input type="password" id="cpass" class="check" 
							autocomplete="off" required>
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
				</div>
				<!-- 
					<div class="clear"> </div>
					<a class="news-letter" href="#">
						<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
					</a> 
				-->
				<div class="g-recaptcha" data-theme="light" id="captcha"
					data-sitekey="6Ld9xhoTAAAAABPLHe7BJCHLuPFffdD8nP4geB9z">
				</div>
				<div class="clear"> </div>
				<input type="submit" value="Отправить">
			</form>
		</div>
	</div>
</div>