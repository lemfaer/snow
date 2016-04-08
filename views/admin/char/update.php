<!-- REQUIRED -->
	<!-- $char -->
<!-- REQUIRED END -->

<!-- PLUGINS -->
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/template/iCheck/all.css">
	<script src="/template/iCheck/icheck.min.js"></script>
	<!-- Select2 -->
	<link rel="stylesheet" href="/template/css/select2.min.css">
	<script src="/template/js/select2.full.min.js"></script>

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

<script type="text/javascript" src="/views/admin/crup.js"></script>
<script type="text/javascript">crup.name = "char";</script>
<script type="text/javascript" src="/views/admin/inherits.js"></script>
<script type="text/javascript" src="/views/admin/clone.js"></script>

<?php $charName  = $char->getName(); ?>
<?php $charValue = $char; ?>

<?php $category   = $charName->getCategory(); ?>
<?php $parentID   = $category->getParent()->getID(); ?>
<?php $categoryID = $category->getID(); ?>

<?php $name   = $charName->getName(); ?>

<?php $id     = $charValue->getID(); ?>
<?php $value  = $charValue->getValue(); ?>
<?php $status = $charValue->getStatus(); ?>

<section class="content-header">
	<h1>
		Characteristic Update
		<small>Редактирование записи в таблице Characteristic</small>
	</h1>
</section>

<section class="content">
<div class="row">
<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
	<div class="box box-default">
	
		<div class="box-header with-border">
			<h3 class="box-title">Characteristic</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool ad-read-link" data-widget="remove" >
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-char" action="/admin/char/crup/submit" method="post">
			
			<!-- ID -->
			<div class="form-group id">
				<input type="hidden"
					name="char[id]"
					value="<?= $id; ?>">
			</div>

			<!-- Parent(Категория) -->
			<div class="form-group">
				<div class="field-header">
					<label>Категория</label>
				</div>
				<select id="ad-char-parent" 
					class="form-control select2 update"
					data-id="<?= $parentID; ?>"
					required
					disabled
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-char-parent">
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
				<select name="char[category]" 
					id="ad-char-category" 
					class="form-control select2 update"
					data-id="<?= $categoryID; ?>"
					required
					disabled
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-char-category">
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
					name="char[name]"
					id="ad-char-name" 
					class="form-control" 
					placeholder="Введите название"
					value="<?= $name; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-char-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Value(Значение) -->
			<div class="form-group">
				<div class="field-header">
					<label>Значение</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="text" 
					name="char[value]"
					id="ad-char-value" 
					class="form-control" 
					placeholder="Введите название"
					value="<?= $value; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-char-value">
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
						name="char[status]">
				</label>
			</div>

			<!-- Submit -->
			<button class="btn btn-success"
				form="ad-char" 
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