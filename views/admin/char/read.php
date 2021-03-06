<!-- REQUIRED -->
	<!-- $charList -->
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
	<script type="text/javascript">document.title = "Char | Read"</script>
	<script type="text/javascript">read.name = "char";</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		Characteristic Read
		<small>Просмотр записей из таблицы Characteristic</small>
		<button class="btn btn-success ad-add-link">
			Добавить запись
		</button>
	</h1>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Characteristic</h3>
		</div>
		<div class="box-body">
			<table id="datatable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Категория</th>
						<th>Название</th>
						<th>Значение</th>
						<th>Статус</th>
						<th>Редактирование</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($charList as $cValue): ?>
						<?php $cName  = $cValue->getName(); ?>

						<?php $id     = $cValue->getID(); ?>
						<?php $name   = $cName->getName(); ?>
						<?php $value  = $cValue->getValue(); ?>
						<?php $cat    = $cName->getCategory()->getName(); ?>
						<?php $status = $cValue->getStatus() ? "enabled" : "disabled"; ?>
						
						<tr>
							<td><?= $id; ?></td>
							<td><?= $cat; ?></td>
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
						<th>Category</th>
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