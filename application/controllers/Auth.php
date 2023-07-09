<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('auth_model');
		$this->user = $this->auth_model->current_user();

		if (!$this->user) {
			redirect('login');
		}

		redirect('beranda');
	}

	public function login_page()
	{
		$this->load->library('form_validation');
		$this->load->view('backend/login');
	}

	public function login_proc()
	{
		$this->load->model('auth_model');
		$this->load->library('form_validation');

		$rules = $this->auth_model->rules();
		$this->form_validation->set_rules($rules);

		if (!$this->form_validation->run()) {
			redirect('login');
		}

		$username = $this->input->post('txtUsername');
		$password = $this->input->post('txtPassword');

		$loginRes = $this->auth_model->login($username, $password);
		if ($loginRes[0]) {
			redirect('auth');
		} else {
			$this->session->set_flashdata('message_error', $loginRes[1]);
			$this->load->view('backend/login');
		}
	}

	public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect('auth');
	}

	public function register()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules($this->auth_model->rules_register());

		if ($this->form_validation->run()) {
			$this->load->model('user_model');
			$txtNamaLengkap = $this->input->post('txtNamaLengkap');
			$txtUsername = $this->input->post('txtUsername');
			$txtEmail = $this->input->post('txtEmail');
			$txtPassword = $this->input->post('txtPassword');
			$txtPasswordConfirm = $this->input->post('txtPasswordConfirm');
			$txtNip = $this->input->post('txtNip');

			// cek email
			if (!$this->user_model->cek_email($txtEmail)) {
				// cek username
				if (!$this->user_model->cek_username($txtUsername)) {
					// cek  password and password confirm
					if ($txtPasswordConfirm === $txtPassword) {
						// register
						if ($this->user_model->register($txtNamaLengkap, $txtUsername, $txtEmail, $txtPassword)) {
							$user = $this->user_model->get_user_email($txtEmail);
							// create pegawai
							$this->load->model('pegawai_model');
							if ($this->pegawai_model->create($user->id, $txtNip, null, null)) {
								$this->session->set_flashdata(['message_success' => 'Berhasil membuat akun baru, silakan login']);
								return redirect('login');
							} else {
								$this->session->set_flashdata(['message_error' => 'Gagal menyimpan data pegawai']);
							}
						} else {
							$this->session->set_flashdata(['message_error' => 'Gagal menyimpan data']);
						}
					} else {
						$this->session->set_flashdata(['message_error' => 'Konfirmasi password salah']);
					}
				} else {
					$this->session->set_flashdata(['message_error' => 'Username sudah terdaftar']);
				}
			} else {
				$this->session->set_flashdata(['message_error' => 'Email sudah terdaftar']);
			}
		}
		$this->load->view('backend/register');
	}

	public function forgot_password()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->auth_model->rules_forgot_password());

		if ($this->form_validation->run()) {
			$txtEmail = $this->input->post('txtEmail');
			$this->load->model('user_model');
			if ($this->user_model->cek_email($txtEmail)) {

				// generate pin
				$pin = $this->user_model->generate_password_reset($txtEmail);

				// send
				if ($pin) {
					$config = [
						'mailtype'  => 'html',
						'charset'   => 'utf-8',
						'protocol'  => 'smtp',
						'smtp_host' => MAIL_SMTP_HOST,
						'smtp_user' => MAIL_SMTP_USER,  // Email gmail
						'smtp_pass'   => MAIL_SMTP_PASS,  // Password gmail
						'smtp_crypto' => MAIL_SMTP_CRYPTO,
						'smtp_port'   => MAIL_SMTP_PORT,
						'crlf'    => "\r\n",
						'newline' => "\r\n"
					];
					$this->load->library('email', $config);

					$this->email->from(MAIL_APP_NOREPLY, 'Sistem Penilaian');
					$this->email->subject('Pin reset password');
					$this->email->to($txtEmail);
					$this->email->message('Pin reset password anda adalah: ' . $pin);
					if ($this->email->send()) {
						return redirect('password_reset_pin?email=' . $txtEmail);
					} else {
						print_r($this->email->print_debugger());
						return;
						$this->session->set_flashdata(['message_error' => 'Gagal mengirim email']);
					}
				} else {
					$this->session->set_flashdata(['message_error' => 'Gagal membuat pin']);
				}
			} else {
				$this->session->set_flashdata(['message_error' => 'Email tidak ditemukan']);
			}
		}

		$this->load->view('backend/password_forgot');
	}

	public function password_reset_pin()
	{
		$txtEmail = $this->input->get('email');
		if (is_null($txtEmail) || $txtEmail === '') {
			$this->session->set_flashdata(['message_error' => 'Email tidak valid']);
			redirect('forgot_password');
		}

		$this->load->view('backend/password_reset_pin', [
			'email' => $txtEmail
		]);
	}

	public function password_reset_request()
	{
		$txtEmail = $this->input->post('email');
		$txtPin = $this->input->post('txtPin');

		$this->load->model('user_model');
		$token = $this->user_model->generate_reset_token($txtEmail, $txtPin);
		if ($token) {
			return redirect('new_password?token=' . $token);
		}

		$this->session->set_flashdata(['message_error' => 'Token tidak valid']);
		redirect('forgot_password');
	}

	public function new_password()
	{
		$txtToken = $this->input->get('token');
		if (is_null($txtToken) || $txtToken === '') {
			$this->session->set_flashdata(['message_error' => 'Token tidak valid']);
			redirect('forgot_password');
		}

		$this->load->library('form_validation');
		$this->load->model('user_model');

		$this->form_validation->set_rules($this->user_model->rules_new_password_reset());
		if ($this->form_validation->run()) {
			$txtNewPassword = $this->input->post('txtNewPassword');
			$txtNewPasswordConfirm = $this->input->post('txtNewPasswordConfirm');

			if ($txtNewPassword === $txtNewPasswordConfirm) {
				if ($this->user_model->password_reset_token($txtToken, $txtNewPassword)) {
					$this->session->set_flashdata(['message_success' => 'Berhasil mereset password, silakan login']);
					return redirect('login');
				}
				$this->session->set_flashdata(['message_success' => 'Konfirmasi password salah']);
				return redirect('new_password?token=' . $txtToken);
			}
		}

		$this->load->view('backend/password_reset_new_password', [
			'token' => $txtToken
		]);
	}
}
