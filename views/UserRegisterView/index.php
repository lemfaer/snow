<div class="main">
	<div class="shop_top">
		<div class="container">

			<form method="post" action="/register/submit"> 
				<div class="register-top-grid">
					<h3>PERSONAL INFORMATION</h3>
					<div>
						<span>First Name<label></label></span>
						<input type="text" name="first_name" required> 
					</div>
					<div>
						<span>Last Name<label></label></span>
						<input type="text" name="last_name" required> 
					</div>
					<div>
						<span>Email Address<label></label></span>
						<input type="text" name="email" required> 
					</div>
					<div class="clear"> </div>
				</div>

				<div class="clear"> </div>
				<br>

				<div class="register-bottom-grid">
					<h3>LOGIN INFORMATION</h3>
					<div>
						<span>Login<label></label></span>
						<input type="text" name="login" required>
					</div>
					<div>
						<span>Password<label></label></span>
						<input type="password" name="password" required>
					</div>
					<div>
						<span>Confirm Password<label></label></span>
						<input type="password" name="cpass" required>
					</div>
				</div>
				<!-- 
					<div class="clear"> </div>
					<a class="news-letter" href="#">
						<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
					</a> 
				-->
				<div class="clear"> </div>
				<input type="submit" value="submit">
			</form>
		</div>
	</div>
</div>