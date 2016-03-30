<!-- REQUIRED -->
	<!-- $colorList -->
<!-- REQUIRED END -->

<!-- DataTables -->
	<link rel="stylesheet" href="/template/css/dataTables.bootstrap.css">

	<script src="/template/js/jquery.dataTables.min.js"></script>
	<script src="/template/js/dataTables.bootstrap.min.js"></script>
	<script>
		jQuery(document).ready(function($) {
			$("#datatable").DataTable();
		});
	</script>
<!-- DataTables end -->

<section class="content-header">
	<h1>
		Color Read
		<small>Просмотр записей из таблицы Color</small>
		<button class="btn btn-success" 
			style="float: right;" 
			onclick="window.location.href = '/admin/color/create';">
			Добавить запись
		</button>
	</h1>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Color</h3>
		</div>
		<div class="box-body">
			<table id="datatable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Value</th>
						<th>Status</th>
						<th>Редактирование</th>
						<th>Удаление</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($colorList as $color): ?>
						<?php $id     = $color->getID(); ?>
						<?php $name   = $color->getName(); ?>
						<?php $value  = $color->getValue(); ?>
						<?php $status = $color->getStatus() ? "enabled" : "disabled"; ?>

						<?php $updateLink = "/admin/color/update/$id"; ?>
						<?php $deleteLink = "/admin/color/delete/$id"; ?>
						<tr>
							<td><?= $id; ?></td>
							<td><?= $name; ?></td>
							<td><?= $value; ?></td>
							<td><?= $status; ?></td>
							<td style="width: 1px;">
								<a href="<?= $updateLink; ?>">
									<i class="fa fa-edit"></i>
									Изменить
								</a>
							</td>
							<td style="width: 1px;">
								<a href="<?= $deleteLink; ?>" style="color: #dd4b39;">
									<i class="fa fa-remove"></i>
									Удалить
								</a></td>
							</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Value</th>
						<th>Status</th>
						<th>Редактирование</th>
						<th>Удаление</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>