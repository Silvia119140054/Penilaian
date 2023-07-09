<?php $this->load->view('templates/meta', [
	'page_title' => 'Buat Password Baru'
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
				<h3 class="text-center mb-3">Password Baru</h3>
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
				<form action="<?= base_url('new_password?token=' . $token) ?>" method="post">
					<div class="form-group row mb-3">
						<!-- <label class="col-12 col-lg-3 col-form-label" for="txtNewPassword">Password baru</label> -->
						<div class="col-12 col-lg-9">
							<input class="form-control <?= form_error('txtNewPassword') ? 'is-invalid' : '' ?>" type="password" name="txtNewPassword" id="txtNewPassword" placeholder="Password baru">
							<div class="invalid-feedback">
								<?= form_error('txtNewPassword'); ?>
							</div>
						</div>
					</div>
					<div class="form-group row mb-3">
						<!-- <label class="col-12 col-lg-3 col-form-label" for="txtNewPasswordConfirm">Konfirmasi password</label> -->
						<div class="col-12 col-lg-9">
							<input class="form-control <?= form_error('txtNewPasswordConfirm') ? 'is-invalid' : '' ?>" type="password" name="txtNewPasswordConfirm" id="txtNewPasswordConfirm" placeholder="Konfirmasi password">
							<div class="invalid-feedback">
								<?= form_error('txtNewPasswordConfirm'); ?>
							</div>
						</div>
					</div>
					<div class="mb-2 d-flex flex-row justify-content-between align-items-center">
						<button type="submit" class="mb-2 btn btn-success btn-block">Kirim</button>
					</div>
					<p class="text-center mb-2">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar</a></p>
				</form>
			</div>
		</div>
	</div>
</body>

<?php $this->load->view('templates/footer'); ?>