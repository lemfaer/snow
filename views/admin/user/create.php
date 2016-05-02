<!-- PLUGINS -->
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/template/iCheck/all.css">
	<script src="/template/iCheck/icheck.min.js"></script>

	<!-- MaskedInput -->
	<script type="text/javascript" src="/template/js/jquery.maskedinput.min.js"></script>

	<!-- Google Autocomplete -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>

	<!-- Settings -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		});
	</script>
<!-- PLUGINS END -->

<!-- SCRIPTS END -->
	<script type="text/javascript" src="/views/admin/crup.js"></script>

	<script type="text/javascript" src="/views/admin/observer.js"></script>
	<script type="text/javascript" src="/views/admin/clone.js"></script>

	<script type="text/javascript" src="/views/admin/user/address.js"></script>
	<script type="text/javascript" src="/views/admin/user/contact.js"></script>
	<script type="text/javascript" src="/views/admin/user/phone.js"></script>
<!-- SCRIPTS END -->

<!-- SETTINGS -->
	<script type="text/javascript">document.title = "User | Create"</script>
	<script type="text/javascript">crup.name = "user";</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		User Create
		<small>Добавление новой записи в таблицу User</small>
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

			<!-- First_Name(Имя) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Имя</label>
				</div>
				<input type="text" 
					name="user[first_name]"
					id="ad-user-first_name" 
					class="form-control" 
					placeholder="Введите имя"
					required>
				<label class="control-label" for="ad-user-first_name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Last_Name(Фамилия) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Фамилия</label>
				</div>
				<input type="text" 
					name="user[last_name]"
					id="ad-user-last_name" 
					class="form-control" 
					placeholder="Введите фамилию"
					required>
				<label class="control-label" for="ad-user-last_name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Email -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Email</label>
				</div>
				<input type="text" 
					name="user[email]"
					id="ad-user-email" 
					class="form-control" 
					placeholder="Введите email"
					required>
				<label class="control-label" for="ad-user-email">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Login(Логин) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Логин</label>
				</div>
				<input type="text" 
					name="user[login]"
					id="ad-user-login" 
					class="form-control" 
					placeholder="Введите логин"
					required>
				<label class="control-label" for="ad-user-login">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Password(Пароль) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Пароль</label>
				</div>
				<input type="text" 
					name="user[password]"
					id="ad-user-password" 
					class="form-control" 
					placeholder="Введите пароль"
					required>
				<label class="control-label" for="ad-user-password">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Contact(Контактная информация) -->
			<div class="clone-block">
				<!-- sample -->
				<div class="sample" next="1">
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
				
				<!-- clones -->
				<div class="clones"></div>

				<!-- button -->
				<button class="btn btn-default add-clone contact">
					Добавить контактные данные
				</button>
			</div>

			<!-- Is Admin(Админ панель) -->
			<div class="form-group ad-check">
				<div class="field-header">
					<label>Админ панель</label>
				</div>
				<label>
					<input type="checkbox"
						class="minimal ad-check-check">
					Доступна
					<input type="hidden"
						class="ad-check-text" 
						name="user[is_admin]">
				</label>
			</div>
	
			<!-- Status(Статус) -->
			<div class="form-group ad-check">
				<div class="field-header">
					<label>Статус</label>
				</div>
				<label>
					<input type="checkbox" 
						class="minimal ad-check-check"
						checked>
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