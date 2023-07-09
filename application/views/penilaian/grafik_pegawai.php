<?php
$this->load->view('templates/meta', [
	'page_title' => 'Hasil Penilaian'
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
			'menu_location' => 'riwayat'
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
								<li class="breadcrumb-item active"><a href="#">Penilaian</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid p-4 border">
					<h2>Tren performa <strong><?= $pegawai->user->name ?></strong></h2>
					<hr>
					<div class="row">
						<div class="col-12 col-lg-8">
							<div class="card w-100">
								<div class="card-body">
									<div class="" id="revenue-chart" style="position: relative; height: 500px;">
										<canvas id="revenue-chart-canvas"></canvas>
									</div>
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

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script src="<?php echo base_url('plugins') ?>/chart.js/chart.umd.js"></script>
<script>
	var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')

	var salesChartOptions = {
		maintainAspectRatio: false,
		responsive: true,
		legend: {
			display: true
		},
		scales: {
			x: {
				gridLines: {
					display: true
				}
			},
			y: {
				gridLines: {
					display: false
				},
				beginAtZero: false
			}
		}
	}
	var trenPenilaianPegawai = {
		labels: [<?php foreach ($jadwals as $jadwal) echo "'" . $jadwal->deskripsi . "'," ?>],
		datasets: [{
			label: 'Tren penilaian <?= $pegawai->user->name ?>',
			data: [<?php foreach ($jadwals as $jadwal) echo $jadwal->penilaian_rata_rata . "," ?>]
		}, ]
	}
	var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
		type: 'line',
		data: trenPenilaianPegawai,
		options: salesChartOptions
	})
</script>
