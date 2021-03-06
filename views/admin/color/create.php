<!-- PLUGINS -->
	<!-- bootstrap color picker -->
	<link rel="stylesheet" href="/template/colorpicker/bootstrap-colorpicker.min.css">
	<script src="/template/colorpicker/bootstrap-colorpicker.min.js"></script>

	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/template/iCheck/all.css">
	<script src="/template/iCheck/icheck.min.js"></script>

	<!-- Settings -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#colorpicker").colorpicker();

			$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		});
	</script>
<!-- PLUGINS END -->

<!-- SCRIPTS -->
	<script type="text/javascript" src="/views/admin/crup.js"></script>
<!-- SCRIPTS END -->

<!-- SETTINGS -->
	<script type="text/javascript">document.title = "Color | Create"</script>
	<script type="text/javascript">crup.name = "color";</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		Color Create
		<small>Добавление новой записи в таблицу Color</small>
	</h1>
</section>

<section class="content">
<div class="row">
<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
	<div class="box box-default">

		<div class="box-header with-border">
			<h3 class="box-title">Color</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool ad-read-link" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-color" action="/admin/color/crup/submit" method="post">

			<!-- Name(Название) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Название</label>
				</div>
				<input type="text" 
					name="color[name]"
					id="ad-color-name" 
					class="form-control" 
					placeholder="Введите название"
					required>
				<label class="control-label" for="ad-color-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Value(Цвет) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Цвет</label>
				</div>
				<div class="input-group" id="colorpicker">
					<input type="text" 
						name="color[value]"
						id="ad-color-value" 
						class="form-control" 
						placeholder="Введите цвет"
						required>
					<div class="input-group-addon">
						<i></i>
					</div>
				</div>
				<label class="control-label" for="ad-color-value">
					<i class="ico fa fa-check"></i> 
					<font class="message">Успех!</font>
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
						name="color[status]">
				</label>
			</div>

			<!-- Submit -->
			<button class="btn btn-success"
				form="ad-color" 
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