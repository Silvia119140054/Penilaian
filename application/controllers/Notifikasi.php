<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth_model->role_validator();
		$this->user = $this->auth_model->current_user();
		$this->load->model('notifikasi_model');
	}

	public function index()
	{
		$notifikasis = $this->notifikasi_model->get_notifikasis();
		foreach ($notifikasis as $notifikasi) {
			$notifikasi->is_seen = $this->notifikasi_model->is_seen_by_uid($notifikasi->id, $this->user->id);
		}
		$this->load->view('beranda/notifikasi', [
			'user' => $this->user,
			'notifikasis' => $notifikasis
		]);
	}

	public function read($id)
	{
		$notifikasi = $this->notifikasi_model->get_notifikasi_id($id);
		$notifikasi->is_seen = $this->notifikasi_model->is_seen_by_uid($notifikasi->id, $this->user->id);
		$this->load->view('beranda/notifikasi_view', [
			'user' => $this->user,
			'notifikasi' => $notifikasi
		]);
	}

	public function tandai($id)
	{
		$this->notifikasi_model->add_seen_by_id($id, $this->user->id);
		return redirect('notifikasi/' . $id);
	}

	public function pengaturan_index()
	{
		$notifikasis = $this->notifikasi_model->get_notifikasis();

		$this->load->view('notifikasi/index_pengaturan', [
			'notifikasis' => $notifikasis
		]);
	}

	public function new()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules($this->notifikasi_model->rules_create());
		if ($this->form_validation->run()) {
			$txtTitle = $this->input->post('txtTitle');
			$txtInfo = $this->input->post('txtInfo');

			if ($this->notifikasi_model->create($txtTitle, $txtInfo, $this->user->id)) {
				$this->session->set_flashdata(['message_success' => 'Berhasil membuat notifikasi']);
				redirect('pengaturan_notifikasi');
			}
			$this->session->set_flashdata(['message_error' => 'Gagal membuat notifikasi']);
		}

		$this->load->view('notifikasi/create');
	}

	public function edit($id)
	{
		$notifikasi = $this->notifikasi_model->get_notifikasi_id($id);

		if (!$notifikasi) {
			$this->session->set_flashdata(['message_error' => 'Notifikasi tidak valid']);
			redirect('pengaturan_notifikasi');
		}
		$this->load->library('form_validation');

		$this->form_validation->set_rules($this->notifikasi_model->rules_create());
		if ($this->form_validation->run()) {
			$txtTitle = $this->input->post('txtTitle');
			$txtInfo = $this->input->post('txtInfo');

			if ($this->notifikasi_model->update($id, $txtTitle, $txtInfo, $this->user->id)) {
				$this->notifikasi_model->reset_viewer($id);
				$this->session->set_flashdata(['message_success' => 'Berhasil mengupdate notifikasi']);
				redirect('pengaturan_notifikasi');
			}
			$this->session->set_flashdata(['message_success' => 'Gagal mengupdate notifikasi']);
			redirect('pengaturan_notifikasi');
		}

		$this->load->view('notifikasi/edit', [
			'notifikasi' => $notifikasi
		]);
	}

	public function hapus($id = null)
	{
		if (is_null($id)) {
			$id = $this->input->post('notifikasiId');
		}
		$notifikasi = $this->notifikasi_model->get_notifikasi_id($id);

		if (!$notifikasi) {
			$this->session->set_flashdata(['message_error' => 'Notifikasi tidak valid']);
			redirect('pengaturan_notifikasi');
		}

		if ($this->notifikasi_model->delete($id)) {
			$this->session->set_flashdata(['message_success' => 'Berhasil menghapus notifikasi']);
			redirect('pengaturan_notifikasi');
		}
		$this->session->set_flashdata(['message_success' => 'Gagal menghapus notifikasi']);
		redirect('pengaturan_notifikasi');
	}
}
