<!-- REQUIRED -->
	<!-- $productItem -->
<!-- REQUIRED END -->

<?php $id        = $productItem->getProduct()->getID(); ?>
<?php $sizeList  = $productItem->getSizeList(); ?>
<?php $colorList = $productItem->getColorList(); ?>

<script type="text/javascript" src="/views/shop/product/product-options.js"></script>

<form class="product-options">
								
	<input type="hidden"
		id="op-product-id"
		value="<?= $id; ?>">

	<?php if (count($colorList) > 1): ?>
		<ul class="op-group" op-name="color">

			<?php foreach ($colorList as $value): ?>
				<?php $color       = $value['color']; ?>
				<?php $colorID     = $color->getID(); ?>
				<?php $colorValue  = $color->getValue(); ?>
				<?php $sizeIDs     = implode(",", $value['size_id']); ?>

				<li class="op-li">
					<input type="radio" 
						class="op-radio" 
						name="op-color" 
						id="op-color-<?= $colorID; ?>"
						value="<?= $colorID; ?>"
						fgn-name="size"
						fgn-id="<?= $sizeIDs; ?>">
					<label class="op-label" 
						for="op-color-<?= $colorID; ?>">
						<span class="op-color" style="background: <?= $colorValue; ?>;"></span>
					</label>
				</li>
			<?php endforeach; ?>

		</ul>								
	<?php endif; ?>
								
	<?php if (count($sizeList) > 1): ?>
		<ul class="op-group" op-name="size">

			<?php foreach ($sizeList as $value): ?>
				<?php $size     = $value['size']; ?>
				<?php $sizeID   = $size->getID(); ?>
				<?php $sizeName = $size->getName(); ?>
				<?php $colorIDs = implode(",", $value['color_id']); ?>

				<li class="op-li">
					<input type="radio" 
						class="op-radio" 
						name="op-size" 
						id="op-size-<?= $sizeID; ?>"
						value="<?= $sizeID; ?>"
						fgn-name="color"
						fgn-id="<?= $colorIDs; ?>">
					<label class="op-label" 
						for="op-size-<?= $sizeID; ?>">
						<span class="op-text">
							<?= $sizeName; ?>
						</span>
					</label>
				</li>
			<?php endforeach; ?>

		</ul>
	<?php endif; ?>

	<button type="submit" name="Submit" class="exclusive">
		<span>В Корзину</span>
	</button>

</form>