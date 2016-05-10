<!-- REQUIRED -->
	<!-- $category -->
	<!-- $categoryList -->
<!-- REQUIRED END -->

<div class="main">
<div class="shop_top">
<div class="container">

<?php $pageName = !($category instanceof NullCategory) 
			? ($category->getName()) 
			: ("Категории"); ?>

<script type="text/javascript">document.title = "<?= $pageName; ?>";</script>

<div style="margin-bottom: 20px">
	<h3 class="m_2" style="margin-bottom: 1%">
		<?= !($category instanceof NullCategory) 
			? ($category->getName()) 
			: ("Категории"); ?>
	</h3>
	
	<ul class="breadcrumb" style="margin-bottom: 0">
		<?php //breadcrumb
			$bc = array();
			for($c = $category; !($c instanceof NullCategory); $c = $c->getParent()) {
				$bc[$c->link()] = $c->getName();
			}
			$bc = array_reverse($bc);
		?>

		<?php if($bc): ?>
			<li><a href="/category">Все категории</a></li>
		<?php endif ?>

		<?php foreach ($bc as $link => $crumb): ?>
			<li><a href="<?= $link; ?>">
				<?= $crumb; ?>
			</a></li>
		<?php endforeach; ?>

		<script type="text/javascript"> // active bc
			jQuery(document).ready(function($) {
				var li = $(".breadcrumb li:last");
				var a  = $(li).find("a");

				$(li).addClass("active");
				$(li).text($(a).text());
				$(a).remove();
			});
		</script>
	</ul>
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