<!-- REQUIRED -->
	<!-- $indent -->
<!-- REQUIRED END -->

<!-- PLUGINS -->
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/template/iCheck/all.css">
	<script src="/template/iCheck/icheck.min.js"></script>

	<!-- Select2 -->
	<link rel="stylesheet" href="/template/css/select2.min.css">
	<script src="/template/js/select2.full.min.js"></script>

	<!-- Row Equal Height -->
	<link rel="stylesheet" type="text/css" href="/template/css/row-eq-size.css" />

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
	<script type="text/javascript">crup.name = "indent";</script>
<!-- SETTINGS END -->

<?php $item = $indent; ?>

<?php $indent  = $item->getIndent(); ?>
<?php $contact = $indent->getContact(); ?>
<?php $state   = $indent->getState(); ?>

<?php $cargoList = $item->getCargoList(); ?>
<?php $total     = '$'.$item->total(); ?>

<?php $id     = $indent->getID(); ?>
<?php $status = $indent->getStatus(); ?>

<?php $name    = $contact->getName(); ?>
<?php $phone   = $contact->getPhone(); ?>
<?php $address = $contact->getAddress(); ?>

<?php $userID  = !($contact->getUser() instanceof Anonymous) 
	? ($contact->getUser()->getID()) 
	: (null); ?>

<section class="content-header">
	<h1>
		Indent Update
		<small>Редактирование записи в таблице Indent</small>
	</h1>
</section>

<section class="content">
<div class="row">
<div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
	<div class="box box-default">

		<div class="box-header with-border">
			<h3 class="box-title">Indent</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-box-tool ad-read-link" data-widget="remove">
					<i class="fa fa-remove"></i>
				</button>
			</div>
		</div>

		<div class="box-body">
		<form id="ad-indent" action="/admin/indent/crup/submit" method="post">
			
			<!-- ID -->
			<div class="form-group id">
				<input type="hidden"
					name="indent[id]"
					value="<?= $id; ?>">
			</div>

			<!-- Name(Название) -->
			<div class="form-group">
				<div class="field-header">
					<label>Название</label>
				</div>
				<input type="text" 
					id="ad-indent-contact-name" 
					class="form-control" 
					placeholder="Введите название"
					value="<?= $name; ?>" 
					readonly>
				<label class="control-label" for="ad-indent-contact-name">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Phone(Телефон) -->
			<div class="form-group">
				<div class="field-header">
					<label>Телефон</label>
				</div>
				<input type="text"
					id="ad-indent-contact-phone" 
					class="form-control" 
					placeholder="Введите название"
					value="<?= $phone; ?>" 
					readonly>
				<label class="control-label" for="ad-indent-contact-phone">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Address(Адрес) -->
			<div class="form-group">
				<div class="field-header">
					<label>Адрес</label>
				</div>
				<input type="text"
					id="ad-indent-contact-address" 
					class="form-control" 
					placeholder="Введите название"
					value="<?= $address; ?>" 
					readonly>
				<label class="control-label" for="ad-indent-contact-address">
					<i class="ico fa fa-check"></i> 
					<font class="message">Ошибка</font>
				</label>
			</div>

			<!-- Cargos(Товары) -->
			<div class="form-group">
				<div class="field-header" style="border-bottom: 1px solid #ECECEC;">
					<label>Товары</label>
				</div>

				<?php foreach ($cargoList as $cargo): ?>
					<?php $count = $cargo->getCount(); ?>
					<?php $av    = $cargo->getAvailable(); ?>
					<?php $subTotal = '$'.$cargo->subTotal(); ?>

					<?php $size    = $av->getSize(); ?>
					<?php $color   = $av->getColor(); ?>
					<?php $product = $av->getProduct(); ?>					

					<?php $sName = $size->getName(); ?>
					<?php $cName = $color->getName(); ?>

					<?php $price = '$'.$product->getPrice(); ?>
					<?php $image = $product->getImage()->link(); ?>
					<?php $link  = "/product/".$product->getID(); ?>
					<?php $full = $product->getProducer()->getName()
						." ".$product->getName()." ".$product->getYear(); ?>

					<div class="row row-eq-height cart-item">
						<div class="col-md-3 pr-image">
							<img src="<?= $image; ?>" alt="">
						</div>
						<div class="col-md-6 pr-info">
							<ul class="qty">
								<li class="name">
									<a href="<?= $link; ?>"><?= $full; ?></a>
								</li>
								<li><p>Цвет : <?= $cName; ?></p></li>
								<li><p>Размер : <?= $sName; ?></p></li>
								<li class="price">
									<p>Цена за 1 : <?= $price; ?></p>
								</li>
								<li class="price subtotal">
									<p>Промежуточная цена :
										<font id="subtotal"><?= $subTotal; ?></font>
									</p>
								</li>
							</ul>
						</div>
						<div class="col-md-2 pr-qty">
							<div class="qty-field">
								<input type="text" value="<?= $count; ?>" readonly>
							</div>
						</div>
					</div>
				<?php endforeach ?>

				<div class="field-header" style="float: right;">
					<label>Сумма: <?= $total; ?></label>
				</div>
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
						name="indent[status]">
				</label>
			</div>

			<!-- Submit -->
			<button class="btn btn-success"
				form="ad-indent" 
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