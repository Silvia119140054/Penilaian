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
					<h4>
						<strong><?= $penilaian->jadwal->deskripsi ?></strong>
						oleh <strong><?= $penilaian->penilai->user->name ?></strong>
						untuk <strong><?= $penilaian->dinilai->user->name ?></strong>
					</h4>
					<hr>

					<div class="row">
						<div class="col-12 col-lg-8 mb-3">
							<div class="row mb-2">
								<span class="col-12 col-lg-2 text-lg-right">Nama :</span>
								<span class="col-12 col-lg-10 h8"><?= $penilaian->dinilai->user->name ?></span>
							</div>
							<div class="row mb-2">
								<span class="col-12 col-lg-2 text-lg-right">NIP :</span>
								<span class="col-12 col-lg-10 h8"><?= $penilaian->dinilai->nip ?></span>
							</div>
							<div class="row mb-2">
								<span class="col-12 col-lg-2 text-lg-right">Dinas :</span>
								<span class="col-12 col-lg-10 h8"><?= $this->organisasi_model->get_dinas_id($penilaian->dinilai->dinas_id)->name ?></span>
							</div>
							<div class="row mb-2">
								<span class="col-12 col-lg-2 text-lg-right">Jabatan :</span>
								<span class="col-12 col-lg-10 h8"><?= $this->organisasi_model->get_jabatan_id($penilaian->dinilai->jabatan_id)->name ?></span>
							</div>
						</div>
						<div class="col-12 col-lg-8">
							<div class="card ">
								<div class="card-body">
									<div class="row">
										<div class="col-3 col-lg-4 text-center">
											<input type="text" class="knob" value="<?= intval($this->penilaian_model->calculate_certainty_penilaian_id($penilaian->id)) ?>" data-width="150" data-height="150" data-fgColor="#28a745" readonly>
											<div class="knob-label mt-2">Performa</div>
										</div>
										<div class="col-9 col-lg-8 d-flex flex-column justify-content-center flex-wrap">
											<p>
												Anda telah melakukan penilaian terhadap <strong><?= $penilaian->dinilai->user->name ?></strong>. Hasil penilaian yang telah anda
												lakukan mendapatkan hasil seperti yang tertera dibawah. Untuk melihat <strong>Grafik Hasil Penilaian</strong>
												silakan klik tombol <strong>Lihat Grafik</strong> yang ada di bawah.
											</p>
											<p>
												Nilai angka 
												<strong><?= $this->penilaian_model->calculate_certainty_penilaian_id($penilaian->id) ?> % </strong><br>
											</p>
											<p>
											    Predikat penilaian: 
												<strong><?= $this->penilaian_model->get_predicate_penilaian_id($penilaian->id) ?></strong> 
											</p>
										</div>
									</div>
								</div>
							</div>
							<a class="btn btn-success float-right" href="<?= base_url('grafik/pegawai/' . $penilaian->dinilai->id) ?>">Lihat Grafik</a>
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

<script src="<?= base_url('plugins') ?>/jquery-knob/jquery.knob.min.js"></script>
<script>
	$(function() {
		/* jQueryKnob */

		$('.knob').knob({
			/*change : function (value) {
			 //console.log("change : " + value);
			 },
			 release : function (value) {
			 console.log("release : " + value);
			 },
			 cancel : function () {
			 console.log("cancel : " + this.value);
			 },*/
			// draw: function() {

			// 	// "tron" case
			// 	if (this.$.data('skin') == 'tron') {

			// 		var a = this.angle(this.cv) // Angle
			// 			,
			// 			sa = this.startAngle // Previous start angle
			// 			,
			// 			sat = this.startAngle // Start angle
			// 			,
			// 			ea // Previous end angle
			// 			,
			// 			eat = sat + a // End angle
			// 			,
			// 			r = true

			// 		this.g.lineWidth = this.lineWidth

			// 		this.o.cursor &&
			// 			(sat = eat - 0.3) &&
			// 			(eat = eat + 0.3)

			// 		if (this.o.displayPrevious) {
			// 			ea = this.startAngle + this.angle(this.value)
			// 			this.o.cursor &&
			// 				(sa = ea - 0.3) &&
			// 				(ea = ea + 0.3)
			// 			this.g.beginPath()
			// 			this.g.strokeStyle = this.previousColor
			// 			this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
			// 			this.g.stroke()
			// 		}

			// 		this.g.beginPath()
			// 		this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
			// 		this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
			// 		this.g.stroke()

			// 		this.g.lineWidth = 2
			// 		this.g.beginPath()
			// 		this.g.strokeStyle = this.o.fgColor
			// 		this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
			// 		this.g.stroke()

			// 		return false
			// 	}
			// }
		})
		/* END JQUERY KNOB */


	})
</script>