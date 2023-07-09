<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Organisasi_model extends CI_Model
{
	private $_table = TABEL_PENILAIAN;

	// dinas utils
	public function get_dinases()
	{
		$query = $this->db
			->get(TABEL_REGISTER_DINAS);
		$dinases = $query->result();

		if ($dinases) {
			$this->load->model('pegawai_model');
			foreach ($dinases as $dinas) {
				$dinas->pegawais = $this->pegawai_model->get_pegawais_dinas_id($dinas->id);
			}
		}

		return $dinases;
	}

	public function get_dinas_id($id)
	{
		$query = $this->db
			->where('id', $id)
			->get(TABEL_REGISTER_DINAS);
		$dinas =  $query->row();

		if ($dinas) {
			$this->load->model('pegawai_model');
			$dinas->pegawais = $this->pegawai_model->get_pegawais_dinas_id($dinas->id);
		}
		return $dinas;
	}

	public function create_dinas($nama_dinas)
	{
		$this->db
			->set('name', $nama_dinas);
		return $this->db->insert(TABEL_REGISTER_DINAS);
	}

	public function rules_dinas_baru()
	{
		return [
			[
				'field' => 'txtNamaDinas',
				'label' => 'Nama Dinas',
				'rules' => 'required'
			]
		];
	}

	public function update_dinas($id, $nama_dinas)
	{
		$this->db
			->set('name', $nama_dinas)
			->where('id', $id);
		return $this->db->update(TABEL_REGISTER_DINAS);
	}

	public function delete_dinas($id)
	{
		$this->db
			->where('id', $id);

		return $this->db->delete(TABEL_REGISTER_DINAS);
	}

	// jabatan utils
	public function get_jabatans()
	{
		$query = $this->db
			->get(TABEL_REGISTER_JABATAN);
		$jabatans = $query->result();

		if ($jabatans) {
			$this->load->model('pegawai_model');
			foreach ($jabatans as $jabatan) {
				$jabatan->pegawais = $this->pegawai_model->get_pegawais_jabatan_id($jabatan->id);
			}
		}

		return $jabatans;
	}

	public function get_jabatan_id($id)
	{
		$query = $this->db
			->where('id', $id)
			->get(TABEL_REGISTER_JABATAN);
		$jabatan = $query->row();

		if ($jabatan) {
			$this->load->model('pegawai_model');
			$jabatan->pegawais =  $this->pegawai_model->get_pegawais_jabatan_id($jabatan->id);
		}
		return $jabatan;
	}

	public function create_jabatan($nama_jabatan)
	{
		$this->db
			->set('name', $nama_jabatan);
		return $this->db->insert(TABEL_REGISTER_JABATAN);
	}

	public function rules_jabatan_baru()
	{
		return [
			[
				'field' => 'txtNamaJabatan',
				'label' => 'Nama Jabatan',
				'rules' => 'required'
			]
		];
	}

	public function update_jabatan($id, $nama_jabatan)
	{
		$this->db
			->set('name', $nama_jabatan)
			->where('id', $id);
		return $this->db->update(TABEL_REGISTER_JABATAN);
	}

	public function delete_jabatan($id)
	{
		$this->db
			->where('id', $id);

		return $this->db->delete(TABEL_REGISTER_JABATAN);
	}
}
