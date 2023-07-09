<?php
$this->load->view('templates/meta', [
	'page_title' => 'Update Profil'
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
								<li class="breadcrumb-item active"><a href="#">Edit Profil</a></li>
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
					<h2>Akun Anda</h2>
					<hr>
					<form action="<?= base_url('updateprofil') ?>" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col col-lg-6">
								<div class="row">
									<div class="col d-flex flex-row justify-content-center mb-3">
										<img class="img img-circle mr-3" style="width: 200px; height: 200px; object-fit: cover;" src="<?= base_url(URL_AVATAR . $user->avatar)  ?>" alt="Avatar">
									</div>
								</div>
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="exampleInputFile">Foto Profil</label>
									<div class="col-12 col-lg-9">
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" name="imgProfil" id="imgProfil" accept=".jpg, .jpeg, .png">
												<label class="custom-file-label" for="exampleInputFile">Pilih File</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="txtNama">Nama</label>
									<div class="col-12 col-lg-9">
										<input class="form-control <?= form_error('txtNama') ? 'is-invalid' : '' ?>" type="text" name="txtNama" id="txtNama" value="<?= $user->name ?>">
										<div class="invalid-feedback">
											<?= form_error('txtNama'); ?>
										</div>
									</div>
								</div>
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="txtNip">NIP</label>
									<div class="col-12 col-lg-9">
										<input class="form-control <?= form_error('txtNip') ? 'is-invalid' : '' ?>" type="number" name="txtNip" id="txtNip" value="<?= $pegawai->nip ?>">
										<div class="invalid-feedback">
											<?= form_error('txtNip'); ?>
										</div>
									</div>
								</div>
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="txtEmail">Email</label>
									<div class="col-12 col-lg-9">
										<input class="form-control <?= form_error('txtEmail') ? 'is-invalid' : '' ?>" type="email" name="txtEmail" id="txtEmail" value="<?= $user->email ?>">
										<div class="invalid-feedback">
											<?= form_error('txtEmail'); ?>
										</div>
									</div>
								</div>
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="txtDinas">Dinas</label>
									<div class="col-12 col-lg-9">
										<select class="form-control <?= form_error('txtDinas') ? 'is-invalid' : '' ?>" name="txtDinas">
											<?php if ($pegawai->dinas) { ?>
												<option selected value="<?= $pegawai->dinas->id ?>"><?= $pegawai->dinas->name ?></option>
											<?php } else { ?>
												<option value="">Pilih dinas</option>
											<?php } ?>
											<?php foreach ($dinases as $dinas) { ?>
												<option value="<?= $dinas->id ?>"><?= $dinas->name ?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">
											<?= form_error('txtDinas'); ?>
										</div>
									</div>
								</div>
								<div class="form-group row mb-3">
									<label class="col-12 col-lg-3 col-form-label" for="txtJabatan">Jabatan</label>
									<div class="col-12 col-lg-9">
										<select class="form-control <?= form_error('txtJabatan') ? 'is-invalid' : '' ?>" name="txtJabatan">
											<?php if ($pegawai->jabatan) { ?>
												<option selected value="<?= $pegawai->jabatan->id ?>"><?= $pegawai->jabatan->name ?></option>
											<?php } else { ?>
												<option value="">Pilih jabatan</option>
											<?php } ?>
											<?php foreach ($jabatans as $jabatan) { ?>
												<option value="<?= $jabatan->id ?>"><?= $jabatan->name ?></option>
											<?php } ?>
										</select>
										<div class="invalid-feedback">
											<?= form_error('txtJabatan'); ?>
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