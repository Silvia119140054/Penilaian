<?php $this->load->view('templates/meta', [
	'page_title' => 'Lupa Password'
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
				<h3 class="text-center mb-3">Lupa Password</h3>
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
					Untuk mengganti password, silakan masukkan alamat email anda.
				</p>
				<form action="<?= base_url('forgot_password') ?>" method="post">
					<div class="form-group row">
						<!-- <label class="col-12 col-lg-3 col-form-label text-lg-right" for="txtNipdn">Username</label> -->
						<div class="col-12 ">
							<input type="email" class="form-control <?= form_error('txtEmail') ? 'is-invalid' : '' ?>" name="txtEmail" id="txtEmail" placeholder="Email">
							<div class="invalid-feedback">
								<?= form_error('txtEmail'); ?>
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