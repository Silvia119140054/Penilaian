<?php
$this->load->view('templates/meta', [
	'page_title' => 'Penilaian - Data Pegawai'
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
			'menu_location' => 'penilaian'
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
					<?php $this->load->view('templates/header_message') ?>
					<h2>Daftar Penilaian Aktif</h2>
					<hr>
					<div class="row">
						<div class="col col-lg-8">
							<div class="small-box">
								<div class="inner bg-green">
									Anda akan melakukan penilaian terhadap Pegawai Negeri Sipil di Kabupaten Pringsewu.
									Silakan pilih nama pegawai yang ingin anda nilai. Setelah memilih pegawai yang ingin anda nilai, klik
									tombol <strong>Nilai</strong> di bawah untuk melanjutkan penilaian.
								</div>
							</div>
							<div class="small-box">
								<div class="inner bg-green">
									Terdapat <strong><?= count($jadwals) ?> jadwal penilaian aktif.</strong>
								</div>
							</div>

							<?php foreach ($jadwals as $jadwal) { ?>
								<div class="card rounded-0 collapsed-card">
									<div class="card-header">
										<div class="card-title">
											<strong>
												<?= $jadwal->deskripsi ?>
											</strong>
										</div>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse">
												<i class="fas fa-plus"></i>
											</button>
										</div>
									</div>
									<div class="card-body">

										<table class="table  table-hover text-wrap">
											<thead>
												<tr>
													<th class="col-1">No</th>
													<th class="col-8">Pegawai</th>
													<th class="col-3">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php $no = 1;
												foreach ($jadwal->pegawais as $pegawai) { ?>
													<tr>
														<td class="col-1"><?= $no++ ?></td>
														<td class="col-8">
															<?= $pegawai->user->name ?>
														</td>
														<td class="col-3">
															<div class="w-100 d-flex flex-row justify-content-start">
																<?php if ($pegawai->penilaian) { ?>
																	<small class="badge badge-success mr-1 align-self-center"><i class="fas fa-check"></i> Sudah Dinilai</small>
																	<a class="btn btn-success btn-sm mr-1" href="<?= base_url('penilaian/' . $pegawai->penilaian->id . '/lihat') ?>">
																		<i class="fas fa-eye  "></i>
																		Lihat
																	</a>
																<?php } else { ?>
																	<a class="btn btn-primary btn-sm mr-1" href="<?= base_url('penilaian/nilai/' . $jadwal->id . '/' . $pegawai->id) ?>">
																		<i class="fas fa-edit  "></i>
																		Nilai
																	</a>
																<?php } ?>
															</div>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
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
