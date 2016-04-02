<!-- REQUIRED -->
	<!-- $user -->
<!-- REQUIRED END -->

<!-- PLUGINS -->
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/template/iCheck/all.css">
	<script src="/template/iCheck/icheck.min.js"></script>

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

			<!-- Status(Статус) -->
			<div class="form-group">
				<div class="field-header">
					<label>Статус</label>
				</div>
				<label>
					<input type="checkbox" 
						class="minimal"
						id="ad-status" 
						<?= ($status) ? ("checked") : (null) ?>>
					Включен
					<input type="hidden"
						id="ad-status-text"
						name="user[status]"
						value="true">
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