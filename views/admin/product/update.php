<!-- REQUIRED -->
	<!-- $product -->
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

<!-- SCRIPTS END -->
	<script type="text/javascript" src="/views/admin/crup.js"></script>

	<script type="text/javascript" src="/views/admin/select.js"></script>
	<script type="text/javascript" src="/views/admin/observer.js"></script>
	<script type="text/javascript" src="/views/admin/clone.js"></script>
	<script type="text/javascript" src="/views/admin/image.js"></script>
	<script type="text/javascript" src="/views/admin/inherits.js"></script>

	<script type="text/javascript" src="/views/admin/product/colors.js"></script>
	<script type="text/javascript" src="/views/admin/product/names.js"></script>
	<script type="text/javascript" src="/views/admin/product/producers.js"></script>
	<script type="text/javascript" src="/views/admin/product/sizes.js"></script>
	<script type="text/javascript" src="/views/admin/product/values.js"></script>
<!-- SCRIPTS END -->

<!-- SETTINGS -->
	<script type="text/javascript">crup.name = "product";</script>
<!-- SETTINGS END -->

<?php $charList      = $product->getCharList(); ?>
<?php $imageList     = $product->getImageList(); ?>
<?php $availableList = $product->getAvailableList(); ?>

<?php $product  = $product->getProduct(); ?>

<?php $id         = $product->getID(); ?>
<?php $new        = $product->isNew(); ?>
<?php $name       = $product->getName(); ?>
<?php $year       = $product->getYear(); ?>
<?php $price      = $product->getPrice(); ?>
<?php $status     = $product->getStatus(); ?>
<?php $rec        = $product->isRecomended(); ?>
<?php $desc       = $product->getDescription(); ?>
<?php $short      = $product->getShortDescription(); ?>
<?php $producerID = $product->getProducer()->getID(); ?>

<?php $category   = $product->getCategory(); ?>
<?php $categoryID = $category->getID(); ?>
<?php $parentID   = $category->getParent()->getID(); ?>

<?php $yearMin = (int)date("Y", 0); ?>
<?php $yearMax = (int)date("Y"); ?>

<section class="content-header">
	<h1>
		Product Update
		<small>Редактирование записи в таблице Product</small>
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
			
			<!-- ID -->
			<div class="form-group id">
				<input type="hidden"
					name="product[id]"
					value="<?= $id; ?>">
			</div>

			<!-- Parent(Категория) -->
			<div class="form-group">
				<div class="field-header">
					<label>Категория</label>
				</div>
				<select id="ad-product-parent" 
					class="form-control select2 update"
					required
					disabled
					data-id="<?= $parentID; ?>"
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-product-parent">
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
				<select name="product[category]" 
					id="ad-product-category" 
					class="form-control select2 update"
					required
					disabled 
					data-id="<?= $categoryID; ?>"
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-product-category">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Producer(Изготовитель) -->
			<div class="form-group">
				<div class="field-header">
					<label>Изготовитель</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<select id="ad-product-producer"
					name="product[producer]" 
					class="form-control select2 update"
					required
					disabled
					data-id="<?= $producerID; ?>"
					style="width: 100%;">
					<option></option>
				</select>
				<label class="control-label" for="ad-product-producer">
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
					name="product[name]"
					id="ad-product-name" 
					class="form-control" 
					placeholder="Введите название"
					value="<?= $name; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-product-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Price(Цена) -->
			<div class="form-group">
				<div class="field-header">
					<label>Цена</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="number" 
					name="product[price]"
					id="ad-product-price" 
					class="form-control" 
					placeholder="Введите цену"
					value="<?= $price; ?>" 
					required
					disabled
					min="1">
				<label class="control-label" for="ad-product-price">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Year(Год выпуска) -->
			<div class="form-group">
				<div class="field-header">
					<label>Год выпуска</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<input type="number" 
					name="product[year]"
					id="ad-product-year" 
					class="form-control" 
					placeholder="Введите год выпуска"
					value="<?= $year; ?>"
					required
					disabled
					min="<?= $yearMin; ?>"
					max="<?= $yearMax; ?>">
				<label class="control-label" for="ad-product-year">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Short Description(Краткое описание) -->
			<div class="form-group">
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						var textarea = <?= json_encode($short); ?>;
						$("#ad-product-short_description").val(textarea);
					});
				</script>
				<div class="field-header">
					<label>Краткое описание</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<textarea 
					name="product[short_description]"
					id="ad-product-short_description"
					class="form-control"
					placeholder="Введите краткое описание"
					required
					disabled
					rows="2"
					style="max-width: 100%;"></textarea>
				<label class="control-label" for="ad-product-short_description">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Description(Описание) -->
			<div class="form-group">
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						var textarea = <?= json_encode($desc); ?>;;
						$("#ad-product-description").val(textarea);
					});
				</script>
				<div class="field-header">
					<label>Описание</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<textarea 
					name="product[description]"
					id="ad-product-description"
					class="form-control"
					placeholder="Введите описание"
					required
					disabled
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

				<!-- clones -->
				<div class="clones">
					<div class="row">
						<?php $i = 1; ?>
						<?php foreach ($imageList as $im): ?>
							<?php $link    = $im->link(); ?>
							<?php $imageID = $im->getID(); ?>

							<div class="clone col-lg-4 col-md-4 col-sm-6 col-xs-12" this="<?= $i; ?>">
								<div class="form-group">
									<input type="hidden"
										name="product[image_id][image_id_<?= $i; ?>]"
										value="<?= $imageID; ?>">
									<div class="input-group">
										<img src="<?= $link; ?>" class="image-view">
										<button class="btn btn-danger btn-flat image-remove remove-clone">
											<i class="fa fa-remove"></i>
										</button>
									</div>
								</div>
							</div>

							<?php $i++; ?>
						<?php endforeach ?>
					</div>
				</div>

				<!-- sample -->
				<div class="sample row" next="<?= $i; ?>">
					<div class="form-group image col-lg-12 col-md-12 col-sm-12 vol-xs-12">
						<div class="input-group">
							<input type="file"
								name="product[image][image_0]"
								id="ad-product-image_0" 
								class="form-control image"
								required
								disabled>
							<span class="input-group-btn">
								<button class="btn btn-danger btn-flat remove-clone-lazy">
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

				<!-- clones -->
				<div class="clones">
					<?php $i = 1; ?>
					<?php foreach ($charList as $cvalue): ?>
						<?php $valueID = $cvalue->getID(); ?>
						<?php $nameID  = $cvalue->getName()->getID(); ?>

						<div class="clone row" this="<?= $i; ?>">
							<!-- ID -->
							<div class="form-group id">
								<input type="hidden"
									id="ad-product-char_id_<?= $i; ?>"
									name="product[char_value][char_value_<?= $i; ?>]"
									value="<?= $valueID; ?>">
							</div>
							<!-- Name -->
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<select id="ad-product-char_name_<?= $i; ?>"
									name="product[char_name][char_name_<?= $i; ?>]" 
									class="form-control select2 update"
									required
									disabled
									data-id="<?= $nameID; ?>"
									style="width: 100%;">
									<option></option>
								</select>
								<label class="control-label" 
									for="ad-product-char_name_<?= $i; ?>">
									<i class="ico fa fa-check"></i> 
									<font class="message">Ошибка</font>
								</label>
							</div>
							<!-- Value -->
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
								<div class="input-group">
									<select id="ad-product-char_value_<?= $i; ?>"
										name="product[char_value][char_value_<?= $i; ?>]"
										class="form-control select2 update"
										data-id="<?= $valueID; ?>"
										required
										disabled
										style="width: 100%;">
										<option></option>
									</select>
									<span class="input-group-btn">
										<button class="btn btn-primary btn-flat update-clone remove">
											<i class="fa fa-pencil"></i>
										</button>
									</span>
								</div>
								<label class="control-label" 
									for="ad-product-char_value_<?= $i; ?>">
									<i class="ico fa fa-check"></i> 
									<font class="message">Ошибка</font>
								</label>
							</div>
						</div>

						<?php $i++; ?>
					<?php endforeach ?>
				</div>

				<!-- sample -->
				<div class="sample row" next="<?= $i; ?>">
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
								<button class="btn btn-danger btn-flat remove-clone-lazy">
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

				<!-- clones -->
				<div class="clones">
					<?php $i = 1; ?>
					<?php foreach ($availableList as $av): ?>
						<?php $avID    = $av->getID(); ?>
						<?php $count   = $av->getCount(); ?>
						<?php $sizeID  = $av->getSize()->getID(); ?>
						<?php $colorID = $av->getColor()->getID(); ?>

						<div class="clone row" this="<?= $i; ?>">
							<!-- ID -->
							<div class="form-group id">
								<input type="hidden"
									id="ad-product-available_id_<?= $i; ?>"
									name="product[available_id][available_id_<?= $i; ?>]"
									value="<?= $avID; ?>">
							</div>
							<!-- Color -->
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
								<select id="ad-product-color_<?= $i; ?>"
									name="product[color][color_<?= $i; ?>]"
									class="form-control select2 update"
									required
									disabled
									data-id="<?= $colorID; ?>"
									style="width: 100%;">
									<option></option>
								</select>
								<label class="control-label" for="ad-product-color_<?= $i; ?>">
									<i class="ico fa fa-check"></i> 
									<font class="message">Ошибка</font>
								</label>
							</div>
							<!-- Size -->
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
								<select id="ad-product-size_<?= $i; ?>" 
									name="product[size][size_<?= $i; ?>]"
									class="form-control select2 update"
									required
									disabled
									data-id="<?= $sizeID; ?>"
									style="width: 100%;">
									<option></option>
								</select>
								<label class="control-label" for="ad-product-size_<?= $i; ?>">
									<i class="ico fa fa-check"></i> 
									<font class="message">Ошибка</font>
								</label>
							</div>
							<!-- Count -->
							<div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4">
								<script type="text/javascript">
									jQuery(document).ready(function($) {
										$("#ad-product-count_<?= $i; ?>").trigger("focusout");
									});
								</script>
								<div class="input-group">
									<input type="number" 
										name="product[count][count_<?= $i; ?>]"
										id="ad-product-count_<?= $i; ?>" 
										class="form-control" 
										placeholder="Введите количество"
										value="<?= $count; ?>"
										required
										disabled
										min="0"
										max="999">
									<span class="input-group-btn">
										<button class="btn btn-primary btn-flat update-clone">
											<i class="fa fa-pencil"></i>
										</button>
									</span>
								</div>
								<label class="control-label" for="ad-product-count_<?= $i; ?>">
									<i class="ico fa fa-check"></i> 
									<font class="message">Ошибка</font>
								</label>
							</div>
						</div>

						<?php $i++; ?>
					<?php endforeach; ?>
				</div>

				<!-- sample -->
				<div class="sample row" next="<?= $i; ?>">
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
								<button class="btn btn-danger btn-flat remove-clone-lazy">
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
						class="minimal ad-check-check"
						<?= ($new) ? ("checked") : (null) ?>>
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
						class="minimal ad-check-check"
						<?= ($rec) ? ("checked") : (null) ?>>
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
						<?= ($status) ? ("checked") : (null) ?>>
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