<?php
$this->load->view('templates/meta', [
	'page_title' => 'Daftar Pegawai'
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
			'menu_location' => 'pengaturan_pegawai'
		]); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0">Daftar Pegawai</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="<?= base_url('/pegawai') ?>">Pengaturan Pegawai</a></li>
								<li class="breadcrumb-item active"><a href="#">Import pegawai</a></li>

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
						<div class="col-4 mr-2 mb-4">
							<div class="card bg-light rounded-0">
								<div class="card-body">
									<div class="row mb-2">
										<div class="col">
											<a class="btn col btn-info" href="<?= base_url('storage/assets/template_pegawai.csv') ?>">
												<i class="fas fa-download"></i>
												Download template file
											</a>
										</div>
									</div>
									<div id="actions" class="row mb-2">
										<div class="col-12">
											<div class="btn-group w-100">
												<span class="btn btn-success fileinput-button">
													<i class="fas fa-plus"></i>
													<span>Pilih file</span>
												</span>
												<!-- <button type="submit" class="btn btn-primary col start">
													<i class="fas fa-upload"></i>
													<span>Start upload</span>
												</button>
												<button type="reset" class="btn btn-warning col cancel">
													<i class="fas fa-times-circle"></i>
													<span>Cancel upload</span>
												</button> -->
											</div>
										</div>
										<!-- <div class="col-lg-6 d-flex align-items-center">
											<div class="fileupload-process w-100">
												<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
													<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
												</div>
											</div>
										</div> -->
									</div>
									<div class="row">
										<div class="col">
											<div class="table table-striped files" id="previews">
												<div id="template" class="row mt-2 bg-secondary p-2 rounded">
													<div class="col-auto mb-1">
														<span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
													</div>
													<div class="col d-flex flex-column align-items-center mb-1 ">
														<p class="mb-0">
															<span class="lead" data-dz-name></span>
															(<span data-dz-size></span>)
														</p>
														<strong class="error text-danger" data-dz-errormessage></strong>
													</div>
													<div class="col-12 d-flex align-items-center mb-2 ">
														<div class="progress progress-striped active w-100 rounded" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
															<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
														</div>
													</div>
													<div class="col-auto d-flex align-items-center mb-1 ">
														<div class="btn-group">
															<button class="btn btn-primary start">
																<i class="fas fa-upload"></i>
																<span>Start</span>
															</button>
															<button data-dz-remove class="btn btn-warning cancel">
																<i class="fas fa-times-circle"></i>
																<span>Cancel</span>
															</button>
															<button data-dz-remove class="btn btn-danger delete">
																<i class="fas fa-trash"></i>
																<span>Delete</span>
															</button>
														</div>
													</div>
												</div>
											</div>

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

	<!-- MODALS -->
	<div class="modal fade" id="modal">
		<div class="modal-dialog">
			<div class="modal-content  ">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p class="modal-info"></p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Tutup</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</body>

<script src="<?= base_url('plugins') ?>/dropzone/min/dropzone.min.js"></script>
<script>
	// DropzoneJS Demo Code Start
	Dropzone.autoDiscover = false

	// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
	var previewNode = document.querySelector("#template")
	previewNode.id = ""
	var previewTemplate = previewNode.parentNode.innerHTML
	previewNode.parentNode.removeChild(previewNode)

	var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
		url: "<?= base_url('/pegawai/import/file') ?>", // Set the url
		paramName: "file",
		thumbnailWidth: 80,
		thumbnailHeight: 80,
		parallelUploads: 20,
		previewTemplate: previewTemplate,
		autoQueue: false, // Make sure the files aren't queued until manually added
		previewsContainer: "#previews", // Define the container to display the previews
		clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
		success: (file, response) => {
			console.log(file);
			console.log(response);
			var response = JSON.parse(response);
			$('.modal-title').text('Berhasil menambahkan data');

			var info = "<p>" + response.message
			info += "<ul>";
			response.data.forEach(data => {
				info += "<li>";
				info += data.name;
				info += " | ";
				info += data.message;
				info += "</li>";
			});
			info += "</ul>";
			info += "</p>";
			console.log(info);

			$('.modal-info').html(info);
			$('#modal').modal('show');
		},
		maxFilesize: 5, // 2 MB
		acceptedFiles: ".xlsx,.csv", // Allowed extensions

	})

	myDropzone.on("addedfile", function(file) {
		// Hookup the start button
		file.previewElement.querySelector(".start").onclick = function() {
			myDropzone.enqueueFile(file)
		}
	})
</script>