<script type="text/javascript" src="/template/js/jquery.flexisel.js"></script>
<script type="text/javascript" src="/template/js/masonry.min.js"></script>

<script type="text/javascript">document.title = "Главная"</script>

<?php 
	$bannerCount = 6;

	$quoteArr = array(
		"this is <br> happiness",
		"<i>the mountains</i> <br> are calling",
		"just <br> snowboard",
		"go play <br> outside",
		"ride it",
		"it's time to dig another one"
	);
	shuffle($quoteArr);

	$bannerArr = array();
	for ($i = 1; $i <= $bannerCount; $i++) { 
		$bannerArr[$i]['path']  = "/template/images/banners/$i.jpeg";
		$bannerArr[$i]['quote'] = array_shift($quoteArr);
	}

	shuffle($bannerArr);
 ?>

<script type="text/javascript">
	$(window).load(function() {
		$("#flexiselDemo3").flexisel({
			visibleItems: 3,
			animationSpeed: 1000,
			autoPlay: true,
			autoPlaySpeed: 3000,    		
			pauseOnHover: true,
			enableResponsiveBreakpoints: true,
			responsiveBreakpoints: { 
				portrait: { 
					changePoint: 480,
					visibleItems: 1
				}, 
				landscape: { 
					changePoint: 640,
					visibleItems: 2
				},
				tablet: { 
					changePoint: 768,
					visibleItems: 3
				}
			}
		});
	});
</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		var settings = {
			itemSelector: ".shop_box",
			singleMode: true,
			isResizable: true,
			isAnimated: true,
			animationOptions: { 
				queue: false, 
				duration: 500 
			}
		};

		$('img').load(function(){
            $(".masonry").masonry(settings);
        });
		$(".masonry").masonry(settings);
	});
</script>

<div class="banner">
	<div id="fwslider">
		<div class="slider_container">
			<?php foreach ($bannerArr as $banner): ?>
				<?php $path  = $banner['path']; ?>
				<?php $quote = $banner['quote']; ?>

				<div class="slide"> 
					<img src="<?= $path; ?>" class="img-responsive" alt=""/>
					<div class="slide_content">
						<div class="slide_content_wrap">
							<h1 class="title"><?= $quote; ?></h1>
						</div>
					</div>
				</div>
			<?php endforeach ?>
        </div>

		<div class="timers"></div>
		<div class="slidePrev"><span></span></div>
		<div class="slideNext"><span></span></div>
	</div>
</div>

<style type="text/css">
	.nbs-flexisel-item img {
		max-width: 5000px;
		max-height: 5000px;
	}
</style>

<div class="main">
	<div class="content-top">
		<h2>Новинки</h2>
		<ul id="flexiselDemo3">
			<?php foreach ($newList as $product): ?>
				<?php $id    = $product->getID(); ?>
				<?php $link  = "/product/$id"; ?>
				<?php $image = $product->getImage()->link(); ?>
				<li>
					<img src="<?= $image; ?>" 
						onclick="window.location.href = '<?= $link; ?>'">
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="content-bottom">
		<div class="container">
			<div class="row content_bottom-text">
				<div class="col-md-7">
					<h3>Freeride</h3>
					<p class="m_1">Фрира́йд (англ. freeride) — катание на сноуборде или горных лыжах вне подготовленных трасс и, как правило, вне области обслуживания горнолыжной индустрии. Считается, что именно при катании по нетронутому снегу наиболее полно раскрываются все возможности сноуборда и горных лыж. Вместе с тем, фрирайдовое катание сулит и немало опасностей, связанных с незнакомой местностью, например возможностью схода лавин. </p>
					<p class="m_2">По мнению ряда специалистов, новичкам в сноубординге и лыжах не следует торопиться с выходом за пределы трассы в горах, для этого следует уже иметь определённые навыки владения техникой катания. На протяжении последних лет ежегодно проводятся международные соревнования по фрирайду среди профессионалов и любителей. </p>
				</div>
			</div>
		</div>
	</div>

	<div class="features">
		<div class="container">
			<h3 class="m_3">Рекомендованное</h3>

			<div class="row masonry">
				<?php foreach($recomendedList as $product): ?>
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
										<a href="<?= $link; ?>">купить</a>
									</li>
									<div class="clear"> </div>
								</ul>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>