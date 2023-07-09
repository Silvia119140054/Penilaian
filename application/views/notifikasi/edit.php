<?php
$this->load->view('templates/meta', [
	'page_title' => 'Edit notifikasi'
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
							<!-- <h1 class="m-0">Tata Cara Penilaian</h1> -->
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="<?= base_url('/admin/pengaturan_notifikasi') ?>">Pengaturan notifikasi</a></li>
								<li class="breadcrumb-item active"><a href="#">Edit</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4 border">
					<?php $this->load->view('templates/header_message'); ?>
					<h4>Edit notifikasi</h4>
					<hr>
					<?php if (form_error('txtTitle')) { ?>
						<div class="alert  alert-danger  ">
							<?= form_error('txtTitle') ?>
						</div>
					<?php } ?>
					<?php if (form_error('txtInfo')) { ?>
						<div class="alert  alert-danger  ">
							<?= form_error('txtInfo') ?>
						</div>
					<?php } ?>
					<div class="row">
						<div class="col col-lg-8">
							<form action="<?= base_url('notifikasi/' . $notifikasi->id . '/edit') ?>" method="post" novalidate>
								<div class="card">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-12  col-form-label" for="txtTitle">Judul</label>
											<div class="col-12 ">
												<input type="text" class="form-control <?= form_error('txtTitle') ? 'is-invalid' : '' ?>" name="txtTitle" id="txtTitle" required value="<?= $notifikasi->title ?>">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-12 col-form-label" for="txtInfo">Judul</label>
											<div class="col-12 ">
												<textarea id="summernote" name="txtInfo">
													<?= $notifikasi->info  ?>
												</textarea>
												<div class="invalid-feedback">
													<?= form_error('txtInfo'); ?>
												</div>
											</div>
										</div>
										<div class="d-flex flex-row justify-content-end no-stretch">

											<button type="button" class="btn btn-danger btn-sm mr-1" onclick="hapusNotifikasi(this)" notifikasiId="<?= $notifikasi->id ?>" notifikasiTitle="<?= $notifikasi->title ?>" data-toggle="modal" data-target="#modal-delete-notifikasi">
												<i class="fas fa-trash  "></i>
												Hapus
											</button>
											<div>
												<button type="submit" class="btn btn-primary btn-block">Simpan</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
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
	$(function() {
		// Summernote
		$('#summernote').summernote()

		// CodeMirror
		CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
			mode: "htmlmixed",
			theme: "monokai"
		});
	})

	function hapusNotifikasi(target) {
		var notifikasiId = $(target).attr('notifikasiId');
		var notifikasiTitle = $(target).attr('notifikasiTitle');
		var formField = $('#notifikasiIdField');
		$(formField).val(notifikasiId);
		$('#notifikasiTitleField').text(notifikasiTitle);
	}
</script>