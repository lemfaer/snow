<!-- REQUIRED -->
	<!-- $productItem    -->
	<!-- $recomendedList -->
<!-- REQUIRED END -->

<?php $product   = $productItem->getProduct(); ?>

<?php $charList  = $productItem->getCharList(); ?>
<?php $sizeList  = $productItem->getSizeList(); ?>
<?php $colorList = $productItem->getColorList(); ?>
<?php $imageList = $productItem->getImageList(); ?>

<?php $pAvailable = $product->isAvailable(); ?>
<?php $pPrice     = "$".$product->getPrice(); ?>
<?php $pDesc      = $product->getDescription(); ?>
<?php $pShortDesc = $product->getShortDescription(); ?>
<?php $pName      = $product->getProducer()->getName()
	.' '.$product->getName().' '.$product->getYear(); ?>

<div class="main">
<div class="shop_top">
<div class="container">

<div class="row">
	<div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 single_left">
		<div class="single_image">
			<div class="flexslider">
  				<ul class="slides">
					<?php foreach ($imageList as $image): ?>
						<?php $link = $image->link(); ?>

						<li data-thumb="<?= $link; ?>">
							<div class="thumb-image"> 
								<img src="<?= $link; ?>" 
									data-imagezoom="true" class="img-responsive"> 
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>

		<div class="single_right">
			<h3><?= $pName; ?></h3>
			<p class="m_10"><?= $pShortDesc; ?></p>
				<?php if ($pAvailable): ?>
		        	<?php if (count($sizeList) > 1): ?>
						<ul class="options">
							<h4 class="m_12">Select a Size(cm)</h4>
							<?php foreach ($sizeList as $value): ?>
								<?php $name = $value['size']->getName(); ?>

								<li><a><?= $name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if (count($colorList) > 1): ?>
						<ul class="product-colors">
							<h3>available Colors</h3>
							<?php foreach ($colorList as $value): ?>
								<?php $value = $value['color']->getValue(); ?>

								<li><a>
									<span style="background: <?= $value; ?>"></span>
								</a></li>
							<?php endforeach; ?>
							<div class="clear"> </div>
						</ul>							
					<?php endif; ?>
				<?php endif; ?>

				<ul class="add-to-links">
					<li>
						<img src="/template/images/wish.png" alt="">
						<a href="#">Add to wishlist</a>
					</li>
				</ul>

				<div class="social_buttons">
					<button type="button" 
						class="btn1 btn1-default1 btn1-twitter" onclick="">
						<i class="icon-twitter"></i> Tweet
					</button>
					<button type="button" 
						class="btn1 btn1-default1 btn1-facebook" onclick="">
						<i class="icon-facebook"></i> Share
					</button>
					 <button type="button" 
					 	class="btn1 btn1-default1 btn1-google" onclick="">
						<i class="icon-google"></i> Google+
					</button>
					<button type="button" 
						class="btn1 btn1-default1 btn1-pinterest" onclick="">
						<i class="icon-pinterest"></i> Pinterest
					</button>
				</div>
			</div>
			<div class="clear"> </div>
		</div>

	<?php if ($pAvailable): ?>	
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
			<div class="box-info-product">
				<p class="price2"><?= $pPrice; ?></p>

				<?php View::empty("/shop/product/product-options.php",
					compact("productItem")); ?>
			</div>
		</div>
	<?php endif; ?>
</div>

<?php if ($pDesc): ?>
	<div class="desc">
		<h4>Description</h4>
		<p><?= $pDesc; ?></p>
	</div>				
<?php endif ?>

<?php if ($charList): ?>
	<div class="product-specifications">
		<h4>Characteristics</h4>
		<ul>
			<?php foreach ($charList as $cValue): ?>
				<?php $cName  = $cValue->getName(); ?>
				<?php $name   = $cName->getName(); ?>
				<?php $value  = $cValue->getValue(); ?>
				<li>
					<span class="specification-heading"><?= $name; ?></span>
					<span><?= $value; ?></span>
					<div class="clear"></div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif ?>

<div class="row">
	<h4 class="m_11">Related Products //in the same Category</h4>
	
	<?php foreach ($recomendedList as $rec): ?>
		<?php $price     = '$'.$rec->getPrice(); ?>
		<?php $image     = $rec->getImage()->link(); ?>
		<?php $link      = "/product/".$rec->getID(); ?>
		<?php $shortDesc = $rec->getShortDescription(); ?>
		<?php $name      = $rec->getProducer()->getName()
			.' '.$rec->getName().' '.$rec->getYear(); ?>

		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 product1">
			<img src="<?= $image; ?>" class="img-responsive" alt=""/> 
			<div class="shop_desc">
				<a href="<?= $link; ?>"></a>
				<h3>
					<a href="<?= $link; ?>"></a>
					<a href="<?= $link; ?>"><?= $name; ?></a>
				</h3>
				<p><?= $shortDesc; ?></p>
				<span class="actual"><?= $price; ?></span><br>
				<ul class="buttons">
					<li class="shop_btn"><a href="<?= $link; ?>">Read More</a></li>
					<div class="clear"> </div>
				</ul>
			</div>
		</div>
	<?php endforeach; ?>
</div>

</div>
</div>
</div>