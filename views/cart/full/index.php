<!-- REQUIRED -->
	<!-- $cart -->
<!-- REQUIRED END -->

<script type="text/javascript" src="/views/cart/full/price.js"></script>
<script type="text/javascript" src="/views/cart/full/pr-qty.js"></script>
<script type="text/javascript" src="/views/cart/full/pr-remove.js"></script>

<div class="main">
<div class="check">
<div class="container">
<div class="row">
	
<?php if ($cart): ?>
	<div class="cart col-lg-9 col-md-9 col-sm-9 col-xs-9">
		<h4 class="title">корзина</h4>
		
		<?php foreach ($cart as $value): ?>
			<?php $count     = $value['count']; ?>
			<?php $available = $value['available']; ?>

			<?php $avID    = $available->getID(); ?>
			<?php $avCount = $available->getCount(); ?>

			<?php $size    = $available->getSize(); ?>
			<?php $color   = $available->getColor(); ?>
			<?php $product = $available->getProduct(); ?>

			<?php $sName = !($color instanceof DefaultSize) ? $size->getName() : null; ?>

			<?php $cName  = !($color instanceof DefaultColor) ? $color->getName()  : null; ?>
			<?php $cValue = !($color instanceof DefaultColor) ? $color->getValue() : null; ?>

			<?php $pPrice    = $product->getPrice(); ?>
			<?php $pSubTotal = $pPrice * $count; ?>
			<?php $pPrice    = "$".$pPrice; ?>
			<?php $pSubTotal = "$".$pSubTotal; ?>

			<?php $pImage    = $product->getImage()->link(); ?>
			<?php $pLink     = "/product/".$product->getID(); ?>
			<?php $pName     = $product->getProducer()->getName()
				." ".$product->getName()." ".$product->getYear(); ?>

			<div class="row row-eq-height cart-item">
				<i class="id none"><?= $avID; ?></i>
				<div class="pr-image col-lg-3 col-md-3 col-sm-3 col-xs-3">
					<img src="<?= $pImage; ?>" class="img-responsive" alt=""/>
				</div>
				<div class="pr-info col-lg-6 col-md-6 col-sm-6 col-xs-6">
					<ul class="qty">
						<li class="name">
							<a href="<?= $pLink; ?>"><?= $pName; ?></a>
						</li>
						<?php if ($cName): ?>
							<li><p>Цвет : <?= $cName; ?></p></li>
						<?php endif ?>
						<?php if ($sName): ?>
							<li><p>Размер : <?= $sName; ?></p></li>
						<?php endif ?>
						<li class="price">
							<p>Цена за 1 : <?= $pPrice; ?></p>
						</li>
						<li class="price subtotal">
							<p>Промежуточная цена :
								<font id="subtotal"><?= $pSubTotal; ?></font>
							</p>
						</li>
					</ul>
				</div>
				<div class="pr-qty col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="qty-set">
						<div class="qty-up"><a class="up-icon"></a></div>
						<div class="qty-field">
							<input 
								type="text" 
								available="<?= $avCount ?>" 
								value="<?= $count; ?>" 
								readonly>
							</input>
						</div>
						<div class="qty-down"><a class="down-icon"></a></div>
					</div>
				</div>
				<div class="pr-remove col-lg-1 col-md-1 col-sm-1 col-xs-1">
					<a class="remove-icon">
					</a>
				</div>
				<div class="clearfix"></div>
			</div>
		<?php endforeach ?>
	</div>

	<div class="cart-total col-lg-3 col-md-3 col-sm-3 col-xs-3">
		<a class="continue" onclick="history.back();">Продолжить покупки</a>
		<div class="price-details">
			<div class="clearfix"></div>				 
		</div>
		<ul class="total_price">
			<li class="last_price"> <h4>Итого:</h4></li>	
			<li class="last_price"><span id="total"></span></li>
			<div class="clearfix"> </div>
		</ul> 
		<div class="clearfix"></div>
		<a class="order" href="/order">Оформить заказ</a>
	</div>
<?php else: ?>
	<div class="cart col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h4 class="title">ваша корзина пуста</h4>
		<p class="cart">Вы не добавили ни одного продукта в корзину.
			<br>Нажмите<a onclick="history.back();"> тут</a> чтобы продолжить покупки
		</p>
	</div>
<?php endif; ?>

<div class="clearfix"> </div>

</div>
</div>
</div>
</div>