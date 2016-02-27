<div class="main">
	<div class="shop_top">
		<div class="container">
			<div class="row">
				<div class="col-md-9 single_left">
					<div class="single_image">
						<div class="flexslider">
			  				<ul class="slides">
								<li data-thumb="<?php echo $product['image']; ?>">
									<div class="thumb-image"> 
										<img src="<?php echo $product['image']; ?>" 
											data-imagezoom="true" class="img-responsive"> 
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="single_right">
						<h3>
							<?php echo $product['producer_name']
								.' '.$product['name']
								.' '.$product['year']; ?>
						</h3>
						<p class="m_10"><?php echo $product['short_description']; ?></p>
				        	
				        	<?php if ($product['is_aviable']): ?>

					        	<?php if (count($product['size']) > 1): ?>
									<ul class="options">
										<h4 class="m_12">Select a Size(cm)</h4>
										<?php foreach ($product['size'] as $value): ?>
											<li><a><?php echo $value['name']; ?></a></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>

								<?php if (count($product['color']) > 1): ?>
									<ul class="product-colors">
										<h3>available Colors</h3>
										<?php foreach ($product['color'] as $value): ?>
											<li><a>
												<span style="background: <?php echo $value['value'] ?>"></span>
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
				<div class="col-md-3">
					<div class="box-info-product">
						<p class="price2">$<?php echo $product['price']; ?></p>

						<form>

							<button type="submit" name="Submit" class="exclusive">
								<span>Add to cart</span>
							</button>
						</form>
				   </div>
			   </div>
			</div>

			<?php if (!empty($product['description'])): ?>
				<div class="desc">
					<h4>Description</h4>
					<p><?php echo $product['description']; ?></p>
				</div>				
			<?php endif ?>

			<?php if (!empty($product['char'])): ?>
				<div class="product-specifications">
					<h4>Characteristics</h4>
					<ul>
						<?php foreach ($product['char'] as $value): ?>
							<li>
								<span class="specification-heading">
									<?php echo $value['name']; ?>
								</span>
								<span>
									<?php echo $value['value']; ?>
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
						<img src="<?php echo $value['image'] ?>" class="img-responsive" alt=""/> 
						<div class="shop_desc">
							<a href="/product/<?php echo $value['id']; ?>"></a>
							<h3>
								<a href="/product/<?php echo $value['id']; ?>"></a>
								<a href="/product/<?php echo $value['id']; ?>">
									<?php echo $value['producer_name']
									.' '.$value['name']
									.' '.$value['year']; ?>
								</a>
							</h3>
							<p><?php echo $value['short_description']; ?></p>
							<span class="actual">$<?php echo $value['price'] ?></span><br>
							<ul class="buttons">
								<li class="shop_btn">
									<a href="/product/<?php echo $value['id']; ?>">Read More</a>
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