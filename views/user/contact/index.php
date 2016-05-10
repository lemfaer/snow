<!-- REQUIRED -->
	<!-- $contact or null -->
<!-- REQUIRED END -->

<script type="text/javascript" src="/views/user/contact/contact.js"></script>
<script type="text/javascript" src="/template/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

<script type="text/javascript">document.title = "Контактная информация";</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var address = $("#contact-check-address");
		var phone   = $("#contact-check-phone");

		$(phone).mask("+38 (999) 999-99-99");

		new google.maps.places.Autocomplete($(address)[0], {
			language: "ru",
			componentRestrictions: {country: "ua"}
		});
	});
</script>

<div class="main">
	<div class="shop_top">
		<div class="container">

			<form method="post" id="form" action="/order/submit"> 
				<div class="register-top-grid">
					<h3>КОНТАКТНАЯ ИНФОРМАЦИЯ</h3>
					<div>
						<span>Имя<label></label></span>
						<input type="text" 
							name="contactData[name]" 
							class="check ajax" 
							id="contact-check-name" 
							autocomplete="off" 
							placeholder="Введите контактное имя"
							<?php if($contact): ?>
								value="<?= $contact->getName(); ?>"
							<?php endif; ?>
							required>
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
					<div>
						<span>Телефон<label></label></span>
						<input type="text" 
							name="contactData[phone]" 
							class="check ajax"
							id="contact-check-phone" 
							autocomplete="off"
							placeholder="Введите телефон"
							<?php if($contact): ?>
								value="<?= $contact->getPhone(); ?>"
							<?php endif; ?>
							required> 
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
					<div>
						<span>Адрес<label></label></span>
						<input type="text" 
							name="contactData[address]" 
							class="check ajax"
							id="contact-check-address" 
							autocomplete="off" 
							placeholder="Введите адрес"
							<?php if($contact): ?>
								value="<?= $contact->getAddress(); ?>"
							<?php endif; ?>
							required> 
						<i class="reg-status"></i>
						<i class="reg-text"></i>
					</div>
					<div class="clear"> </div>
				</div>
				
				<div class="clear"> </div>
				<input type="submit" value="Подтвердить">
			</form>

		</div>
	</div>
</div>