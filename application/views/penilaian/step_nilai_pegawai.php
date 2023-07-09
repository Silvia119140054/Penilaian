<?php
$this->load->view('templates/meta', [
	'page_title' => 'Menilai Pegawai'
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
					<h5>Jadwal <strong><?= $jadwal->deskripsi ?></strong></h5>
					<h6> Nilai Pegawai <strong><?= $pegawai->user->name ?></strong></h6>
					<hr>

					<div class="row">
						<div class="col col-lg-8">
							<div class="small-box mb-3">
								<div class="inner bg-green">
									Anda akan melakukan penilaian terhadap <strong><?= $pegawai->user->name ?></strong>. Silakan memilih skala penilaian sesuai dengan kondisi yang ada.
									Apabila anda telah mengisi semua penilaian yang diminta, maka untuk melihat hasil penilaian silakan untuk mengklik tombol <strong>Lihat Hasil</strong> yang ada di bawah.
								</div>
							</div>
							<form action="<?= base_url('penilaian/nilai/' . $jadwal->id . '/' . $pegawai->id) ?>" method="post">
								<input type="hidden" name="txtIdPegawai" value="<?= $pegawai->id ?>">
								<input type="hidden" name="txtIdJadwal" value="<?= $jadwal->id ?>">
								<div class="card">
									<div class="card-body">
										<table class="table table-bordered table-hover text-wrap">
											<thead>
												<tr>
													<th>No</th>
													<th>Kode</th>
													<th>Faktor Penilaian</th>
													<th>Pilih</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												foreach ($faktors as $faktor) { ?>
													<tr>
														<td><?= $no++ ?></td>
														<td><?= $faktor->code_name ?></td>
														<td><?= $faktor->alias ?></td>
														<td class="form-group">
															<select class="form-control <?= form_error($faktor->code_name) ? 'is-invalid' : '' ?>" name="<?= $faktor->code_name ?>" id="txtNilai">
																<?php if (set_value($faktor->code_name)) { ?>
																	<option value="<?= set_value($faktor->code_name) ?>"><?= $this->penilaian_model->get_nilai_id(set_value($faktor->code_name))->alias ?></option>
																<?php } else { ?>
																	<option value="" selected>Pilih penilaian</option>
																<?php } ?>
																<?php foreach ($nilais as $nilai) { ?>
																	<option value="<?= $nilai->id ?>"><?= $nilai->alias ?></option>
																<?php } ?>
															</select>
															<div class="invalid-feedback">
																<?= form_error($faktor->code_name); ?>
															</div>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>

									</div>
								</div>
								<div class="mb-1">
									<button class="btn btn-success float-right" type="submit">
										Simpan dan Lihat Hasil
										<i class="fas fa-arrow-right ml-1"></i>
									</button>
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