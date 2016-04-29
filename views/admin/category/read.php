<!-- REQUIRED -->
	<!-- $categoryList -->
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
	<script type="text/javascript">read.name = "category";</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		Category Read
		<small>Просмотр записей из таблицы Category</small>
		<button class="btn btn-success ad-add-link">
			Добавить запись
		</button>
	</h1>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Category</h3>
		</div>
		<div class="box-body">
			<table id="datatable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Short</th>
						<th>Image</th>
						<th>Parent</th>
						<th>Sort</th>
						<th>Status</th>
						<th>Редактирование</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($categoryList as $category): ?>
						<?php if($category instanceof NullCategory) continue; ?>

						<?php $id     = $category->getID(); ?>
						<?php $name   = $category->getName(); ?>
						<?php $short  = $category->getShortName(); ?>
						<?php $image  = $category->getImage()->link(); ?>
						<?php $parent = $category->getParent()->getName(); ?>
						<?php $sort   = $category->getSortOrder(); ?>
						<?php $status = $category->getStatus() ? "enabled" : "disabled"; ?>
						
						<tr>
							<td><?= $id; ?></td>
							<td><?= $name; ?></td>
							<td><?= $short; ?></td>
							<td><a href="<?= $image; ?>">image</a></td>
							<td><?= $parent; ?></td>
							<td><?= $sort; ?></td>
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
						<th>Short</th>
						<th>Image</th>
						<th>Parent</th>
						<th>Sort</th>
						<th>Status</th>
						<th>Редактирование</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>