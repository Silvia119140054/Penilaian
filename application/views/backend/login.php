<?php $this->load->view('templates/meta', [
	'page_title' => 'Login'
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
				<h3 class="text-center mb-3">Login</h3>
				<p class="mb-3">Selamat datang, silakan login untuk melanjutkan!</p>
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
				<form action="login" method="post">
					<div class="input-group mb-3 ">
						<input type="email" class="form-control bg-dark" placeholder="Email" name="txtUsername">
						<div class="input-group-append">
							<div class="input-group-text bg-dark">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control bg-dark" placeholder="Password" name="txtPassword">
						<div class="input-group-append">
							<div class="input-group-text bg-dark">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="mb-2 d-flex flex-row justify-content-between align-items-center">
						<div class="p-1">
							<div class="icheck-primary">
								<input class=" " type="checkbox" id="remember">
								<label for="remember">
									Remember Me
								</label>
							</div>
						</div>
						<div class="p-1">
							<a href="<?=base_url('forgot_password') ?>">Lupa Password</a>
						</div>
					</div>
					<button type="submit" class="mb-2 btn btn-primary btn-block">Login</button>
					<p class="text-center mb-2">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar</a></p>
				</form>
			</div>
		</div>
	</div>


</body>

<?php $this->load->view('templates/footer'); ?>
