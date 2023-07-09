<?php
$this->load->view('templates/meta', [
	'page_title' => 'Dashboard'
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
			'menu_location' => 'dashboard_admin'
		]); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Dashboard Admin</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item active"><a href="#">Beranda</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">

				<div class="container-fluid">
					<div class="row mt-4">
						<div class="col-lg-3 col-4">
							<!-- small box -->
							<div class="small-box bg-info">
								<div class="inner">
									<h3>
										<?= count($pegawais) ?>
									</h3>
									<p>Pegawai terdaftar</p>
								</div>
								<div class="icon">
									<i class="fas fa-users"></i>
								</div>
								<a href="<?=base_url('pegawai')?>" class="small-box-footer">Daftar pegawai <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<?php foreach ($dinases as $dinas) { ?>
							<div class="col-2">
								<!-- small box -->
								<div class="small-box bg-success">
									<div class="inner">
										<h3>
											<?= count($dinas->pegawais) ?>
										</h3>

										<p>Pegawai <?= $dinas->name ?></p>
									</div>
									<div class="icon">
										<i class="fas fa-user"></i>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="row mt-4">
						<?php foreach ($jabatans as $jabatan) { ?>
							<div class="col-2">
								<!-- small box -->
								<div class="small-box bg-success">
									<div class="inner">
										<h3>
											<?= count($jabatan->pegawais) ?>
										</h3>

										<p>Penjabat <?= $jabatan->name ?></p>
									</div>
									<div class="icon">
										<i class="fas fa-user"></i>
									</div>
								</div>
							</div>
						<?php } ?>
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
</body>
