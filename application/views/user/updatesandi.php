<?php
$this->load->view('templates/meta', [
	'page_title' => 'Ganti Password'
]); ?>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<?php $this->load->view('templates/navigation', [
			'menu_location' => 'profil'
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
								<li class="breadcrumb-item"><a href="/beranda">Beranda</a></li>
								<li class="breadcrumb-item"><a href="#">Edit Profil</a></li>
								<li class="breadcrumb-item active"><a href="#">Ganti Password</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4 border">
					<?php $this->load->view('templates/header_message') ?>
					<h2>Ganti Sandi</h2>
					<hr>
					<form action="<?= base_url('updatesandi') ?>" method="post" enctype="post">
						<div class="row">
							<div class="col col-lg-6">
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="txtOldPassword">Password lama</label>
									<div class="col-12 col-lg-9">
										<input class="form-control <?= form_error('txtOldPassword') ? 'is-invalid' : '' ?>" type="password" name="txtOldPassword" id="txtOldPassword" placeholder="Password lama">
										<div class="invalid-feedback">
											<?= form_error('txtOldPassword'); ?>
										</div>
									</div>
								</div>
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="txtNewPassword">Password baru</label>
									<div class="col-12 col-lg-9">
										<input class="form-control <?= form_error('txtNewPassword') ? 'is-invalid' : '' ?>" type="password" name="txtNewPassword" id="txtNewPassword" placeholder="Password baru">
										<div class="invalid-feedback">
											<?= form_error('txtNewPassword'); ?>
										</div>
									</div>
								</div>
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="txtNewPasswordConfirm">Konfirmasi password</label>
									<div class="col-12 col-lg-9">
										<input class="form-control <?= form_error('txtNewPasswordConfirm') ? 'is-invalid' : '' ?>" type="password" name="txtNewPasswordConfirm" id="txtNewPasswordConfirm" placeholder="Konfirmasi password">
										<div class="invalid-feedback">
											<?= form_error('txtNewPasswordConfirm'); ?>
										</div>
									</div>
								</div>
								<div class=" mb-1">
									<button class="btn btn-primary float-right" type="submit">
										<i class="fas fa-save"></i>
										Simpan
									</button>
								</div>
							</div>
						</div>
					</form>

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


<script src="<?php echo base_url('plugins') ?>/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
	$(function() {
		bsCustomFileInput.init();
	});
</script>