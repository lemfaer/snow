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
	<script type="text/javascript" src="/views/admin/image.js"></script>
	<script type="text/javascript" src="/views/admin/inherits.js"></script>

	<script type="text/javascript" src="/views/admin/category/sort.js"></script>
<!-- SCRIPTS END -->

<!-- SETTINGS -->
	<script type="text/javascript">crup.name = "category";</script>
	<script type="text/javascript">select_top.parent = {id: 0, text: "Нет"};</script>
	<script type="text/javascript">select_top.sort = {id: 0, text: "В начало"};</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		Category Create
		<small>Добавление новой записи в таблицу Category</small>
	</h1>
</section>

<section class="content">
<div class="row">
<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
	<div class="box box-default">
	
		<div class="box-header with-border">
			<h3 class="box-title">Category</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool ad-read-link" data-widget="remove" >
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-category" action="/admin/category/crup/submit" method="post"
			enctype="multipart/form-data">

			<!-- Parent(Родительская категория) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Родительская категория</label>
				</div>
				<select
					name="category[parent]"
					id="ad-category-parent" 
					class="form-control select2"
					required
					style="width: 100%;">
					<option></option>
					<option value="0">Нет</option>
				</select>
				<label class="control-label" for="ad-category-parent">
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
					name="category[name]"
					id="ad-category-name" 
					class="form-control" 
					placeholder="Введите название"
					required>
				<label class="control-label" for="ad-category-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Short Name(Краткое имя) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Краткое имя</label>
				</div>
				<input type="text" 
					name="category[short_name]"
					id="ad-category-short_name" 
					class="form-control" 
					placeholder="Введите краткое имя"
					required>
				<label class="control-label" for="ad-category-short_name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Description(Описание) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Описание</label>
				</div>
				<textarea 
					name="category[description]"
					id="ad-category-description"
					class="form-control"
					placeholder="Введите описание"
					required
					rows="3"
					style="max-width: 100%;"></textarea>
				<label class="control-label" for="ad-category-description">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Image(Изображение) -->
			<div class="form-group image ajax">
				<div class="field-header">
					<label>Изображение</label>
				</div>
				<input type="file"
					name="category[image]"
					id="ad-category-image" 
					class="form-control image"
					required>
				<label class="control-label" for="ad-category-image">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Sort Order(Порядок) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Порядок (вставить после)</label>
				</div>
				<select 
					name="category[sort_order]" 
					id="ad-category-sort_order" 
					class="form-control select2"
					required
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-category-sort_order">
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
						name="category[status]">
				</label>
			</div>

			<!-- Submit -->
			<button class="btn btn-success"
				form="ad-category" 
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