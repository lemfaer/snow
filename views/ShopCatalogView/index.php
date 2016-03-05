<div class="main">
	<div class="shop_top">
		<div class="container" style="width: 70%">

			<?php $productList = array_chunk($productList, 3); ?>

			<div style="margin-bottom: 20px">
				<h3 class="m_2" style="margin-bottom: 1%">
					<?php echo $category->getName(); ?>
				</h3>

				<?php 
					while($category) {
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

			<?php foreach ($productList as $value) :?>
				<div class="row shop_box-top">

					<?php foreach($value as $product): ?>
						<div class="col-md-4 shop_box">
							<a href="/product/<?php echo $product->getID(); ?>">
								<img src="<?php echo $product->getImage() ?>" class="img-responsive" alt=""/>
								<?php if($product->isNew()): ?>
									<span class="new-box">
										<span class="new-label">New</span>
									</span>
								<?php endif; ?>
								<div class="shop_desc">
									<h3><a href="/product/<?php echo $product->getID(); ?>">
										<?php echo $product->getProducer()->getName()
											.' '.$product->getName()
											.' '.$product->getYear(); ?>
									</a></h3>
									<p><?php echo $product->getShortDescription(); ?></p>
									<span class="actual">
										$<?php echo $product->getPrice(); ?>
									</span><br>
									<ul class="buttons">
										<li class="shop_btn">
											<a href="/product/<?php echo $product->getID(); ?>">
												Read More
											</a>
										</li>
										<div class="clear"> </div>
									</ul>
								</div>
							</a>
						</div>
					<?php endforeach; ?>

				</div>
			<?php endforeach; ?>

			<?php echo $pagination->get(); ?>

		</div>
	</div>
</div>