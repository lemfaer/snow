
<?php $product = $one['available']->getProduct(); ?>
<?php $count   = $one['count']; ?>

<?php $price = '$'.$product->getPrice(); ?>
<?php $image = $product->getImage()->link(); ?>
<?php $name  = $product->getProducer()->getName()." ".$product->getName()." ".$product->getYear(); ?>

<li>
	<div class="list_img">
		<img src=<?= $image ?> alt=""/>
	</div>
	<div class="list_desc">
		<h4><a href="#"><?= $name; ?></a></h4>
		<div>
			<font class="actual"><?= $price; ?></font>
			<?php if ($count): ?>
				<font>x</font>
				<font><?= $count; ?></font>
			<?php endif ?>
		</div>
	</div>
</li>