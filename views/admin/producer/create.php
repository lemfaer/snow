<!-- PLUGINS -->
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/template/iCheck/all.css">
	<script src="/template/iCheck/icheck.min.js"></script>

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

<!-- SCRIPTS -->
	<script type="text/javascript" src="/views/admin/crup.js"></script>

	<script type="text/javascript" src="/views/admin/image.js"></script>
<!-- SCRIPTS END -->

<!-- SETTINGS -->
	<script type="text/javascript">crup.name = "producer";</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		Producer Create
		<small>Добавление новой записи в таблицу Producer</small>
	</h1>
</section>

<section class="content">
<div class="row">
<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
	<div class="box box-default">

		<div class="box-header with-border">
			<h3 class="box-title">Producer</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool ad-read-link" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-producer" action="/admin/producer/crup/submit" method="post" 
			enctype="multipart/form-data">

			<!-- Name(Название) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Название</label>
				</div>
				<input type="text" 
					name="producer[name]"
					id="ad-producer-name" 
					class="form-control" 
					placeholder="Введите имя"
					required>
				<label class="control-label" for="ad-producer-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Image(Логотип) -->
			<div class="form-group image ajax">
				<div class="field-header">
					<label>Логотип</label>
				</div>
				<input type="file"
					name="producer[image]"
					id="ad-producer-image" 
					class="form-control image"
					required>
				<label class="control-label" for="ad-producer-image">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
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
						name="producer[status]">
				</label>
			</div>

			<!-- Submit -->
			<button class="btn btn-success"
				form="ad-producer" 
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