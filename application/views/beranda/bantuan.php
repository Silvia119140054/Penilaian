<?php
$this->load->view('templates/meta', [
	'page_title' => 'Bantuan'
]); ?>

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
							<!-- <h1 class="m-0">Tentang Aplikasi</h1> -->
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="/beranda">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="#">Bantuan</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4  ">
					<div class="d-flex flex-row justify-content-center">
						<div class="card" style="width: 38rem">
							<div class="card-body ">
								<h2 class="mb-3 text-center">Bantuan</h2>
								<hr>
								<p class="text-center">
									Sistem pakar penilaian kinerja Pegawai Negeri Sipil Kabupaten Pringsewu merupakan sebuah sistem yang dapat digunakan oleh Pegawai Negeri Sipil di Kabupaten Pringsewu untuk
									mempermudah melakukan penilaian kinerja terhadap atasan maupun dengan sesama rekan kerja.
								</p>
								<hr>
								<p class="text-center">
									Apabila anda memiliki kendala saat menggunakan sistem ini, silakan klik link di bawah ini
								</p>
								<hr>
								<div class="d-flex flex-row justify-content-center">
									<a class="btn btn-light" href="https://forms.gle/2Q9hGnjf72MDh9wD6">Isi Form</a>

								</div>
							</div>
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
