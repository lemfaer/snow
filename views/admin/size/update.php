<!-- REQUIRED -->
	<!-- $size -->
<!-- REQUIRED END -->

<!-- PLUGINS -->
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/template/iCheck/all.css">
	<script src="/template/iCheck/icheck.min.js"></script>

	<!-- Select2 -->
	<link rel="stylesheet" href="/template/css/select2.min.css">
	<script src="/template/js/select2.full.min.js"></script>

	<!-- Settings -->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		});
		
		jQuery(document).ready(function($) {
			$(".select2").select2();
		});
	</script>
<!-- PLUGINS END -->

<!-- SCRIPTS -->
	<script type="text/javascript" src="/views/admin/crup.js"></script>

	<script type="text/javascript" src="/views/admin/select.js"></script>
	<script type="text/javascript" src="/views/admin/inherits.js"></script>
<!-- SCRIPTS END -->

<!-- SETTINGS -->
	<script type="text/javascript">document.title = "Size | Update"</script>
	<script type="text/javascript">crup.name = "size";</script>
<!-- SETTINGS END -->

<?php $id       = $size->getID(); ?>
<?php $name     = $size->getName(); ?>
<?php $status   = $size->getStatus(); ?>
<?php $category = $size->getCategory(); ?>

<?php $categoryID = $category->getID(); ?>
<?php $parentID   = $category->getParent()->getID(); ?>

<section class="content-header">
	<h1>
		Size Update
		<small>Редактирование записи в таблице Size</small>
	</h1>
</section>

<section class="content">
<div class="row">
<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
	<div class="box box-default">

		<div class="box-header with-border">
			<h3 class="box-title">Size</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool ad-read-link" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-size" action="/admin/size/crup/submit" method="post">
			
			<!-- ID -->
			<div class="form-group id">
				<input type="hidden"
					name="size[id]"
					value="<?= $id; ?>">
			</div>

			<!-- Parent(Категория) -->
			<div class="form-group">
				<div class="field-header">
					<label>Категория</label>
				</div>
				<select id="ad-size-parent" 
					class="form-control select2 update"
					data-id="<?= $parentID; ?>"
					required
					disabled
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-size-parent">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Category(Подкатегория) -->
			<div class="form-group">
				<div class="field-header">
					<label>Подкатегория</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<select name="size[category]" 
					id="ad-size-category" 
					class="form-control select2 update"
					data-id="<?= $categoryID; ?>"
					required
					disabled
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-size-category">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Name(Название) -->
			<div class="form-group">
				<div class="field-header">
					<label>Название</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="text" 
					name="size[name]"
					id="ad-size-name" 
					class="form-control" 
					placeholder="Введите название"
					value="<?= $name; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-size-name">
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
						<?= ($status) ? ("checked") : (null) ?>>
					Включен
					<input type="hidden"
						class="ad-check-text" 
						name="size[status]">
				</label>
			</div>

			<!-- Submit -->
			<button class="btn btn-success"
				form="ad-size" 
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