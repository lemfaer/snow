<div class="main">
	<div class="shop_top">
		<div class="container">

			<div style="margin-bottom: 20px">
				<h3 class="m_2" style="margin-bottom: 1%">
					<?php echo ($category) ? ($category->getName()) : ("Категории"); ?>
				</h3>
				
				<?php if($category): ?>
					<?php 
						while(!($category instanceof NullCategory)) {
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

			<div class="row ex_box">

				<?php foreach($categoryList as $category): ?>
					<?php $name  = $category->getName(); ?>
					<?php $image = $category->getImage()->link(); ?>
					<?php $link  = rtrim($_SERVER['REQUEST_URI'], '/')
						.'/'.$category->getShortName(); ?>
					
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 team1">
						<div class="img_section magnifier2">
							<a class="fancybox" href="<?= $link; ?>" data-fancybox-group="gallery">
								<img src="<?= $image; ?>" class="img-responsive" alt="">
								<span> </span>
								<div class="img_section_txt"><?= $name; ?></div>
							</a>
						</div>
					</div>

				<?php endforeach; ?>
					
			</div>
		</div>
	</div>
</div>