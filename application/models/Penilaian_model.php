<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Penilaian_model extends CI_Model
{
	private $_table = TABEL_PENILAIAN;
	public
		$_id,
		$_created_at,
		$_updated_at,
		$_release_at,
		$_created_by,
		$_title,
		$_info;

	// get penilaian
	public function get_penilaian_id($id)
	{
		$query = $this->db
			->where('id', $id)
			->get($this->_table);

		$penilaian = $query->row();
		if ($penilaian) {
			$this->load->model('pegawai_model');
			$penilaian->penilai = $this->pegawai_model->get_pegawai_id($penilaian->penilai_pegawai_id);
			$penilaian->dinilai = $this->pegawai_model->get_pegawai_id($penilaian->dinilai_pegawai_id);
			$penilaian->jadwal = $this->get_jadwal_id($penilaian->jadwal_id);
		}

		return $penilaian;
	}

	public function get_penilaian_penilai_dinilai($id_penilai, $id_dinilai)
	{
		$query = $this->db
			->where('penilai_pegawai_id', $id_penilai)
			->where('dinilai_pegawai_id', $id_dinilai)
			->get($this->_table);


		$penilaian = $query->row();
		if ($penilaian) {
			$this->load->model('pegawai_model');
			$penilaian->pegawai_penilai = $this->pegawai_model->get_pegawai_id($penilaian->penilai_pegawai_id);
			$penilaian->pegawai_dinilai = $this->pegawai_model->get_pegawai_id($penilaian->dinilai_pegawai_id);
		}
		return $penilaian;
	}

	public function get_penilaian_jadwal_penilai_dinilai($id_jadwal, $id_penilai, $id_dinilai)
	{
		$query = $this->db
			->where('jadwal_id', $id_jadwal)
			->where('penilai_pegawai_id', $id_penilai)
			->where('dinilai_pegawai_id', $id_dinilai)
			->get($this->_table);

		$penilaian = $query->row();
		if ($penilaian) {
			$this->load->model('pegawai_model');
			$penilaian->pegawai_penilai = $this->pegawai_model->get_pegawai_id($penilaian->penilai_pegawai_id);
			$penilaian->pegawai_dinilai = $this->pegawai_model->get_pegawai_id($penilaian->dinilai_pegawai_id);
		}
		return $penilaian;
	}

	public function get_penilaians_jadwal_id($id_jadwal)
	{
		$query = $this->db
			->where('jadwal_id', $id_jadwal)
			->get(TABEL_PENILAIAN);
		$penilaians = $query->result();

		return $penilaians;
	}

	public function get_penilaians_penilai_id($id)
	{
		$query = $this->db
			->where('penilai_pegawai_id', $id)
			->get($this->_table);

		$penilaians = $query->result();
		if ($penilaians) {
			$this->load->model('pegawai_model');

			foreach ($penilaians as $penilaian) {
				$pegawai_dinilai = $this->pegawai_model->get_pegawai_id($penilaian->dinilai_pegawai_id);
				$penilaian->pegawai_dinilai = $pegawai_dinilai;
			}
		}
		return $penilaians;
	}

	public function get_penilaians_dinilai_id($id)
	{
		$query = $this->db
			->where('dinilai_pegawai_id', $id)
			->get($this->_table);

		$penilaians = $query->result();
		if ($penilaians) {
			$this->load->model('pegawai_model');

			foreach ($penilaians as $penilaian) {
				$pegawai_penilai = $this->pegawai_model->get_pegawai_id($penilaian->dinilai_pegawai_id);
				$penilaian->pegawai_penilai = $pegawai_penilai;
			}
		}
		return $penilaians;
	}

	public function get_penilaians_jadwal_dinilai($id_jadwal, $id_dinilai)
	{
		$query = $this->db
			->where('jadwal_id', $id_jadwal)
			->where('dinilai_pegawai_id', $id_dinilai)
			->get(TABEL_PENILAIAN);
		$penilaians = $query->result();

		return $penilaians;
	}

	public function get_faktor_penilaians()
	{
		$query = $this->db
			->get(TABEL_REGISTER_FAKTOR_PENILAIAN);

		$faktors = $query->result();

		foreach ($faktors as $item) {
			// $item->code_name = 'F-' . $item->id;
		}

		return $faktors;
	}

	public function get_faktor_penilaian_id($id)
	{
		$query = $this->db
			->where('id', $id)
			->get(TABEL_REGISTER_FAKTOR_PENILAIAN);

		$faktor = $query->row();

		if ($faktor) {
			// $faktor->code_name = 'F-' . $faktor->id;
		}

		return $faktor;
	}

	// create faktor
	public function create_faktor($nama_faktor, $nilai_cf)
	{
		$this->db
			->set('alias', $nama_faktor)
			->set('nilai_cf', $nilai_cf);

		$status = $this->db->insert(TABEL_REGISTER_FAKTOR_PENILAIAN);
		if ($status) {
			$id = $this->db->insert_id();
			$this->db
				->set('code_name', FAKTOR_CODE_NAME_INITIAL . $id)
				->where('id', $id);
			$this->db->update(TABEL_REGISTER_FAKTOR_PENILAIAN);
		}
		return $status;
	}

	function update_faktor($id, $nama_faktor, $nilai_cf)
	{
		$this->db
			->set('alias', $nama_faktor)
			->set('nilai_cf', $nilai_cf)
			->where('id', $id);
		return $this->db->update(TABEL_REGISTER_FAKTOR_PENILAIAN);
	}

	function delete_faktor($id)
	{
		$this->db
			->where('id', $id);
		return $this->db->delete(TABEL_REGISTER_FAKTOR_PENILAIAN);
	}

	public function rules_faktor_baru()
	{
		return [
			[
				'field' => 'txtNamaFaktor',
				'label' => 'Nama Faktor Penilaian',
				'rules' => 'required'
			],
			[
				'field' => 'txtNilaiCf',
				'label' => 'Nilai CF Faktor Penilaian',
				'rules' => 'required'
			],
		];
	}
	public function rules_faktor_edit()
	{
		return [
			[
				'field' => 'txtNamaFaktor',
				'label' => 'Nama Faktor Penilaian',
				'rules' => 'required'
			],
			[
				'field' => 'txtNilaiCf',
				'label' => 'Nilai CF Faktor Penilaian',
				'rules' => 'required'
			],
		];
	}

	// get utils
	public function get_nilais()
	{
		$query = $this->db
			->get(TABEL_REGISTER_NILAI);

		$nilais = $query->result();

		foreach ($nilais as $item) {
		}

		return $nilais;
	}

	public function get_nilai_id($id)
	{
		$query = $this->db
			->where('id', $id)
			->get(TABEL_REGISTER_NILAI);

		$nilai = $query->row();

		return $nilai;
	}

	// insert nilai
	public function nilai($jadwal_id, $penilai_id, $dinilai_id, $penilaians = [])
	{
		$penilaian_json = json_encode($penilaians);

		$this->db
			->set('jadwal_id', $jadwal_id)
			->set('penilai_pegawai_id', $penilai_id)
			->set('dinilai_pegawai_id', $dinilai_id)
			->set('penilaian', $penilaian_json);

		if (!$this->db->insert($this->_table)) {
			return -1;
		}
		return $this->db->insert_id();
	}

	// delete riwayat penilaian
	public function delete($id)
	{
		$this->db
			->where('id', $id);
		return $this->db->delete($this->_table);
	}

	// jadwal
	public function get_jadwals()
	{
		$query = $this->db
			->order_by('created_at', 'ASC')
			->get(TABEL_JADWAL_PENILAIAN);

		$jadwals = $query->result();

		foreach ($jadwals as $jadwal) {
		}

		return $jadwals;
	}

	public function get_jadwals_active()
	{
		$query = $this->db
			->where('waktu_selesai is null', null)
			->get(TABEL_JADWAL_PENILAIAN);

		$jadwals = $query->result();

		foreach ($jadwals as $jadwal) {
		}

		return $jadwals;
	}

	public function get_jadwal_id($id)
	{
		$query = $this->db
			->where('id', $id)
			->get(TABEL_JADWAL_PENILAIAN);

		$jadwal = $query->row();

		return $jadwal;
	}

	public function create_jadwal($deskripsi, $waktu_mulai, $batas_waktu)
	{
		$date_mulai = new DateTime($waktu_mulai);
		$date_batas = new DateTime($batas_waktu);
		$this->db
			->set('deskripsi', $deskripsi)
			->set('waktu_mulai', $date_mulai->format('Y-m-d H:i:s'))
			->set('waktu_batas', $date_batas->format('Y-m-d H:i:s'));
		return $this->db->insert(TABEL_JADWAL_PENILAIAN);
	}

	public function rules_jadwal_baru()
	{
		return [
			[
				'field' => 'txtDeskripsiJadwal',
				'label' => 'Deskripsi jadwal penilaian',
				'rules' => 'required'
			],
			[
				'field' => 'txtWaktuMulai',
				'label' => 'Waktu mulai penilaian',
				'rules' => 'required'
			],
			[
				'field' => 'txtWaktuBatas',
				'label' => 'Batas waktu penilaian',
				'rules' => 'required'
			],
		];
	}

	public function delete_jadwal($id)
	{
		$this->db
			->where('id', $id);
		return $this->db->delete(TABEL_JADWAL_PENILAIAN);
	}

	public function selesai_jadwal($id)
	{
		$date = new DateTime('now');
		$this->db
			->set('waktu_selesai', $date->format('Y-m-d H:i:s'))
			->where('id', $id);
		return $this->db->update(TABEL_JADWAL_PENILAIAN);
	}


	// calculatuion
	public function calculate_certainty_penilaian_id($id)
	{
		$faktors = $this->get_faktor_penilaians();
		$penilaian = $this->get_penilaian_id($id);

		if (!$penilaian) return false;
		$penilaian_json = $penilaian->penilaian;
		$penilaian_json = json_decode($penilaian_json);

		$cfg  = [];
		foreach ($faktors as $faktor) {
			// cfh pakar
			if (!$faktor->nilai_cf) $cfh = 0;
			else $cfh = $faktor->nilai_cf;
			// cfe user
			$cfe = $this->get_nilai_id($penilaian_json->{$faktor->code_name})->value;
			// cf pakar * cf  user
			$cfg_tmp = $cfh * $cfe;   
			array_push($cfg, $cfg_tmp);
		}
/**
 * CFG = {1, 2, 3, 4, 5}; x = 5
 *        0, 1, 2, 3	i < x-1 => i < 4
 * 
 * i = {0 ... 4}
 * CFk{0} = CFG{i} + [CFG{i+1} * (1 - CFG{i})]
 * CFk{1 ... 4} = CFk + [CFG{i+1} * (1 - CFk)]
 * 
 */
		$cf_sum = 0;
		for ($i = 0; $i < count($cfg) - 1; $i++) {
			if ($i == 0) {
				$cf_sum = $cfg[$i] + ($cfg[$i + 1] * (1 - $cfg[$i]));
			} else {
				$cf_sum = $cf_sum + ($cfg[$i + 1] * (1 - $cf_sum));
			}
		}
		// echo "cf_sum: " . $cf_sum . "\n";

		return $cf_sum * 100;
	}

	public function get_predicate_penilaian_id($id)
	{
		$certainty = $this->calculate_certainty_penilaian_id($id);
		if ($certainty === false) return false;

		if ($certainty >= 80) return 'Sangat Baik';
		else if ($certainty >= 60 && $certainty < 80) return 'Baik';
		else if ($certainty >= 45 && $certainty < 60) return 'Kurang';
		else if ($certainty < 45) return 'Sangat Kurang';
	}
}
