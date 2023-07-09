<?php
$this->load->view('templates/meta', [
	'page_title' => 'Riwayat Penilaian'
]); ?>

<link rel="stylesheet" href="<?= base_url('plugins') ?>/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('plugins') ?>/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url('plugins') ?>/datatables-buttons/css/buttons.bootstrap4.min.css">

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
					<?php $this->load->view('templates/header_message'); ?>
					<h2>Riwayat Penilaian</h2>
					<hr>
					<div class="row">
						<div class="col-12 col-lg-8">
							<div class="card">
								<div class="card-body">
									<table class="table table-bordered table-striped" id="tabelRiwayat">
										<thead>
											<tr>
												<th class="col-1">No</th>
												<th class="col-2">Tanggal</th>
												<th class="col-2">Nama Jadwal</th>
												<th class="col-2">Nama pegawai</th>
												<th class="col-2">NIP</th>
												<th class="col-3">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											foreach ($penilaians as $penilaian) { ?>
												<tr>
													<td class="col-1">
														<?= $no++; ?>
													</td>
													<td class="col-2">
														<?= $penilaian->created_at ?>
													</td>
													<td class="col-2">
														<?= $penilaian->jadwal->deskripsi ?>
													</td>
													<td class="col-2">
														<?= $penilaian->pegawai_dinilai->user->name ?>
													</td>
													<td class="col-2">
														<?= $penilaian->pegawai_dinilai->nip ?>
													</td>
													<td class="col-3">
														<div class="w-100 d-flex flex-row justify-content-start">
															<a class="btn btn-success btn-sm mr-1" href="<?= base_url('penilaian/' . $penilaian->id . '/lihat') ?>">
																<i class="fas fa-eye"></i> Lihat
															</a>
															<button class="btn btn-danger btn-sm mr-1" onclick="hapusRiwayat(this)" riwayatId="<?= $penilaian->id ?>" dinilaiName="<?= $penilaian->pegawai_dinilai->user->name ?>" data-toggle="modal" data-target="#modal-delete-riwayat">
																<i class="fas fa-trash  "></i>
																Hapus
															</button>
														</div>
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
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
	<div class="modal fade" id="modal-delete-riwayat">
		<div class="modal-dialog">
			<div class="modal-content  ">
				<div class="modal-header">
					<h4 class="modal-title">Hapus Riwayat</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Anda akan penilaian untuk <span id="dinilaiNameField"></span></p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Tutup</button>
					<form action="<?= base_url('riwayat/hapus') ?>" method="post">
						<input type="hidden" name="penilaianId" value="" id="penilaianIdField">
						<button type="submit" class="btn btn-sm btn-danger btn-block">
							<i class="fas fa-trash"></i>
							Hapus
						</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</body>

<script src="<?= base_url('plugins') ?>/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('plugins') ?>/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('plugins') ?>/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('plugins') ?>/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('plugins') ?>/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('plugins') ?>/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('plugins') ?>/jszip/jszip.min.js"></script>
<script src="<?= base_url('plugins') ?>/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('plugins') ?>/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('plugins') ?>/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('plugins') ?>/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('plugins') ?>/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
	$(function() {
		$("#tabelRiwayat").DataTable({
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"buttons": ["excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#tabelRiwayat_wrapper .col-md-6:eq(0)');

	});


	function hapusRiwayat(target) {
		var riwayatId = $(target).attr('riwayatId');
		var dinilaiName = $(target).attr('dinilaiName');
		var formField = $('#penilaianIdField');
		$(formField).val(riwayatId);
		$('#dinilaiNameField').text(dinilaiName);
	}
</script>
