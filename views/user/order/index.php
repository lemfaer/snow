<!-- REQUIRED -->
	<!-- $indentList -->
<!-- REQUIRED END -->

<?php usort($indentList, function($a, $b) {
	return 0 - ($a->getIndent()->getID() <=> $b->getIndent()->getID()) <=> 0;
}); ?>

<?php
	/**
	 * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
	 * @param  $number Integer Число на основе которого нужно сформировать окончание
	 * @param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
	 *         например array('яблоко', 'яблока', 'яблок')
	 * @return String
	 */
	function getNumEnding($number, $endingArray) {
		$number = $number % 100;
		if ($number >= 11 && $number <= 19) {
			$ending = $endingArray[2];
		} else {
			$i = $number % 10;
			switch ($i) {
				case (1): $ending = $endingArray[0]; break;
				case (2):
				case (3):
				case (4): $ending = $endingArray[1]; break;
				default: $ending=$endingArray[2];
			}
		}
		return $ending;
	}

	function uniqueProducts(array $cargoList) : array {
		$arr = array();
		foreach ($cargoList as $cargo) {
			$av = $cargo->getAvailable();
			$product = $av->getProduct();

			$arr[] = $product;
		}

		$arr = array_unique($arr, SORT_REGULAR);
		$arr = array_slice($arr, 0, 5);

		return $arr;
	}
?>

<div class="main">
<div class="shop_top">
<div class="container">

<div style="margin-bottom: 20px">
	<h3 class="m_2" style="margin-bottom: 1%">
		Мои заказы
	</h3>
</div>

<?php foreach ($indentList as $item): ?>
	<?php $indent    = $item->getIndent(); ?>
	<?php $cargoList = $item->getCargoList(); ?>

	<?php $count = $item->count(); ?>
	<?php $total = '$'.$item->total(); ?>

	<?php $productList = uniqueProducts($cargoList); ?>

	<?php $id = $indent->getID(); ?>

	<?php $state = $indent->getState(); ?>
	<?php $state = $state->getName(); ?>

	<div class="panel panel-default">
		<div class="panel-heading indent-heading" 
			data-toggle="collapse" 
			href="#indent_<?= $id; ?>">
		<div class="row row-eq-height">
			<div class="indent-id col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<h4 class="panel-title">
					№<?= $id ?>
				</h4>
			</div>

			<div class="indent-image col-lg-6 col-md-6 col-sm-6 col-xs-6">
				<?php foreach ($productList as $product): ?>
					<?php $image = $product->getImage()->link135(); ?>
					<img src="<?= $image; ?>" alt="">
				<?php endforeach ?>
			</div>

			<div class="indent-summ col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<h4 class="panel-title">
					<?= $count; ?> 
					<?= getNumEnding($count, array("товар", "товара", "товаров")); ?>
					на
					<?= $total; ?>
				</h4>
			</div>

			<div class="indent-state col-lg-2 col-md-2 col-sm-2 col-xs-2">
				<h4 class="panel-title">
					<?= $state; ?>
				</h4>
			</div>
		</div>
		</div>

		<div id="indent_<?= $id; ?>" class="panel-collapse collapse">
			<ul class="list-group">
				<?php View::empty("user/order/cargos.php", compact("cargoList")); ?>
			</ul>
		</div>
	</div>

<?php endforeach ?>

</div>
</div>
</div>