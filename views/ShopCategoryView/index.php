<div class="main">
	<div class="shop_top">
		<div class="container">

			<div style="margin-bottom: 20px">
				<h3 class="m_2" style="margin-bottom: 1%">
					<?php echo ($category) ? ($category->getName()) : ("Категории"); ?>
				</h3>
				
				<?php if($category): ?>
					<?php 
						while($category) {
							$breadcrumb[$category->link()] = $category->getName();
							$category = $category->getParent();
						}
						$bcFirstName = array_shift($breadcrumb);
					?>
					<ul class="breadcrumb" style="margin-bottom: 0">
						<li><a href="/category">Все категории</a></li>
						<?php foreach(array_reverse($breadcrumb) as $key => $value): ?>
							<li><a href="<?php echo $key ?>"><?php echo $value ?></a></li>
						<?php endforeach; ?>
						<li class="active"><?php echo $bcFirstName; ?></li>
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
									href="<?php echo $_SERVER['REQUEST_URI'].'/'.$category->getShortName(); ?>"
									data-fancybox-group="gallery">
									<img src="<?php echo $category->getImage()->link(); ?>" class="img-responsive" alt="">
									<span> </span>
									<div class="img_section_txt">
										<?php echo $category->getName(); ?>
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