 <?php

	use PhpOffice\PhpSpreadsheet\Reader\Csv;
	use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;

	defined('BASEPATH') or exit('No direct script access allowed');

	class Admin extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->auth_model->role_validator(['admin']);
			$this->load->model('organisasi_model');
			$this->load->model('penilaian_model');
			$this->user = $this->auth_model->current_user();
		}

		public function index()
		{
			$this->load->model('pegawai_model');
			$this->load->model('organisasi_model');
			$pegawais = $this->pegawai_model->get_pegawais();
			$dinases = $this->organisasi_model->get_dinases();
			$jabatans = $this->organisasi_model->get_jabatans();

			$this->load->view('admin/dashboard', [
				'user' => $this->user,
				'pegawais' => $pegawais,
				'jabatans' => $jabatans,
				'dinases' => $dinases,
			]);
		}
	}
