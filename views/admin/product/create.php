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

<script type="text/javascript" src="/views/admin/product/select.js"></script>
<script type="text/javascript" src="/views/admin/product/observer.js"></script>
<script type="text/javascript" src="/views/admin/crup.js"></script>
<script type="text/javascript">crup.name = "product";</script>
<script type="text/javascript" src="/views/admin/inherits.js"></script>
<script type="text/javascript" src="/views/admin/product/producers.js"></script>
<script type="text/javascript" src="/views/admin/product/names.js"></script>
<script type="text/javascript" src="/views/admin/product/values.js"></script>
<script type="text/javascript" src="/views/admin/product/colors.js"></script>
<script type="text/javascript" src="/views/admin/product/sizes.js"></script>
<script type="text/javascript" src="/views/admin/clone.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".add-clone").click();
	});
</script>

<?php $yearMin = (int)date("Y", 0); ?>
<?php $yearMax = (int)date("Y"); ?>

<section class="content-header">
	<h1>
		Product Create
		<small>Добавление новой записи в таблицу Product</small>
	</h1>
</section>

<section class="content">
<div class="row">
<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
	<div class="box box-default">
	
		<div class="box-header with-border">
			<h3 class="box-title">Product</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool ad-read-link" data-widget="remove" >
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-product" action="/admin/product/crup/submit" method="post"
			enctype="multipart/form-data">
			
			<!-- Parent(Категория) -->
			<div class="form-group">
				<div class="field-header">
					<label>Категория</label>
				</div>
				<select id="ad-product-parent" 
					class="form-control select2"
					required
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-product-parent">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Category(Подкатегория) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Подкатегория</label>
				</div>
				<select name="product[category]" 
					id="ad-product-category" 
					class="form-control select2"
					required
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-product-category">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Producer(Изготовитель) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Изготовитель</label>
				</div>
				<select id="ad-product-producer"
					name="product[producer]" 
					class="form-control select2"
					required
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-product-producer">
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
					name="product[name]"
					id="ad-product-name" 
					class="form-control" 
					placeholder="Введите название"
					required>
				<label class="control-label" for="ad-product-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Price(Цена) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Цена</label>
				</div>
				<input type="number" 
					name="product[price]"
					id="ad-product-price" 
					class="form-control" 
					placeholder="Введите цену"
					required
					min="1">
				<label class="control-label" for="ad-product-price">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Year(Год выпуска) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Год выпуска</label>
				</div>
				<input type="number" 
					name="product[year]"
					id="ad-product-year" 
					class="form-control" 
					placeholder="Введите год выпуска"
					required
					min="<?= $yearMin; ?>"
					max="<?= $yearMax; ?>">
				<label class="control-label" for="ad-product-year">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Short Description(Краткое описание) -->
			<div class="form-group ajax">
				<div class="field-header">
					<label>Краткое описание</label>
				</div>
				<textarea 
					name="product[short_description]"
					id="ad-product-short_description"
					class="form-control"
					placeholder="Введите краткое описание"
					rows="2"
					style="max-width: 100%;"></textarea>
				<label class="control-label" for="ad-product-short_description">
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
					name="product[description]"
					id="ad-product-description"
					class="form-control"
					placeholder="Введите описание"
					rows="3"
					style="max-width: 100%;"></textarea>
				<label class="control-label" for="ad-product-description">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Images(Изображения) -->
			<div class="clone-block">
				<div class="field-header">
					<label>Изображения</label>
				</div>

				<!-- sample -->
				<div class="sample row" next="1">
					<div class="form-group image col-lg-12 col-md-12 col-sm-12 vol-xs-12">
						<div class="input-group">
							<input type="file"
								name="product[image][image_0]"
								id="ad-product-image_0" 
								class="form-control image"
								required
								disabled>
							<span class="input-group-btn">
								<button class="btn btn-danger btn-flat remove-clone">
									<i class="fa fa-remove"></i>
								</button>
							</span>
						</div>
						<label class="control-label" for="ad-product-image_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>
				</div>

				<!-- clones -->
				<div class="clones"></div>

				<!-- button -->
				<button class="btn btn-default add-clone">
					Добавить изображение
				</button>
			</div>

			<!-- Characteristic(Характеристики) -->
			<div class="clone-block">
				<div class="field-header">
					<label>Характеристики</label>
				</div>

				<!-- sample -->
				<div class="sample row" next="1">
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<select id="ad-product-char_name_0"
							name="product[char_name][char_name_0]" 
							class="form-control select2-lazy"
							required
							disabled
							style="width: 100%;">
							<option></option>
						</select>
						<label class="control-label" for="ad-product-char_name_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
						<div class="input-group">
							<select id="ad-product-char_value_0"
								name="product[char_value][char_value_0]"
								class="form-control select2-lazy"
								required
								disabled
								style="width: 100%;">
								<option></option>
							</select>
							<span class="input-group-btn">
								<button class="btn btn-danger btn-flat remove-clone">
									<i class="fa fa-remove"></i>
								</button>
							</span>
						</div>
						<label class="control-label" for="ad-product-char_value_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>
				</div>

				<!-- clones -->
				<div class="clones"></div>

				<!-- button -->
				<button class="btn btn-default add-clone">
					Добавить характеристику
				</button>
			</div>

			<!-- Available(Доступные) -->
			<div class="clone-block">
				<div class="field-header">
					<label>Доступные</label>
				</div>

				<!-- sample -->
				<div class="sample row" next="1">
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<select id="ad-product-color_0"
							name="product[color][color_0]"
							class="form-control select2-lazy"
							required
							disabled
							style="width: 100%;">
							<option></option>
						</select>
						<label class="control-label" for="ad-product-lolor_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<select id="ad-product-size_0" 
							name="product[size][size_0]"
							class="form-control select2-lazy"
							required
							disabled
							style="width: 100%;">
							<option></option>
						</select>
						<label class="control-label" for="ad-product-size_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<div class="input-group">
							<input type="number" 
								name="product[count][count_0]"
								id="ad-product-count_0" 
								class="form-control" 
								placeholder="Введите количество"
								required
								disabled
								min="0"
								max="999">
							<span class="input-group-btn">
								<button class="btn btn-danger btn-flat remove-clone">
									<i class="fa fa-remove"></i>
								</button>
							</span>
						</div>
						<label class="control-label" for="ad-product-count_0">
							<i class="ico fa fa-check"></i> 
							<font class="message">Ошибка</font>
						</label>
					</div>
				</div>

				<!-- clones -->
				<div class="clones"></div>

				<!-- button -->
				<button class="btn btn-default add-clone">
					Добавить модификацию
				</button>
			</div>

			<!-- Is New(Новизна) -->
			<div class="form-group ad-check">
				<div class="field-header">
					<label>Новизна</label>
				</div>
				<label>
					<input type="checkbox"
						class="minimal ad-check-check">
					Новый
					<input type="hidden"
						class="ad-check-text" 
						name="product[is_new]">
				</label>
			</div>

			<!-- Is Recomended(Рекомендация) -->
			<div class="form-group ad-check">
				<div class="field-header">
					<label>Рекомендация</label>
				</div>
				<label>
					<input type="checkbox"
						class="minimal ad-check-check">
					Рекомендован
					<input type="hidden"
						class="ad-check-text" 
						name="product[is_recomended]">
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
						name="product[status]">
				</label>
			</div>

			<!-- Submit -->
			<button class="btn btn-success"
				form="ad-product" 
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