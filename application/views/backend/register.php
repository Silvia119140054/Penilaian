<?php $this->load->view('templates/meta', [
	'page_title' => 'Registrasi Akun'
]); ?>

<style>
	.login-card {
		background: rgba(122, 130, 136, 0.2) !important;
	}
</style>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">

		</div>
		<div class=" text-dark font-weight-bold ">
			<div class="">
				<h3 class="text-center mb-3">Registrasi</h3>
				<?php if ($this->session->flashdata('message_error')) : ?>
					<div class="alert alert-danger" role="alert">
						<?= $this->session->flashdata('message_error') ?>
					</div>
				<?php endif ?>
				<?php if ($this->session->flashdata('message_success')) : ?>
					<div class="alert alert-success" role="alert">
						<?= $this->session->flashdata('message_success') ?>
					</div>
				<?php endif ?>
				<form action="<?= base_url('register') ?>" method="post">
					<div class="form-group row">
						<!-- <label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Nama Lengkap</label> -->
						<div class="col-12 ">
							<input type="text" class="form-control <?= form_error('txtNamaLengkap') ? 'is-invalid' : '' ?>" name="txtNamaLengkap" id="txtNamaLengkap" placeholder="Nama Lengkap" value="<?= set_value('txtNamaLengkap') ?>">
							<div class="invalid-feedback">
								<?= form_error('txtNamaLengkap'); ?>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<!-- <label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Username</label> -->
						<div class="col-12 ">
							<input type="text" class="form-control <?= form_error('txtUsername') ? 'is-invalid' : '' ?>" name="txtUsername" id="txtUsername" placeholder="Username" value="<?= set_value('txtUsername') ?>">
							<div class="invalid-feedback">
								<?= form_error('txtUsername'); ?>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<!-- <label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Username</label> -->
						<div class="col-12 ">
							<input type="email" class="form-control <?= form_error('txtEmail') ? 'is-invalid' : '' ?>" name="txtEmail" id="txtEmail" placeholder="Email" value="<?= set_value('txtEmail') ?>">
							<div class="invalid-feedback">
								<?= form_error('txtEmail'); ?>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<!-- <label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Username</label> -->
						<div class="col-12 ">
							<input type="number" class="form-control <?= form_error('txtNip') ? 'is-invalid' : '' ?>" name="txtNip" id="txtNip" placeholder="NIP" value="<?= set_value('txtNip') ?>">
							<div class="invalid-feedback">
								<?= form_error('txtNip'); ?>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<!-- <label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Username</label> -->
						<div class="col-12 ">
							<input type="password" class="form-control <?= form_error('txtPassword') ? 'is-invalid' : '' ?>" name="txtPassword" id="txtPassword" placeholder="Password" value="<?= set_value('txtPassword') ?>">
							<div class="invalid-feedback">
								<?= form_error('txtPassword'); ?>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<!-- <label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Username</label> -->
						<div class="col-12 ">
							<input type="password" class="form-control <?= form_error('txtPasswordConfirm') ? 'is-invalid' : '' ?>" name="txtPasswordConfirm" id="txtPasswordConfirm" placeholder="Konfirmasi Password" value="<?= set_value('txtPasswordConfirm') ?>">
							<div class="invalid-feedback">
								<?= form_error('txtPasswordConfirm'); ?>
							</div>
						</div>
					</div>
					<div class="mb-2 d-flex flex-row justify-content-between align-items-center">
						<button type="submit" class="mb-2 btn btn-success btn-block">Daftar</button>
					</div>
					<!-- <p class="text-center mb-2">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar</a></p> -->
				</form>
			</div>
		</div>
	</div>


</body>

<?php $this->load->view('templates/footer'); ?>
