<?php $this->load->view('templates/meta', [
	'page_title' => 'Reset Password'
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
				<h3 class="text-center mb-3">Kode Verifikasi</h3>
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
				<p>
					Silakan memasukkan kode verifikasi yang telah dikirim ke e-mail anda.
				</p>
				<form action="<?= base_url('password_reset_request') ?>" method="post">
					<input type="hidden" name="email" value="<?= $email ?>">
					<div class="form-group row">
						<!-- <label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Username</label> -->
						<div class="col-12 ">
							<input type="number" maxlength="4" class="form-control form-control-lg" name="txtPin" id="txtPin">
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