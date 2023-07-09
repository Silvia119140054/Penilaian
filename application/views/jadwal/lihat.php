<?php
$this->load->view('templates/meta', [
	'page_title' => 'Jadwal Penilaian'
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
			'menu_location' => 'pengaturan_jadwal'
		]); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"><?= $jadwal->deskripsi ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('/beranda') ?>">Dashboard</a></li>
								<li class="breadcrumb-item active"><a href="<?= base_url('jadwal') ?>">Jadwal Penilaian</a></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">

				<div class="container-fluid">
					<?php $this->load->view('templates/header_message'); ?>
					<div class="row">
						<div class="col-12 col-lg-8 mb-4">
							<div class="card bg-light rounded-0">
								<div class="card-body">
									<div class="row mt-4">
										<div class="col-2 text-center">
											<input type="text" class="knob" value="<?= intval(($telah_menilai / $total_penilaian) * 100) ?>%" data-width="100" data-height="100" data-fgColor="#932ab6">
											<div class="knob-label"><?= $telah_menilai ?> dari <?= $total_penilaian ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div><!-- /.container-fluid -->
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


	<div class="modal fade" id="modal-delete-jadwal">
		<div class="modal-dialog">
			<div class="modal-content  ">
				<div class="modal-header">
					<h4 class="modal-title">Hapus jadwal penilaian</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Anda akan menghapus jadwal penilaian</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Tutup</button>
					<form action="<?= base_url('jadwal/hapus') ?>" method="post">
						<input type="hidden" name="idJadwal" value="5" id="idJadwalFieldHapus">
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

	<div class="modal fade" id="modal-selesai-jadwal">
		<div class="modal-dialog">
			<div class="modal-content  ">
				<div class="modal-header">
					<h4 class="modal-title">Selesaikan jadwal penilaian</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Jadwal penilaian akan selesai</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Tutup</button>
					<form action="<?= base_url('jadwal/selesai') ?>" method="post">
						<input type="hidden" name="idJadwal" value="5" id="idJadwalFieldSelesai">
						<button type="submit" class="btn btn-sm btn-success btn-block">
							<i class="fas fa-check"></i>
							Selesai
						</button>
					</form>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</body>

<!-- jQuery Knob -->
<script src="<?= base_url('plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<script>
	function hapusJadwal(target) {
		var idjadwal = $(target).attr('idJadwal');
		var formField = $('#idJadwalFieldHapus');
		$(formField).val(idjadwal);
		console.log(formField);
	}

	function selesaiJadwal(target) {
		var idjadwal = $(target).attr('idJadwal');
		var formField = $('#idJadwalFieldSelesai');
		$(formField).val(idjadwal);
		console.log(idjadwal);
	}


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
			draw: function() {

				// "tron" case
				if (this.$.data('skin') == 'tron') {

					var a = this.angle(this.cv) // Angle
						,
						sa = this.startAngle // Previous start angle
						,
						sat = this.startAngle // Start angle
						,
						ea // Previous end angle
						,
						eat = sat + a // End angle
						,
						r = true

					this.g.lineWidth = this.lineWidth

					this.o.cursor &&
						(sat = eat - 0.3) &&
						(eat = eat + 0.3)

					if (this.o.displayPrevious) {
						ea = this.startAngle + this.angle(this.value)
						this.o.cursor &&
							(sa = ea - 0.3) &&
							(ea = ea + 0.3)
						this.g.beginPath()
						this.g.strokeStyle = this.previousColor
						this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
						this.g.stroke()
					}

					this.g.beginPath()
					this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
					this.g.stroke()

					this.g.lineWidth = 2
					this.g.beginPath()
					this.g.strokeStyle = this.o.fgColor
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
					this.g.stroke()

					return false
				}
			}
		})
		/* END JQUERY KNOB */
	})
</script>