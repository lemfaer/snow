<!-- REQUIRE -->
	<!-- $producer -->
<!-- REQUIRE END -->

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

<script type="text/javascript" src="/views/admin/image.js"></script>
<script type="text/javascript" src="/views/admin/crup.js"></script>
<script type="text/javascript">crup.name = "producer";</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".form-control.image").hide();
	});
</script>

<?php $id     = $producer->getID(); ?>
<?php $name   = $producer->getName(); ?>
<?php $image  = $producer->getImage()->link(); ?>
<?php $status = $producer->getStatus(); ?>

<section class="content-header">
	<h1>
		Producer Update
		<small>Редактирование записи в таблице Producer</small>
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

			<!-- ID -->
			<div class="form-group id">
				<input type="hidden"
					name="producer[id]"
					value="<?= $id; ?>">
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
					name="producer[name]"
					id="ad-producer-name" 
					class="form-control" 
					placeholder="Введите имя"
					value="<?= $name; ?>" 
					required
					disabled>
				<label class="control-label" for="ad-producer-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Image(Логотип) -->
			<div class="form-group image">
				<div class="field-header">
					<label>Логотип</label>
					<a class="ad_update">
						<i class="up_ico fa fa-edit"></i>
						<font class="up_message">Изменить</font>
					</a>
				</div>
				<div class="row">
					<div class="col-lg-7 col-md-7 col-sm-9 col-xs-12">
						<img src="<?= $image; ?>" class="image-view">
					</div>
				</div>
				<input type="file"
					name="producer[image]"
					id="ad-producer-image" 
					class="form-control image"
					required
					disabled>
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
						<?= ($status) ? ("checked") : (null) ?>>
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