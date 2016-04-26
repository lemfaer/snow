<!-- REQUIRED -->
	<!-- $user -->
<!-- REQUIRED END -->

<!-- PLUGINS -->
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/template/iCheck/all.css">
	<script src="/template/iCheck/icheck.min.js"></script>
	<script type="text/javascript" src="/template/js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		});
	</script>
<!-- PLUGINS END -->

<script type="text/javascript" src="/views/admin/crup.js"></script>
<script type="text/javascript">crup.name = "user";</script>
<script type="text/javascript" src="/views/admin/user/pass_update.js"></script>
<script type="text/javascript" src="/views/admin/clone.js"></script>
<script type="text/javascript" src="/views/admin/observer.js"></script>
<script type="text/javascript" src="/views/admin/user/contact.js"></script>
<script type="text/javascript" src="/views/admin/user/phone.js"></script>
<script type="text/javascript" src="/views/admin/user/address.js"></script>

<?php $userItem = $user; ?>
<?php $user = $user->getUser(); ?>

<?php $id        = $user->getID(); ?>
<?php $email     = $user->getEmail(); ?>
<?php $login     = $user->getLogin(); ?>
<?php $status    = $user->getStatus(); ?>
<?php $password  = $user->getPassword(); ?>
<?php $lastName  = $user->getLastName(); ?>
<?php $firstName = $user->getFirstName(); ?>

<section class="content-header">
	<h1>
		User Update
		<small>Редактирование записи в таблице User</small>
	</h1>
</section>

<section class="content">
<div class="row">
<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
	<div class="box box-default">

		<div class="box-header with-border">
			<h3 class="box-title">User</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool ad-read-link" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-user" action="/admin/user/crup/submit" method="post">

			<!-- ID -->
			<div class="form-group id">
				<input type="hidden"
					name="user[id]"
					value="<?= $id; ?>">
			</div>

			<!-- First_Name(Имя) -->
			<div class="form-group">
				<div class="field-header">
					<label>Имя</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="text" 
					name="user[first_name]"
					id="ad-user-first_name" 
					class="form-control" 
					placeholder="Введите имя"
					value="<?= $firstName; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-user-first_name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Last_Name(Фамилия) -->
			<div class="form-group">
				<div class="field-header">
					<label>Фамилия</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="text" 
					name="user[last_name]"
					id="ad-user-last_name" 
					class="form-control" 
					placeholder="Введите фамилию"
					value="<?= $lastName; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-user-last_name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Email -->
			<div class="form-group">
				<div class="field-header">
					<label>Email</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="text" 
					name="user[email]"
					id="ad-user-email" 
					class="form-control" 
					placeholder="Введите email"
					value="<?= $email; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-user-email">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Login(Логин) -->
			<div class="form-group">
				<div class="field-header">
					<label>Логин</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="text" 
					name="user[login]"
					id="ad-user-login" 
					class="form-control" 
					placeholder="Введите логин"
					value="<?= $login; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-user-login">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Password(Пароль) -->
			<div class="form-group">
				<div class="field-header">
					<label>Пароль</label>
					<a class="ad_update password">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="text" 
					name="user[password]"
					id="ad-user-password" 
					class="form-control" 
					placeholder="Введите пароль"
					value="<?= $password; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-user-password">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Contact(Контактная информация) -->
			<div class="clone-block">
				<!-- clones -->
				<div class="clones">
					<?php $i = 1; ?>
					<?php if($userItem->issetContact()): ?>
						<?php $contact = $userItem->getContact(); ?>

						<?php $name    = $contact->getName(); ?>
						<?php $phone   = $contact->getPhone(); ?>
						<?php $address = $contact->getAddress(); ?>

						<div class="clone" this="<?= $i; ?>">
							<!-- Name(Контактное лицо) -->
							<div class="form-group">
								<div class="field-header">
									<label>Контактное лицо</label>
									<a class="ad_update">
										<i class="up_ico fa fa-edit"></i>
										<font class="up_message">Изменить</font>
									</a>
								</div>
								<input type="text" 
									name="user[contact][names][contact-name_<?= $i; ?>]"
									id="ad-user-contact-name_<?= $i; ?>" 
									class="form-control" 
									placeholder="Введите значение"
									value="<?= $name; ?>"
									required
									disabled>
								<label class="control-label" for="ad-user-contact-name_<?= $i; ?>">
									<i class="ico fa fa-check"></i> 
									<font class="message">Ошибка</font>
								</label>
							</div>

							<!-- Phone(Телефон) -->
							<div class="form-group">
								<div class="field-header">
									<label>Телефон</label>
									<a class="ad_update">
										<i class="up_ico fa fa-edit"></i>
										<font class="up_message">Изменить</font>
									</a>
								</div>
								<input type="text" 
									name="user[contact][phones][contact-phone_<?= $i; ?>]"
									id="ad-user-contact-phone_<?= $i; ?>" 
									class="form-control" 
									placeholder="Введите значение"
									value="<?= $phone; ?>"
									required
									disabled>
								<label class="control-label" for="ad-user-contact-phone_<?= $i; ?>">
									<i class="ico fa fa-check"></i> 
									<font class="message">Ошибка</font>
								</label>
							</div>

							<!-- Address(Адрес) -->
							<div class="form-group">
								<div class="field-header">
									<label>Адрес</label>
									<a class="ad_update">
										<i class="up_ico fa fa-edit"></i>
										<font class="up_message">Изменить</font>
									</a>
								</div>
								<input type="text" 
									name="user[contact][addresses][contact-address_<?= $i; ?>]"
									id="ad-user-contact-address_<?= $i; ?>" 
									class="form-control" 
									placeholder="Введите значение"
									value="<?= $address; ?>"
									required
									disabled>
								<label class="control-label" for="ad-user-contact-address_<?= $i; ?>">
									<i class="ico fa fa-check"></i> 
									<font class="message">Ошибка</font>
								</label>
							</div>

							<button class="btn btn-danger remove-clone contact">
								Удалить контактные данные
							</button>
						</div>

						<script type="text/javascript">
							jQuery(document).ready(function($) {
								$(".add-clone.contact").hide("fast");
							});
						</script>

						<?php $i++; ?>
					<?php endif ?>
				</div>

				<!-- sample -->
				<div class="sample" next="<?= $i; ?>">
					<!-- Name(Контактное лицо) -->
					<div class="form-group">
						<div class="field-header">
							<label>Контактное лицо</label>
						</div>
						<input type="text" 
							name="user[contact][names][contact-name_0]"
							id="ad-user-contact-name_0" 
							class="form-control" 
							placeholder="Введите значение"
							required
							disabled>
						<label class="control-label" for="ad-user-contact-name_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>

					<!-- Phone(Телефон) -->
					<div class="form-group">
						<div class="field-header">
							<label>Телефон</label>
						</div>
						<input type="text" 
							name="user[contact][phones][contact-phone_0]"
							id="ad-user-contact-phone_0" 
							class="form-control" 
							placeholder="Введите значение"
							required
							disabled>
						<label class="control-label" for="ad-user-contact-phone_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>

					<!-- Address(Адрес) -->
					<div class="form-group">
						<div class="field-header">
							<label>Адрес</label>
						</div>
						<input type="text" 
							name="user[contact][addresses][contact-address_0]"
							id="ad-user-contact-address_0" 
							class="form-control" 
							placeholder="Введите значение"
							required
							disabled>
						<label class="control-label" for="ad-user-contact-address_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>

					<button class="btn btn-danger remove-clone-lazy contact">
						Удалить контактные данные
					</button>
				</div>

				<!-- button -->
				<button class="btn btn-default add-clone contact">
					Добавить контактные данные
				</button>
			</div>

			<!-- Status(Статус) -->
			<div class="form-group ad-check">
				<div class="field-header">
					<label>Статус</label>
				</div>
				<label>
					<input type="checkbox" 
						class="minimal ad-check-check"
						<?= ($status) ? ("checked") : (null) ?>>
					Включен
					<input type="hidden"
						class="ad-check-text" 
						name="user[status]">
				</label>
			</div>

			<!-- Submit -->
			<button class="btn btn-success"
				form="ad-user" 
				type="submit" 
				style="float: right;">
				Сохранить
			</button>
		</form>
		</div>
	</div>
</div>
</div>
</section>