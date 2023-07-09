<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	private $user;
	public function __construct()
	{
		parent::__construct();
		$this->auth_model->role_validator();
		$this->user = $this->auth_model->current_user();
	}

	public function index()
	{
	}

	public function profil()
	{
		$this->load->model('pegawai_model');
		$pegawai = $this->pegawai_model->get_pegawai_uid($this->user->id);
		$this->load->view('user/profil', [
			'user' => $this->user,
			'pegawai' => $pegawai
		]);
	}

	public function updateprofil()
	{
		$this->load->library('form_validation');
		$this->load->model('organisasi_model');
		$this->load->model('pegawai_model');

		$pegawai = $this->pegawai_model->get_pegawai_uid($this->user->id);
		$dinases = $this->organisasi_model->get_dinases();
		$jabatans = $this->organisasi_model->get_jabatans();

		$this->form_validation->set_rules($this->user_model->rules_update_profil());

		// cek apakah ada file 
		if (!empty($_FILES['imgProfil']['name'])) {
			$this->load->helper('string');
			$config['upload_path'] = UPLOAD_PATH_PROFILE;
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 10000;
			$config['file_name'] = random_string('alnum', 24);

			if (!is_dir(UPLOAD_PATH_PROFILE)) {
				mkdir(UPLOAD_PATH_PROFILE);
			}

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('imgProfil')) {
				$this->session->set_flashdata(['message_error' => $this->upload->display_errors()]);
				redirect('updateprofil');
			} else {
				// delete past file 
				if (file_exists(UPLOAD_PATH_PROFILE . $this->user->avatar) && !is_dir(UPLOAD_PATH_PROFILE . $this->user->avatar)) {
					$this->load->helper('file');
					unlink(UPLOAD_PATH_PROFILE . $this->user->avatar);
				}

				// update database
				$fileInfo = $this->upload->data();
				$this->user_model->update_avatar($this->user->id, $fileInfo['file_name']);
			}
		}

		if ($this->form_validation->run()) {
			$txtNama = $this->input->post('txtNama');
			$txtNip = $this->input->post('txtNip');
			$txtEmail = $this->input->post('txtEmail');
			$txtDinas = $this->input->post('txtDinas');
			$txtJabatan = $this->input->post('txtJabatan');

			if (!$this->user_model->update_profil($this->user->id, $txtNama, $txtEmail)) {
				$this->session->set_flashdata(['message_error' => 'Gagal mengupdate profil']);
				redirect('updateprofil');
			}

			if (!$this->pegawai_model->update_pegawai($pegawai->id, $txtNip, $txtJabatan, $txtDinas)) {
				$this->session->set_flashdata(['message_error' => 'Gagal mengupdate profil']);
				redirect('updateprofil');
			}

			$this->session->set_flashdata(['message_success' => 'Berhasil mengupdate profil']);
			redirect('updateprofil');
		}

		$this->load->view('user/updateprofil', [
			'user' => $this->user,
			'pegawai' => $pegawai,
			'jabatans' => $jabatans,
			'dinases' => $dinases
		]);
	}

	public function updatesandi()
	{
		$this->load->library('form_validation');
		$this->load->model('user_model');

		$this->form_validation->set_rules($this->user_model->rules_update_sandi());

		if ($this->form_validation->run()) {
			$txtOldPassword = $this->input->post('txtOldPassword');
			$txtNewPassword = $this->input->post('txtNewPassword');
			$txtNewPasswordConfirm = $this->input->post('txtNewPasswordConfirm');


			if (!$this->user_model->cek_sandi($this->user->id, $txtOldPassword)) {
				$this->session->set_flashdata(['message_error' => 'Gagal mengganti password. Password yang anda masukkan salah']);
				redirect('updatesandi');
			}

			if ($txtNewPassword !== $txtNewPasswordConfirm) {
				$this->session->set_flashdata(['message_error' => 'Gagal mengganti password. Konfirmasi password salah']);
				redirect('updatesandi');
			}

			if (!$this->user_model->update_sandi($this->user->id, $txtNewPassword)) {
				$this->session->set_flashdata(['message_error' => 'Berhasil mengganti password']);
				redirect('profil');
			}

			$this->session->set_flashdata(['message_success' => 'Berhasil mengganti password']);
			redirect('updateprofil');
		}

		$this->load->view('user/updatesandi', [
			'user' => $this->user,
		]);
	}
}
