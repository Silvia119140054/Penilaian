<?php
$this->load->view('templates/meta', [
	'page_title' => 'Edit Pegawai'
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
			'menu_location' => 'pengaturan_pegawai'
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
								<li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="<?= base_url('/admin/pengaturan_organisasi') ?>">Pengaturan Organisasi</a></li>
								<li class="breadcrumb-item active"><a href="#">Edit Pegawai</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4 border">
					<h4>Edit data pegawai</h4>
					<hr>
					<div class="row">
						<div class="col col-lg-8">
							<form action="<?= base_url('pegawai/' . $pegawai->id . '/edit') ?>" method="post" novalidate>
								<div class="card">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNamaPegawai">Nama Pegawai</label>
											<div class="col-12 col-lg-9">
												<input type="text" class="form-control <?= form_error('txtNamaPegawai') ? 'is-invalid' : '' ?>" name="txtNamaPegawai" id="txtNamaPegawai" required value="<?= $pegawai->user->name ?>">
												<div class="invalid-feedback">
													<?= form_error('txtNamaPegawai'); ?>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtEmailPegawai">Email</label>
											<div class="col-12 col-lg-9">
												<input type="email" class="form-control <?= form_error('txtEmailPegawai') ? 'is-invalid' : '' ?>" name="txtEmailPegawai" id="txtEmailPegawai" required value="<?= $pegawai->user->email ?>">
												<div class="invalid-feedback">
													<?= form_error('txtEmailPegawai'); ?>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNip">NIP</label>
											<div class="col-12 col-lg-9">
												<input type="text" class="form-control <?= form_error('txtNip') ? 'is-invalid' : '' ?>" name="txtNip" id="txtNip" required value="<?= $pegawai->nip ?>">
												<div class="invalid-feedback">
													<?= form_error('txtNip'); ?>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtDinas">Dinas</label>
											<div class="col-12 col-lg-9">
												<select class="form-control <?= form_error('txtDinas') ? 'is-invalid' : '' ?>" name="txtDinas">
													<?php if ($pegawai->dinas_id) { ?>
														<option selected value="<?= $pegawai->dinas_id ?>"><?= $this->organisasi_model->get_dinas_id($pegawai->dinas_id)->name ?></option>
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
										<div class="form-group row">
											<label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtJabatan">Jabatan</label>
											<div class="col-12 col-lg-9">
												<select class="form-control <?= form_error('txtJabatan') ? 'is-invalid' : '' ?>" name="txtJabatan">
													<?php if ($pegawai->jabatan_id) { ?>
														<option selected value="<?= $pegawai->jabatan_id ?>"><?= $this->organisasi_model->get_jabatan_id($pegawai->jabatan_id)->name ?></option>
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
