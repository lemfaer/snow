<script type="text/javascript" src="/template/js/masonry.min.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".masonry").masonry({
			itemSelector: ".shop_box",
			singleMode: true,
			isResizable: true,
			isAnimated: true,
			animationOptions: { 
	      queue: false, 
	      duration: 500 
	  	}
		});
	});
</script>

<div class="main">
	<div class="shop_top">
		<div class="container">

			<div style="margin-bottom: 20px">
				<h3 class="m_2" style="margin-bottom: 1%">
					<?php echo $category->getName(); ?>
				</h3>

				<?php 
					while(!($category instanceof NullCategory)) {
						$breadcrumb[$category->link()] = $category->getName();
						$category = $category->getParent();
					}
					$bcFirstName = array_shift($breadcrumb);
				?>

				<ul class="breadcrumb" style="margin-bottom: 0">
					<li><a href="/category">Все категории</a></li>
					<?php foreach($breadcrumb as $key => $value): ?>
						<li><a href="<?php echo $key; ?>">
							<?php echo $value; ?>
						</a></li>
					<?php endforeach; ?>
					<li class="active"><?php echo $bcFirstName ?></li>
				</ul>
			</div>

			<div class="row shop_box-top masonry">

				<?php foreach($productList as $product): ?>
					<?php $isNew     = $product->isNew(); ?>
					<?php $price     = '$'.$product->getPrice(); ?>
					<?php $image     = $product->getImage()->link(); ?> 
					<?php $link      = "/product/".$product->getID(); ?>
					<?php $shortDesc = $product->getShortDescription(); ?>
					<?php $name      = $product->getProducer()->getName()
						.' '.$product->getName()
						.' '.$product->getYear(); ?>

					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 shop_box" style="float: left">
						<a href="<?= $link; ?>">

							<img src="<?= $image; ?>" class="img-responsive" alt=""/>

							<?php if($isNew): ?>
								<span class="new-box">
									<span class="new-label">New</span>
								</span>
							<?php endif; ?>

							<div class="shop_desc">
								<h3><a href="<?= $link; ?>"><?= $name; ?></a></h3>

								<p><?= $shortDesc; ?></p>

								<span class="actual"><?= $price; ?></span><br>

								<ul class="buttons">
									<li class="shop_btn">
										<a href="<?= $link; ?>">Read More</a>
									</li>
									<div class="clear"> </div>
								</ul>
							</div>
						</a>
					</div>
				<?php endforeach; ?>

			</div>

			<?php echo $pagination->get(); ?>

		</div>
	</div>
</div>