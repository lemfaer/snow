<script type="text/javascript" src="/views/ShopProductView/product-options.js"></script>

<?php 
	$product = $productItem->getProduct();
?>

<div class="main">
	<div class="shop_top">
		<div class="container">
			<div class="row">
				<div class="col-md-9 single_left">
					<div class="single_image">
						<div class="flexslider">
			  				<ul class="slides">
								
								<?php foreach ($productItem->getImageList() as $value): ?>
									<li data-thumb="<?php echo $value->link(); ?>">
										<div class="thumb-image"> 
											<img src="<?php echo $value->link(); ?>" 
												data-imagezoom="true" class="img-responsive"> 
										</div>
									</li>
								<?php endforeach; ?>

							</ul>
						</div>
					</div>
					<div class="single_right">
						<h3>
							<?php echo $product->getProducer()->getName()
								.' '.$product->getName()
								.' '.$product->getYear(); ?>
						</h3>
						<p class="m_10"><?php echo $product->getShortDescription(); ?></p>
				        	
				        	<?php if ($product->isAvailable()): ?>

					        	<?php if (count($productItem->getSizeList()) > 1): ?>
									<ul class="options">
										<h4 class="m_12">Select a Size(cm)</h4>
										<?php foreach ($productItem->getSizeList() as $value): ?>
											<li><a><?php echo $value['size']->getName(); ?></a></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>

								<?php if (count($productItem->getColorList()) > 1): ?>
									<ul class="product-colors">
										<h3>available Colors</h3>
										<?php foreach ($productItem->getColorList() as $value): ?>
											<li><a>
												<span style="background: 
													<?php echo $value['color']->getValue(); ?>
												"></span>
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
								<button type="button" class="btn1 btn1-default1 btn1-twitter" onclick="">
					            	<i class="icon-twitter"></i> Tweet
					            </button>
					            <button type="button" class="btn1 btn1-default1 btn1-facebook" onclick="">
					            	<i class="icon-facebook"></i> Share
					            </button>
					             <button type="button" class="btn1 btn1-default1 btn1-google" onclick="">
					            	<i class="icon-google"></i> Google+
					            </button>
					            <button type="button" class="btn1 btn1-default1 btn1-pinterest" onclick="">
					            	<i class="icon-pinterest"></i> Pinterest
					            </button>
					        </div>
				        </div>
				        <div class="clear"> </div>
					</div>

				<?php if ($product->isAvailable()): ?>	
					<div class="col-md-3">
						<div class="box-info-product">
							<p class="price2">$<?php echo $product->getPrice(); ?></p>

							<form class="product-options">
								
								<?php if (count($productItem->getColorList()) > 1): ?>
									<ul class="op-group" op-name="color">

										<?php foreach ($productItem->getColorList() as $value): ?>
											<?php $value['size_id'] = implode(",", $value['size_id']); ?>
											<li class="op-li">
												<input type="radio" 
													class="op-radio" 
													name="op-color" 
													id="op-color-<?php echo $value['color']->getID(); ?>"
													value="<?php echo $value['color']->getID(); ?>"
													fgn-name="size"
													fgn-id="<?php echo $value['size_id']; ?>">
												<label class="op-label" 
													for="op-color-<?php echo $value['color']->getID(); ?>">
													<span class="op-color"
														style="background: 
															<?php echo $value['color']->getValue(); ?>">
													</span>
												</label>
											</li>
										<?php endforeach; ?>

									</ul>								
								<?php endif; ?>
								
								<?php if (count($productItem->getSizeList()) > 1): ?>
									<ul class="op-group" op-name="size">

										<?php foreach ($productItem->getSizeList() as $value): ?>
											<?php $value['color_id'] = implode(",", $value['color_id']); ?>
											<li class="op-li">
												<input type="radio" 
													class="op-radio" 
													name="op-size" 
													id="op-size-<?php echo $value['size']->getID(); ?>"
													value="<?php echo $value['size']->getID(); ?>"
													fgn-name="color"
													fgn-id="<?php echo $value['color_id']; ?>">
												<label class="op-label" 
													for="op-size-<?php echo $value['size']->getID(); ?>">
													<span class="op-text">
														<?php echo $value['size']->getName(); ?>
													</span>
												</label>
											</li>
										<?php endforeach ?>

									</ul>
								<?php endif; ?>

								<button type="submit" name="Submit" class="exclusive">
									<span>Add to cart</span>
								</button>
							</form>
						</div>
					</div>
				<?php endif; ?>
				
			</div>

			<?php if ($product->getDescription()): ?>
				<div class="desc">
					<h4>Description</h4>
					<p><?php echo $product->getDescription(); ?></p>
				</div>				
			<?php endif ?>

			<?php if ($productItem->getCharList()): ?>
				<div class="product-specifications">
					<h4>Characteristics</h4>
					<ul>
						<?php foreach ($productItem->getCharList() as $value): ?>
							<li>
								<span class="specification-heading">
									<?php echo $value->getName()->getName(); ?>
								</span>
								<span>
									<?php echo $value->getValue()->getValue(); ?>
								</span>
								<div class="clear"></div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif ?>

			<div class="row">
				<h4 class="m_11">Related Products //in the same Category</h4>
				
				<?php foreach ($recomendedList as $value): ?>
					<div class="col-md-4 product1">
						<img src="<?php echo $value->getImage()->link(); ?>" class="img-responsive" alt=""/> 
						<div class="shop_desc">
							<a href="/product/<?php echo $value->getID(); ?>"></a>
							<h3>
								<a href="/product/<?php echo $value->getID(); ?>"></a>
								<a href="/product/<?php echo $value->getID(); ?>">
									<?php echo $value->getProducer()->getName()
									.' '.$value->getName()
									.' '.$value->getYear(); ?>
								</a>
							</h3>
							<p><?php echo $value->getShortDescription(); ?></p>
							<span class="actual">$<?php echo $value->getPrice(); ?></span><br>
							<ul class="buttons">
								<li class="shop_btn">
									<a href="/product/<?php echo $value->getID(); ?>">Read More</a>
								</li>
								<div class="clear"> </div>
							</ul>
						</div>
					</div>
				<?php endforeach; ?>
				
			</div>

		</div>
	</div>
</div>