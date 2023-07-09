<?php
$this->load->view('templates/meta', [
	'page_title' => 'Tata Cara Penilaian'
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
							<!-- <h1 class="m-0">Tata Cara Penilaian</h1> -->
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="/beranda">Beranda</a></li>
								<li class="breadcrumb-item active"><a href="#">Tata Cara Penilaian</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4 border">
					<h2>Tata Cara Penilaian</h2>
					<hr>
					<div class="row d-flex flex-row align-content-stretch">
						<div class="col-12 col-lg-4 d-flex flex-row align-content-stretch">
							<div class="card ">
								<div class="card-header ">
									<h5>Langkah 1</h5>
								</div>
								<div class="card-body bg-green">
									<p>
										Pilih menu <strong>Penilaian</strong> yang ada pada side bar (sebelah kiri), kemudian anda akan masuk pada halaman penilaian.
									</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-4 d-flex flex-row align-content-stretch">
							<div class="card ">
								<div class="card-header ">
									<h5>Langkah 2</h5>
								</div>
								<div class="card-body bg-green">
									<p>
										Setelah masuk pada halaman penilaian, kemudian pilih pegawai pegawai yang akan anda nilai.
										Setelah memilih pegawai yang akan anda nilai, klik tombol <strong>Nilai</strong> untuk melanjutkan penilaian.
									</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-4 d-flex flex-row align-content-stretch">
							<div class="card ">
								<div class="card-header ">
									<h5>Langkah 3</h5>
								</div>
								<div class="card-body bg-green">
									<p>
										Selanjutnya, isikan penilaian anda terhadap pegawai yang anda nilai dengan memilih salah satu dari lima skala penilaian
										yang ada pada kolom <strong>Pilih</strong>.
										Setelah mengisi semua faktor penilaian, maka tekan tombol <strong>Lihat Hasil</strong> untuk melihat hasil penilaian.
									</p>
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
					<b>Version</b> 2.1.0
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
