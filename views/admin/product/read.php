<!-- REQUIRED -->
	<!-- $productList -->
<!-- REQUIRED END -->

<!-- PLUGINS -->
	<!-- DataTables -->
	<link rel="stylesheet" href="/template/css/dataTables.bootstrap.css">
	<script src="/template/js/jquery.dataTables.min.js"></script>
	<script src="/template/js/dataTables.bootstrap.min.js"></script>

	<!-- Settings -->
	<script>
		jQuery(document).ready(function($) {
			$("#datatable").DataTable();
		});
	</script>
<!-- PLUGINS END -->

<!-- SCRIPTS -->
	<script type="text/javascript" src="/views/admin/read.js"></script>
<!-- SCRIPTS END -->

<!-- SETTINGS -->
	<script type="text/javascript">read.name = "product";</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		Product Read
		<small>Просмотр записей из таблицы Product</small>
		<button class="btn btn-success ad-add-link">
			Добавить запись
		</button>
	</h1>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Product</h3>
		</div>
		<div class="box-body">
			<table id="datatable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Название</th>
						<th>Категория</th>
						<th>Изготовитель</th>
						<th>Цена</th>
						<th>Год</th>
						<th>Новое</th>
						<th>Реком</th>
						<th>Статус</th>
						<th>Редактирование</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($productList as $product): ?>
						<?php $product = $product->getProduct(); ?>

						<?php $id       = $product->getID(); ?>
						<?php $name     = $product->getName(); ?>
						<?php $category = $product->getCategory()->getName(); ?>
						<?php $producer = $product->getProducer()->getName(); ?>
						<?php $price    = $product->getPrice(); ?>
						<?php $year     = $product->getYear(); ?>
						<?php $new      = $product->isNew() ? ("yes") : ("no"); ?>
						<?php $rec      = $product->isRecomended() ? ("yes") : ("no"); ?>
						<?php $status   = $product->getStatus() ? "enabled" : "disabled"; ?>
						
						<tr>
							<td><?= $id; ?></td>
							<td><?= $name; ?></td>
							<td><?= $category; ?></td>
							<td><?= $producer; ?></td>
							<td><?= $price; ?></td>
							<td><?= $year; ?></td>
							<td><?= $new; ?></td>
							<td><?= $rec; ?></td>
							<td><?= $status; ?></td>
							<td style="width: 1px;">
								<a class="ad-update-link" data-id="<?= $id; ?>">
									<i class="fa fa-edit"></i> Изменить
								</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Category</th>
						<th>Producer</th>
						<th>Price</th>
						<th>Year</th>
						<th>New</th>
						<th>Rec</th>
						<th>Status</th>
						<th>Update</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>