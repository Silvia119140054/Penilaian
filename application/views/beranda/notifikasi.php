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
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid border">
					<h2>Notifikasi</h2>
					<hr>
					<div class="row">
						<div class="col-12 col-lg-8">
							<?php foreach ($notifikasis as $notifikasi) { ?>
								<div class="row mb-3">
									<div class="col-1 d-flex">
										<!-- <svg class="  m-3" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" viewBox="0 0 16 16">
											<path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
											<path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
										</svg> -->
										<div class="d-flex flex-row align-items-center">
											<svg width="50" height="50" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M18.1336 11C18.7155 16.3755 21 18 21 18H3C3 18 6 15.8667 6 8.4C6 6.70261 6.63214 5.07475 7.75736 3.87452C8.88258 2.67428 10.4087 2 12 2C12.3373 2 12.6717 2.0303 13 2.08949" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M19 8C20.6569 8 22 6.65685 22 5C22 3.34315 20.6569 2 19 2C17.3431 2 16 3.34315 16 5C16 6.65685 17.3431 8 19 8Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
												<path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
											</svg>
										</div>
									</div>
									<div class="col-8">
										<span class="h5">
											<?= $notifikasi->title ?>
										</span>
										<br>
										<div>
											<?= $notifikasi->info ?>
										</div>
									</div>
									<div class="col-3">
										<div class="d-flex h-100 flex-row justify-content-end align-items-center no-stretch">
											<a class="btn btn-success btn-sm mr-1" href="<?= base_url('notifikasi/' . $notifikasi->id) ?>">Detail</a>
											<?php if (!$notifikasi->is_seen) { ?>
												<form action="<?= base_url('notifikasi/' . $notifikasi->id . '/dilihat') ?>" method="post">
													<button class="btn btn-danger btn-sm mr-1">
														<i class="fas fa-check"></i>
														Tandai dilihat
													</button>
												</form>
											<?php } else { ?>
												<small class="badge badge-success mr-1 align-self-center"><i class="fas fa-check"></i> Telah dilihat</small>
											<?php } ?>
										</div>
									</div>
								</div>
								<hr>
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
