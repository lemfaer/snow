<script type="text/javascript" src="/views/cart/full/price.js"></script>
<script type="text/javascript" src="/views/cart/full/pr-qty.js"></script>
<script type="text/javascript" src="/views/cart/full/pr-remove.js"></script>

<?php $cart = Cart::getCart(); ?>

<div class="main">
	<div class="check">
		<div class="container">
			
			<?php if ($cart): ?>
				<div class="col-md-9 cart">
					<h4 class="title">корзина</h4>
					
					<?php foreach ($cart as $value): ?>
						<?php $count     = $value['count']; ?>
						<?php $available = $value['available']; ?>

						<?php $avID    = $available->getID(); ?>
						<?php $avCount = $available->getCount(); ?>

						<?php $size    = $available->getSize(); ?>
						<?php $color   = $available->getColor(); ?>
						<?php $product = $available->getProduct(); ?>

						<?php $sName = $size->getName(); ?>

						<?php $cName  = $color->getName(); ?>
						<?php $cValue = $color->getValue(); ?>

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
							<div class="col-md-3 pr-image">
								<img src="<?= $pImage; ?>" class="img-responsive" alt=""/>
							</div>
							<div class="col-md-6 pr-info">
								<ul class="qty">
									<li class="name">
										<a href="<?= $pLink; ?>"><?= $pName; ?></a>
									</li>
									<li><p>Цвет : <?= $cName; ?></p></li>
									<li><p>Размер : <?= $sName; ?></p></li>
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
							<div class="col-md-2 pr-qty">
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
							<div class="col-md-1 pr-remove">
								<a class="remove-icon">
								</a>
							</div>
							<div class="clearfix"></div>
						</div>
					<?php endforeach ?>

				</div>

				<div class="col-md-3 cart-total">
					<a class="continue" onclick="history.back();">Продолжить покупки</a>
					<div class="price-details">
						<div class="clearfix"></div>				 
					</div>
					<ul class="total_price">
						<li class="last_price"> <h4>Итого:</h4></li>	
						<li class="last_price"><span id="total">6150.00</span></li>
						<div class="clearfix"> </div>
					</ul> 
					<div class="clearfix"></div>
					<a class="order" href="#">Оформить заказ</a>
				</div>
			<?php else: ?>
				<div class="col-md-12 cart">
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