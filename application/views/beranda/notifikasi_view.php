<?php
$this->load->view('templates/meta', [
	'page_title' => 'Notifikasi'
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
			'menu_location' => 'beranda'
		]); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<!-- <h1 class="m-0">Penilaian Kinerja Pegawai Negeri Sipil Kabupaten Pringsewu</h1> -->
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('beranda') ?>">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('notifikasi') ?>">Notifikasi</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('notifikasi') ?>">Detail</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4 border">
					<h2>Notifikasi</h2>
					<hr>
					<div class="row">
						<div class="col-12 col-lg-8">
							<div class="row mb-3">
								<div class="col-10">
									<span class="h3">
										<?= $notifikasi->title ?>
									</span>
									<br>
									<div>
										<?= $notifikasi->info ?>
									</div>
								</div>
								<div class="col-2">
									<div class="d-flex h-100 flex-row justify-content-end align-items-center no-stretch">
										<?php if (!$notifikasi->is_seen) { ?>
											<form action="<?= base_url('notifikasi/' . $notifikasi->id . '/dilihat') ?>" method="post">
												<button class="btn btn-danger mr-1">
													<i class="fas fa-check"></i>
													Tandai dilihat
												</button>
											</form>
										<?php } else { ?>
											<small class="badge badge-success mr-1 align-self-center"><i class="fas fa-check"></i> Telah dilihat</small>
										<?php } ?>
										<!-- <button class="btn btn-danger mr-1" href="<?= base_url('notifikasi/' . $notifikasi->id . '/dibaca') ?>">Hapus</button> -->
									</div>
								</div>
							</div>
							<hr>
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