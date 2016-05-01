<!-- REQUIRED -->
	<!-- $cargoList -->
<!-- REQUIRED END -->

<?php foreach ($cargoList as $cargo): ?>
	<?php $count     = $cargo->getCount(); ?>
	<?php $available = $cargo->getAvailable(); ?>

	<?php $avID    = $available->getID(); ?>
	<?php $avCount = $available->getCount(); ?>

	<?php $size    = $available->getSize(); ?>
	<?php $color   = $available->getColor(); ?>
	<?php $product = $available->getProduct(); ?>

	<?php $sName = !($color instanceof DefaultSize) ? $size->getName() : null; ?>

	<?php $cName  = !($color instanceof DefaultColor) ? $color->getName()  : null; ?>
	<?php $cValue = !($color instanceof DefaultColor) ? $color->getValue() : null; ?>

	<?php $pPrice    = $product->getPrice(); ?>
	<?php $pSubTotal = $pPrice * $count; ?>
	<?php $pPrice    = "$".$pPrice; ?>
	<?php $pSubTotal = "$".$pSubTotal; ?>

	<?php $pImage    = $product->getImage()->link(); ?>
	<?php $pLink     = "/product/".$product->getID(); ?>
	<?php $pName     = $product->getProducer()->getName()
		." ".$product->getName()." ".$product->getYear(); ?>

	<div class="cart">
		<div class="row row-eq-height cart-item" style="width: 100%; margin: 0;">
			<i class="id none"><?= $avID; ?></i>
			<div class="pr-image col-lg-3 col-md-3 col-cm-3 col-xs-3">
				<img src="<?= $pImage; ?>" class="img-responsive" alt=""/>
			</div>
			<div class="pr-info col-lg-6 col-md-6 col-cm-6 col-xs-6">
				<ul class="qty">
					<li class="name">
						<a href="<?= $pLink; ?>"><?= $pName; ?></a>
					</li>
					<?php if ($cName): ?>
						<li><p>Цвет : <?= $cName; ?></p></li>
					<?php endif ?>
					<?php if ($sName): ?>
						<li><p>Размер : <?= $sName; ?></p></li>
					<?php endif ?>
					<li class="price">
						<p>Цена за 1 : <?= $pPrice; ?></p>
					</li>
					<li class="price subtotal">
						<p>Промежуточная цена :
							<font id="subtotal"><?= $pSubTotal; ?></font>
						</p>
					</li>
				</ul>
			</div>
			<div class="pr-qty col-lg-3 col-md-3 col-cm-3 col-xs-3">
				<div class="qty-set qty-field">
					<input 
						type="text" 
						available="<?= $avCount ?>" 
						value="<?= $count; ?>" 
						readonly>
					</input>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	</li>
<?php endforeach ?>