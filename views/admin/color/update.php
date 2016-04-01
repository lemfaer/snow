<!-- REQUIRED -->
	<!-- $color -->
<!-- REQUIRED END -->

<?php $id     = $color->getID(); ?>
<?php $name   = $color->getName(); ?>
<?php $value  = $color->getValue(); ?>
<?php $status = $color->getStatus(); ?>

<!-- bootstrap color picker -->
<link rel="stylesheet" href="/template/colorpicker/bootstrap-colorpicker.min.css">
<script src="/template/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="/template/iCheck/all.css">
<script src="/template/iCheck/icheck.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#colorpicker").colorpicker();

		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
	});
</script>

<script type="text/javascript" src="/views/admin/adminform.js"></script>
<script type="text/javascript">
	adminForm.name = "color";
</script>

<section class="content-header">
	<h1>
		Color Update
		<small>Редактирование записи в таблице Color</small>
	</h1>
</section>

<section class="content">
<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Color</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool" data-widget="remove" 
					onclick="window.location.href = '/admin/color/'">
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-color" action="/admin/color/crup/submit" method="post">
			<div class="form-group">
				<input type="hidden"
					name="color[id]"
					value="<?= $id; ?>">
			</div>

			<div class="form-group">
				<div class="field-header">
					<label>Название</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="text" 
					name="color[name]"
					id="ad-color-name" 
					class="form-control" 
					placeholder="Введите название"
					value="<?= $name; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-color-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<div class="form-group">
				<div class="field-header">
					<label>Цвет</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<div class="input-group" id="colorpicker">
					<input type="text" 
						name="color[value]"
						id="ad-color-value" 
						class="form-control" 
						placeholder="Введите цвет"
						value="<?= $value; ?>" 
						required
						disabled>
					<div class="input-group-addon">
						<i></i>
					</div>
				</div>
				<label class="control-label" for="ad-color-value">
					<i class="ico fa fa-check"></i> 
					<font class="message">Успех!</font>
				</label>
			</div>

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
						name="color[status]"
						value="true">
				</label>
            </div>

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
</section>