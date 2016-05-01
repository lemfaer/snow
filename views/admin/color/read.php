<!-- REQUIRED -->
	<!-- $colorList -->
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
	<script type="text/javascript">read.name = "color";</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		Color Read
		<small>Просмотр записей из таблицы Color</small>
		<button class="btn btn-success ad-add-link">
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
						<th>Назавание</th>
						<th>Код</th>
						<th>Статус</th>
						<th>Редактирование</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($colorList as $color): ?>
						<?php $id     = $color->getID(); ?>
						<?php $name   = $color->getName(); ?>
						<?php $value  = $color->getValue(); ?>
						<?php $status = $color->getStatus() ? "enabled" : "disabled"; ?>
						
						<tr>
							<td><?= $id; ?></td>
							<td><?= $name; ?></td>
							<td><?= $value; ?></td>
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
						<th>Value</th>
						<th>Status</th>
						<th>Update</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>