<?php
$this->load->view('templates/meta', [
	'page_title' => 'Pedoman Penilaian'
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
								<li class="breadcrumb-item active"><a href="#">Pedoman Penilaian</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4 border">
					<h2>Pedoman Penilaian</h2>
					<hr>
					<div class="row">
						<div class="col-12 col-lg-4 d-flex flex-row align-content-stretch">
							<div class="card ">
								<div class="card-header ">
									<h5> PP No.30 Tahun 2019 Pasal 2 </h5>
								</div>
								<div class="card-body bg-green">
									<p>Penilaian Kinerja PNS bertujuan untuk menjamin objektivitas pembinaan PNS yang didasarkan pada sistem prestasi dan sistem karier. </p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-4 d-flex flex-row align-content-stretch">
							<div class="card ">
								<div class="card-header ">
									<h5>PP No.30 Tahun 2019 Pasal 1</h5>
								</div>
								<div class="card-body bg-green">
									<p>
										Tim Penilai Kinerja PNS adalah tim yang dibentuk oleh Pejabat yang Berwenang untuk memberikan pertimbangan kepada 
										Pejabat Pembina Kepegawaian atas usulan pengangkatan, pemindahan, dan pemberhentian dalam jabatan, pengembangan kompetensi, 
										serta pemberian penghargaan bagi PNS.
									</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-4 d-flex flex-row align-content-stretch">
							<div class="card ">
								<div class="card-header ">
									<h5>Peraturan Pemerintah</h5>
								</div>
								<div class="card-body bg-green">
									<p>
										Peraturan Pementah yang mengatur tentang pedoman penilaian Pegawai Negeri Sipil dapat anda baca
										pada <strong>Peraturan Pemerintah No.30 Tahun 2019</strong> tentang Penilaian Kinerja Pegawai Negeri Sipil.
										Serta <strong>Peraturan Menteri Pendayagunaan Aparatur Negara Dan Reformasi Birokrasi Republik Indonesia Nomor 6 Tahun 2022</strong> 
										tentang Pengelolaan Kinerja Pegawai Aparatur Sipil Negara.
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
