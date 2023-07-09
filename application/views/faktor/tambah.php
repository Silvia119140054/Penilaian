<?php
$this->load->view('templates/meta', [
	'page_title' => 'Tambah Faktor Penilaian Baru'
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
								<li class="breadcrumb-item active"><a href="#">Tambah Penilaian</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4 border">
					<h4>Penambahan faktor penilaian</h4>
					<hr>
					<div class="row">
						<div class="col col-lg-8">
							<form action="<?= base_url('faktor/tambah') ?>" method="post" novalidate>
								<div class="card">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Nama Faktor Penilaian</label>
											<div class="col-12 col-lg-9">
												<input type="text" class="form-control <?= form_error('txtNamaFaktor') ? 'is-invalid' : '' ?>" name="txtNamaFaktor" id="txtNamaFaktor" required value="<?= set_value('txtNamaFaktor') ?>">
												<div class="invalid-feedback">
													<?= form_error('txtNamaFaktor'); ?>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Nilai CF</label>
											<div class="col-12 col-lg-9">
												<input type="number" class="form-control <?= form_error('txtNilaiCf') ? 'is-invalid' : '' ?>" name="txtNilaiCf" id="txtNilaiCf" required value="<?= set_value('txtNilaiCf') ?>" max="1.0">
												<div class="invalid-feedback">
													<?= form_error('txtNilaiCf'); ?>
												</div>
											</div>
										</div>
										<div class="d-flex flex-row justify-content-end no-stretch">
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
</body>