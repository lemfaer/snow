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
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".add-clone").click();
	});
</script>

<section class="content-header">
	<h1>
		Characteristic Create
		<small>Добавление новой записи в таблицу Characteristic</small>
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
			
			<!-- Parent(Категория) -->
			<div class="form-group">
				<div class="field-header">
					<label>Категория</label>
				</div>
				<select id="ad-char-parent" 
					class="form-control select2"
					required
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-char-parent">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Category(Подкатегория) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Подкатегория</label>
				</div>
				<select name="char[category]" 
					id="ad-char-category" 
					class="form-control select2"
					required
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-char-category">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Name(Название) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Название</label>
				</div>
				<input type="text" 
					name="char[name]"
					id="ad-char-name" 
					class="form-control" 
					placeholder="Введите название"
					required>
				<label class="control-label" for="ad-char-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Value(Значения) -->
			<div class="clone-block">
				<div class="field-header">
					<label>Значения</label>
				</div>
				<!-- sample -->
				<div class="sample" next="1">
					<div class="form-group">
						<div class="input-group">
							<input type="text" 
								name="char[value][]"
								id="ad-char-value_0" 
								class="form-control" 
								placeholder="Введите значение"
								required
								disabled>
							<span class="input-group-btn">
								<button class="btn btn-danger btn-flat remove-clone">
									<i class="fa fa-remove"></i>
								</button>
							</span>
						</div>
						<label class="control-label" for="ad-char-value_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>
				</div>
				
				<!-- clones -->
				<div class="clones"></div>

				<!-- button -->
				<button class="btn btn-default add-clone">
					Добавить значение
				</button>
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
						checked>
					Включен
					<input type="hidden"
						id="ad-status-text"
						name="char[status]"
						value="true">
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