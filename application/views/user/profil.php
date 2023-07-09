<?php
$this->load->view('templates/meta', [
	'page_title' => 'Profil'
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
								<li class="breadcrumb-item active"><a href="#">Profil Pengguna</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content p-4 m-lg-2 m-2">
				<div class="container-fluid p-4  border">
					<div class="d-flex flex-row align-items-center">
						<span class="h3 mr-auto">Akun Anda</span>
						<a class="btn btn-sm btn-primary mr-1" href="<?= base_url('updatesandi') ?>">
							<i class="fas fa-key"></i>
							Ubah sandi
						</a>
						<a class="btn btn-sm btn-primary" href="<?= base_url('updateprofil') ?>">
							<i class="fas fa-edit"></i>
							Edit profil
						</a>
					</div>
					<hr>
					<div class="row">
						<div class="col col-lg-6">
							<div class="mb-1">
								<img class="img img-circle mr-3" style="width: 200px; height: 200px; object-fit: cover;" src="<?= base_url(URL_AVATAR . $user->avatar) ?>" alt="Avatar">
								<hr>
							</div>
							<div class="mb-1">
								<h6 class="font-weight-bold">Nama</h6>
								<?= $user->name ?>
								<hr>
							</div>
							<div class="mb-1">
								<h6 class="font-weight-bold">NIP</h6>
								<?= $pegawai->nip ?>
								<hr>
							</div>
							<div class="mb-1">
								<h6 class="font-weight-bold">Email</h6>
								<?= $user->email ?>
								<hr>
							</div>
							<?php if ($pegawai->dinas) { ?>
								<div class="mb-1">
									<h6 class="font-weight-bold">Dinas</h6>
									<?= $pegawai->dinas->name ?>
									<hr>
								</div>
							<?php } else { ?>
								<div class="mb-1">
									<h6 class="font-weight-bold">Dinas</h6>
									<span class="text-danger">
										Belum ditentukan
									</span>
									<hr>
								</div>
							<?php } ?>
							<?php if ($pegawai->jabatan) { ?>
								<div class="mb-1">
									<h6 class="font-weight-bold">Jabatan</h6>
									<?= $pegawai->jabatan->name ?>
									<hr>
								</div>
							<?php } else { ?>
								<div class="mb-1">
									<h6 class="font-weight-bold">Jabatan</h6>
									<span class="text-danger">
										Belum ditentukan
									</span>
									<hr>
								</div>
							<?php } ?>
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
