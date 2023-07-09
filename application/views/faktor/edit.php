<?php
$this->load->view('templates/meta', [
	'page_title' => 'Edit Faktor Penilaian'
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
			'menu_location' => 'pengaturan_penilaian'
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
								<li class="breadcrumb-item"><a href="<?= base_url('faktor') ?>">Pengaturan Faktor Penilaian</a></li>
								<li class="breadcrumb-item active"><a href="#">Edit Faktor</a></li>
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

					<h4>Edit faktor penilaian</h4>
					<hr>
					<div class="row">
						<div class="col col-lg-8">
							<form action="<?= base_url('faktor/' . $faktor->id . '/edit') ?>" method="post" novalidate>
								<div class="card">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNamaFaktor">Nama Faktor Penilaian</label>
											<div class="col-12 col-lg-9">
												<input type="text" class="form-control <?= form_error('txtNamaFaktor') ? 'is-invalid' : '' ?>" name="txtNamaFaktor" id="txtNamaFaktor" required value="<?= $faktor->alias ?>">
												<div class="invalid-feedback">
													<?= form_error('txtNamaFaktor'); ?>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNilaiCf">Nilai CF</label>
											<div class="col-12 col-lg-9">
												<input type="number" class="form-control <?= form_error('txtNilaiCf') ? 'is-invalid' : '' ?>" name="txtNilaiCf" id="txtNilaiCf" required value="<?= $faktor->nilai_cf ?>">
												<div class="invalid-feedback">
													<?= form_error('txtNilaiCf'); ?>
												</div>
											</div>
										</div>
										<div class="row">
											<div class=" col w-100 d-flex flex-row justify-content-end">
												<button type="submit" class="btn btn-primary btn-sm ml-2 ">Simpan</button>
												<button type="button" class="btn btn-danger btn-sm ml-2" data-toggle="modal" data-target="#modal-delete-faktor">
													<i class="fas fa-trash  "></i>
													Hapus
												</button>
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


	<div class="modal fade" id="modal-delete-faktor">
		<div class="modal-dialog">
			<div class="modal-content  ">
				<div class="modal-header">
					<h4 class="modal-title">Hapus faktor penilaian</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Anda akan menghapus faktor penilaian</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Tutup</button>
					<form action="<?= base_url('faktor/hapus') ?>" method="post">
						<input type="hidden" name="idFaktor" value="<?= $faktor->id ?>" id="idFaktorField">
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
