<!-- REQUIRED -->
	<!-- $indentList -->
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
	<script type="text/javascript">read.name = "indent";</script>
<!-- SETTINGS END -->

<section class="content-header">
	<h1>
		Indent Read
		<small>Просмотр записей из таблицы Indent</small>
	</h1>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Indent</h3>
		</div>
		<div class="box-body">
			<table id="datatable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Имя</th>
						<th>Телефон</th>
						<th>Адрес</th>
						<th>Товаров</th>
						<th>Сумма</th>
						<th>Статус</th>
						<th>Редактирование</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($indentList as $item): ?>
						<?php $indent  = $item->getIndent(); ?>
						<?php $contact = $indent->getContact(); ?>
						<?php $state   = $indent->getState(); ?>

						<?php $id      = $indent->getID(); ?>
						<?php $name    = $contact->getName(); ?>
						<?php $phone   = $contact->getPhone(); ?>
						<?php $address = $contact->getAddress(); ?>
						<?php $count   = $item->count(); ?>
						<?php $total   = $item->total(); ?>
						<?php $state   = $state->getName(); ?>
						
						<tr>
							<td><?= $id; ?></td>
							<td><?= $name; ?></td>
							<td><?= $phone; ?></td>
							<td><?= $address; ?></td>
							<td><?= $count; ?></td>
							<td><?= $total; ?></td>
							<td><?= $state; ?></td>

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
						<th>Phone</th>
						<th>Address</th>
						<th>Count</th>
						<th>Total</th>
						<th>State</th>
						<th>Update</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>