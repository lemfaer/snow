<!-- REQUIRED -->
	<!-- $cart -->
<!-- REQUIRED END -->

<?php foreach ($cart as $one): ?>
	<?php $product = $one['available']->getProduct(); ?>
	<?php $count   = $one['count']; ?>

	<?php $price = '$'.$product->getPrice(); ?>
	<?php $image = $product->getImage()->link(); ?>
	<?php $link  = "/product/".$product->getID(); ?>
	<?php $name  = $product->getProducer()->getName()
		." ".$product->getName()." ".$product->getYear(); ?>

	<li>
		<div class="list_img">
			<div>
				<img src=<?= $image; ?> alt=""/>
			</div>
		</div>
		<div class="list_desc">
			<h4><a href="<?= $link; ?>"><?= $name; ?></a></h4>
			<div>
				<font class="mc-price"><?= $price; ?></font>
				<?php if ($count > 1): ?>
					<font class="mc-price">x</font>
					<font class="mc-price"><?= $count; ?></font>
				<?php endif; ?>
			</div>
		</div>
	</li>
<?php endforeach; ?>