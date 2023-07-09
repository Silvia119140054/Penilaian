<?php
$this->load->view('templates/meta', [
	'page_title' => 'Pengaturan Notifikasi'
]); ?>
<style>
	.small-box p-2 {
		transition: transform 0.4s ease;
	}

	.small-box p-2:hover {
		transform: scale(1.05);
	}
</style>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<?php $this->load->view('templates/navigation', [
			'menu_location' => 'pengaturan_notifikasi'
		]); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Pengaturan Notifikasi</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('/admin/pengaturan_notifikasi') ?>">Pengaturan Notifikasi</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">

				<div class="container-fluid">
					<?php $this->load->view('templates/header_message'); ?>
					<div class="row">
						<div class="col-12 col-lg-8 mr-2 mb-4">
							<div class="card bg-light rounded-0">
								<div class="card-body">
									<div class="d-flex flex-row justify-content-end no-stretch">
										<a href="<?= base_url('notifikasi/new') ?>" class="btn btn-sm btn-primary "><i class="fas fa-plus"></i> Buat notifikasi</a>
									</div>
									<table class="table table-hover  text-wrap">
										<thead>
											<tr>
												<th class="col-1">No</th>
												<th class="col-3">Judul</th>
												<th class="col-5">Informasi</th>
												<th class="col-1">Terbit</th>
												<th class="col-2">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($notifikasis as $notifikasi) { ?>
												<tr>
													<td class="col-1"><?= $no++ ?></td>
													<td class="col-3">
														<?= $notifikasi->title ?>
													</td>
													<td class="col-5">
														<?= $notifikasi->info ?>
													</td>
													<td class="col-1">
														<?= $notifikasi->release_at ?>
													</td>
													<td class="col-2 ">
														<div class="w-100 d-flex flex-row justify-content-start">
															<a class="btn btn-primary btn-sm   mr-1" href="<?= base_url('notifikasi/' . $notifikasi->id . '/edit') ?>">
																<i class="fas fa-edit  "></i>
																Edit
															</a>
															<button class="btn btn-danger btn-sm mr-1" onclick="hapusNotifikasi(this)" notifikasiId="<?= $notifikasi->id ?>" notifikasiTitle="<?= $notifikasi->title ?>" data-toggle="modal" data-target="#modal-delete-notifikasi">
																<i class="fas fa-trash  "></i>
																Hapus
															</button>
														</div>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<strong>Copyright &copy; 2014-2021 Penilaian Kinerja Pegawai Negeri Sipil Kab. Pringsewu
				<div class="float-right d-none d-sm-inline-block">
					<b>Version</b> 3.2.0
				</div>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<?php
	$this->load->view('templates/footer'); ?>

	<!-- MODALS -->
	<div class="modal fade" id="modal-delete-notifikasi">
		<div class="modal-dialog">
			<div class="modal-content  ">
				<div class="modal-header">
					<h4 class="modal-title">Hapus Notifikasi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Anda akan menghapus <span id="notifikasiTitleField"></span></p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Tutup</button>
					<form action="<?= base_url('notifikasi/hapus') ?>" method="post">
						<input type="hidden" name="notifikasiId" value="" id="notifikasiIdField">
						<button type="submit" class="btn btn-sm btn-danger btn-block">
							<i class="fas fa-trash"></i>
							Hapus
						</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</body>
<script>
	function hapusNotifikasi(target) {
		var notifikasiId = $(target).attr('notifikasiId');
		var notifikasiTitle = $(target).attr('notifikasiTitle');
		var formField = $('#notifikasiIdField');
		$(formField).val(notifikasiId);
		$('#notifikasiTitleField').text(notifikasiTitle);
	}
</script>
