<div class="main">
	<div class="shop_top">
		<div class="container" style="width: 70%">

			<?php $productList = array_chunk($productList, 3); ?>

			<div style="margin-bottom: 20px">
				<h3 class="m_2" style="margin-bottom: 1%">
					<?php echo ($categoryName) ? ($categoryName) : ("Категории"); ?>
				</h3>
				
				<?php if(!empty($breadcrumbArray)): ?>
					<ul class="breadcrumb" style="margin-bottom: 0">
						<li><a href="/category">Все категории</a></li>
						<?php $i = count($breadcrumbArray) - 1; ?>
						<?php foreach($breadcrumbArray as $key => $value): ?>
							<?php if($i): ?>
								<?php $i--; ?>
								<li><a href="<?php echo $value['url']; ?>" class="active">
									<?php echo $value['name']; ?>
								</a></li>
							<?php 
								else: 
									$i = $key;
									break;
								endif;
							?>
						<?php endforeach; ?>
						<li class="active"><?php echo $breadcrumbArray[$i]['name'] ?></li>
					</ul>
				<?php endif; ?>
			</div>

			<?php foreach ($productList as $value) :?>
				<div class="row shop_box-top">

					<?php foreach($value as $product): ?>
						<div class="col-md-4 shop_box">
							<a href="/product/<?php echo $product['id']; ?>">
								<img src="<?php echo $product['image'] ?>" class="img-responsive" alt=""/>
								<?php if($product['is_new']): ?>
									<span class="new-box">
										<span class="new-label">New</span>
									</span>
								<?php endif; ?>
								<div class="shop_desc">
									<h3><a href="/product/<?php echo $product['id']; ?>">
										<?php echo $product['producer_name']
											.' '.$product['name']
											.' '.$product['year']; ?>
									</a></h3>
									<p><?php echo $product['short_description']; ?></p>
									<span class="actual">$<?php echo $product['price']; ?></span><br>
									<ul class="buttons">
										<li class="shop_btn">
											<a href="/product/<?php echo $product['id']; ?>">Read More</a>
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