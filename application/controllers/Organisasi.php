<?php

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

defined('BASEPATH') or exit('No direct script access allowed');

class Organisasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth_model->role_validator(['admin']);
		$this->load->model('organisasi_model');
		$this->load->model('penilaian_model');
		$this->load->model('pegawai_model');
		$this->user = $this->auth_model->current_user();
	}

	public function dinas_jabatan()
	{
		$dinases = $this->organisasi_model->get_dinases();
		$jabatans = $this->organisasi_model->get_jabatans();

		// return;
		$this->load->view('organisasi/index', [
			'dinases' => $dinases,
			'jabatans' => $jabatans,
			'user' => $this->user
		]);
	}

	// PEGAWAI 
	public function pegawai()
	{

		$this->load->model('pegawai_model');
		$pegawais = $this->pegawai_model->get_pegawais();
		$dinases = $this->organisasi_model->get_dinases();
		$jabatans = $this->organisasi_model->get_jabatans();

		$this->load->view('organisasi/pegawai/index', [
			'user' => $this->user,
			'pegawais' => $pegawais
		]);
	}

	public function pegawai_import()
	{
		$this->load->view('organisasi/pegawai/import', [
			'user' => $this->user,
		]);
	}

	public function pegawai_import_file()
	{
		// check if file exist
		if (empty($_FILES['file']['name'])) {
			echo json_encode([
				'status' => 404,
				'message' => 'Tidak ada file'
			]);
			http_response_code(404);
			return;
		}

		$config['upload_path'] = UPLOAD_PATH_TMP_FILE_PEGAWAI;
		$config['allowed_types'] = 'xlsx|csv';
		$config['max_size'] = 10000;
		$config['file_name'] = 'tmp_file_pegawai';
		$this->load->library('upload', $config);

		if (!is_dir(UPLOAD_PATH_TMP_FILE_PEGAWAI)) {
			mkdir(UPLOAD_PATH_TMP_FILE_PEGAWAI);
		}

		if (file_exists(UPLOAD_PATH_TMP_FILE_PEGAWAI . 'tmp_file_pegawai.csv') && !is_dir(UPLOAD_PATH_TMP_FILE_PEGAWAI . 'tmp_file_pegawai.csv')) {
			$this->load->helper('file');
			unlink(UPLOAD_PATH_TMP_FILE_PEGAWAI . 'tmp_file_pegawai.csv');
		}
		if (file_exists(UPLOAD_PATH_TMP_FILE_PEGAWAI . 'tmp_file_pegawai.xlsx') && !is_dir(UPLOAD_PATH_TMP_FILE_PEGAWAI . 'tmp_file_pegawai.xlsx')) {
			$this->load->helper('file');
			unlink(UPLOAD_PATH_TMP_FILE_PEGAWAI . 'tmp_file_pegawai.xlsx');
		}

		if (!$this->upload->do_upload('file')) {
			echo json_encode([
				'status' => 500,
				'message' => 'Gagal menyimpan file'
			]);
			http_response_code(404);
			return;
		}

		$fileInfo = $this->upload->data();

		$spreadsheet = null;
		$sheetData = [];
		switch ($fileInfo['file_ext']) {
			case '.xlsx':
				$reader = new Xlsx();
				$spreadsheet  = $reader->load(UPLOAD_PATH_TMP_FILE_PEGAWAI . 'tmp_file_pegawai.xlsx');
				$sheetData = $spreadsheet->getActiveSheet()->toArray();

				break;
			case '.csv':
				$reader = new Csv();
				$spreadsheet = $reader->load(UPLOAD_PATH_TMP_FILE_PEGAWAI . 'tmp_file_pegawai.csv');
				$sheetData = $spreadsheet->getActiveSheet()->toArray();

				break;
		}

		// pindahkan data pegawai ke array
		$pegawais = [];
		if (count($sheetData) > 1) {
			for ($i = 1; $i < count($sheetData); $i++) {
				$pegawai = [
					'name' => $sheetData[$i][0],
					'username' => $sheetData[$i][1],
					'email' => $sheetData[$i][2],
					'nip' => $sheetData[$i][3],
				];
				array_push($pegawais, $pegawai);
			}
		}

		$this->load->model('pegawai_model');
		$success = 0;
		$added = [];
		foreach ($pegawais as $pegawai) {
			$check = $this->pegawai_model->check_regist_data($pegawai['name'], $pegawai['username'], $pegawai['email'], $pegawai['nip']);
			if ($check === true) {
				if ($this->pegawai_model->create_pegawai($pegawai['name'], $pegawai['username'], $pegawai['email'], $pegawai['nip'])) {
					$success++;
					array_push($added, [
						'name' => $pegawai['name'],
						'message' => 'Sukses'
					]);
				}
			} else {
				array_push($added, [
					'name' => $pegawai['name'],
					'message' => $check['message']
				]);
			}
		}

		echo json_encode([
			'status' => 200,
			'message' => "Berhasil menambahkan $success data pegawai",
			'data' => $added
		]);
		http_response_code(200);
	}

	public function pegawai_edit($id = null)
	{
		if (is_null($id)) {
			$id = $this->input->post('pegawaiId');
		}

		$pegawai = $this->pegawai_model->get_pegawai_id($id);

		if (!$pegawai) {
			$this->session->set_flashdata(['message_error' => 'Pegawai tidak valid']);
			redirect('pegawai');
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->pegawai_model->rules_edit_pegawai());

		if ($this->form_validation->run()) {
			$txtNamaPegawai = $this->input->post('txtNamaPegawai');
			$txtEmailPegawai = $this->input->post('txtEmailPegawai');
			$txtNip = $this->input->post('txtNip');
			$txtDinas = $this->input->post('txtDinas');
			$txtJabatan = $this->input->post('txtJabatan');

			if (!$this->user_model->update_profil($pegawai->user->id, $txtNamaPegawai, $txtEmailPegawai)) {
				$this->session->set_flashdata(['message_error' => 'Gagal mengupdate data pegawai']);
				return redirect('pegawai');
			}

			if (!$this->pegawai_model->update_pegawai($pegawai->id, $txtNip, $txtJabatan, $txtDinas)) {
				$this->session->set_flashdata(['message_error' => 'Gagal mengupdate data pegawai']);
				return redirect('pegawai');
			}

			$this->session->set_flashdata(['message_success' => 'Berhasil mengupdate data pegawai']);
			return redirect('pegawai');
		}

		// echo "<pre>";
		// print_r($pegawai);
		// echo "</pre>";
		// return;
		$dinases = $this->organisasi_model->get_dinases();
		$jabatans = $this->organisasi_model->get_jabatans();
		$this->load->view('organisasi/pegawai/edit', [
			'user' => $this->user,
			'pegawai' => $pegawai,
			'dinases' => $dinases,
			'jabatans' => $jabatans
		]);
	}

	public function pegawai_delete()
	{
		$pegawaiId = $this->input->post('pegawaiId');
		if (!$this->pegawai_model->delete_pegawai($pegawaiId)) {
			$this->session->set_flashdata(['message_error' => 'Gagal menghapus pegawai']);
			return redirect('pegawai');
		}

		$this->session->set_flashdata(['message_success' => 'Berhasil menghapus pegawai']);
		return redirect('pegawai');
	}

	// DINAS
	public function dinas_tambah()
	{
		$this->load->library('form_validation');
		$this->load->model('organisasi_model');

		$this->form_validation->set_rules($this->organisasi_model->rules_dinas_baru());

		if ($this->form_validation->run()) {
			$txtNamaDinas = $this->input->post('txtNamaDinas');
			if ($this->organisasi_model->create_dinas($txtNamaDinas)) {
				$this->session->set_flashdata(['message_success' => 'Berhasil menambahkan dinas baru']);
				return redirect('dinas_jabatan');
			}
		}

		$this->load->view('organisasi/dinas/tambah', [
			'user' => $this->user
		]);
	}

	public function dinas_hapus()
	{
		$id = $this->input->post('dinasId');
		$this->load->model('organisasi_model');

		$dinas = $this->organisasi_model->get_dinas_id($id);

		if (!$dinas) {
			$this->session->set_flashdata(['message_error' => 'Dinas tidak valid']);
			redirect('dinas_jabatan');
		}

		if (count($dinas->pegawais) !== 0) {
			$this->session->set_flashdata(['message_error' => 'Tidak dapat menghapus dinas. Masih terdapat pegawai pada dinas tersebut.']);
			redirect('dinas_jabatan');
		}

		if ($this->organisasi_model->delete_dinas($id)) {
			$this->session->set_flashdata(['message_success' => 'Berhasil menghapus dinas']);
		}
		return redirect('dinas_jabatan');
	}

	public function dinas_edit($id = null)
	{
		if (is_null($id)) {
			$id = $this->input->post('dinasId');
		}

		$this->load->model('organisasi_model');
		$dinas = $this->organisasi_model->get_dinas_id($id);

		if (!$dinas) {
			$this->session->set_flashdata(['message_error' => 'Dinas tidak valid']);
			redirect('dinas_jabatan');
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->organisasi_model->rules_dinas_baru());

		if ($this->form_validation->run()) {
			$txtNamaDinas = $this->input->post('txtNamaDinas');
			if ($this->organisasi_model->update_dinas($id, $txtNamaDinas)) {
				$this->session->set_flashdata(['message_success' => 'Berhasil menambahkan dinas baru']);
				return redirect('dinas_jabatan');
			}
		}

		$this->load->view('organisasi/dinas/edit', [
			'user' => $this->user,
			'dinas' => $dinas
		]);
	}

	// JABATAN
	public function jabatan_tambah()
	{
		$this->load->library('form_validation');
		$this->load->model('organisasi_model');

		$this->form_validation->set_rules($this->organisasi_model->rules_jabatan_baru());

		if ($this->form_validation->run()) {
			$txtNamaJabatan = $this->input->post('txtNamaJabatan');
			if ($this->organisasi_model->create_jabatan($txtNamaJabatan)) {
				$this->session->set_flashdata(['message_success' => 'Berhasil menambahkan jabatan baru']);
				return redirect('dinas_jabatan');
			}
		}

		$this->load->view('organisasi/jabatan/tambah', [
			'user' => $this->user
		]);
	}

	public function jabatan_hapus()
	{
		$id = $this->input->post('jabatanId');
		$this->load->model('organisasi_model');

		$jabatan = $this->organisasi_model->get_jabatan_id($id);

		if (!$jabatan) {
			$this->session->set_flashdata(['message_error' => 'Jabatan tidak valid']);
			redirect('dinas_jabatan');
		}

		if (count($jabatan->pegawais) !== 0) {
			$this->session->set_flashdata(['message_error' => 'Tidak dapat menghapus jabatan. Masih terdapat pegawai pada jabatan tersebut.']);
			redirect('dinas_jabatan');
		}

		if ($this->organisasi_model->delete_jabatan($id)) {
			$this->session->set_flashdata(['message_success' => 'Berhasil menghapus jabatan']);
		}
		return redirect('dinas_jabatan');
	}

	public function jabatan_edit($id)
	{
		if (is_null($id)) {
			$id = $this->input->post('dinasId');
		}

		$this->load->model('organisasi_model');
		$jabatan = $this->organisasi_model->get_jabatan_id($id);

		if (!$jabatan) {
			$this->session->set_flashdata(['message_error' => 'Jabatan tidak valid']);
			redirect('dinas_jabatan');
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules($this->organisasi_model->rules_jabatan_baru());

		if ($this->form_validation->run()) {
			$txtNamaJabatan = $this->input->post('txtNamaJabatan');
			if ($this->organisasi_model->update_jabatan($id, $txtNamaJabatan)) {
				$this->session->set_flashdata(['message_success' => 'Berhasil mengupdate jabatan']);
				return redirect('dinas_jabatan');
			}
		}

		$this->load->view('organisasi/jabatan/edit', [
			'user' => $this->user,
			'jabatan' => $jabatan
		]);
	}
}
