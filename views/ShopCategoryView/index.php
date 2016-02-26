<div class="main">
	<div class="shop_top">
		<div class="container">

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

			<?php $categoryList = array_chunk($categoryList, 3); ?>

			<?php foreach($categoryList as $value): ?>
				<div class="row ex_box">

					<?php foreach($value as $category): ?>
						<div class="col-md-4 team1">
							<div class="img_section magnifier2">
								<a class="fancybox" 
									href="<?php echo $_SERVER['REQUEST_URI'].'/'.$category['short_name']; ?>"
									data-fancybox-group="gallery">
									<img src="<?php echo $category['image']; ?>" class="img-responsive" alt="">
									<span> </span>
									<div class="img_section_txt">
										<?php echo $category['name']; ?>
									</div>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
					
			    </div>
			<?php endforeach; ?>

		</div>
	</div>
</div>