<!-- REQUIRED -->
	<!-- $sizeList -->
<!-- REQUIRED END -->

<!-- PLUGINS -->
	<link rel="stylesheet" href="/template/css/dataTables.bootstrap.css">

	<script src="/template/js/jquery.dataTables.min.js"></script>
	<script src="/template/js/dataTables.bootstrap.min.js"></script>
	<script>
		jQuery(document).ready(function($) {
			$("#datatable").DataTable();
		});
	</script>
<!-- PLUGINS END -->

<script type="text/javascript" src="/views/admin/read.js"></script>
<script type="text/javascript">read.name = "size";</script>

<section class="content-header">
	<h1>
		Size Read
		<small>Просмотр записей из таблицы Size</small>
		<button class="btn btn-success ad-add-link">
			Добавить запись
		</button>
	</h1>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Size</h3>
		</div>
		<div class="box-body">
			<table id="datatable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Category</th>
						<th>Status</th>
						<th>Редактирование</th>
						<th>Удаление</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($sizeList as $size): ?>
						<?php $id       = $size->getID(); ?>
						<?php $name     = $size->getName(); ?>
						<?php $category = $size->getCategory()->getName(); ?>
						<?php $status   = $size->getStatus() ? "enabled" : "disabled"; ?>
						
						<tr>
							<td><?= $id; ?></td>
							<td><?= $name; ?></td>
							<td><?= $category; ?></td>
							<td><?= $status; ?></td>
							<td style="width: 1px;">
								<a class="ad-update-link" data-id="<?= $id; ?>">
									<i class="fa fa-edit"></i> Изменить
								</a>
							</td>
							<td style="width: 1px;">
								<a class="ad-delete-link" data-id="<?= $id; ?>">
									<i class="fa fa-remove"></i> Удалить
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
						<th>Status</th>
						<th>Редактирование</th>
						<th>Удаление</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>