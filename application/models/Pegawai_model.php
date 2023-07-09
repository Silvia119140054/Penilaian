<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pegawai_model extends CI_Model
{
	private $_table = TABEL_PEGAWAI;

	public function get_pegawais()
	{
		$query = $this->db
			->get($this->_table);

		$pegawais = $query->result();

		if ($pegawais) {
			$this->load->model('user_model');
			$this->load->model('organisasi_model');
			foreach ($pegawais as $item) {
				$user = $this->user_model->get_user_uid($item->user_id);
				$item->user = $user;
				$item->dinas = $this->organisasi_model->get_dinas_id($item->dinas_id);
				$item->jabatan = $this->organisasi_model->get_jabatan_id($item->jabatan_id);
			}
		}

		return $pegawais;
	}

	public function get_pegawais_except($id)
	{
		$query = $this->db
			->where('id !=', $id)
			->get($this->_table);

		$pegawais = $query->result();

		if ($pegawais) {
			$this->load->model('user_model');
			foreach ($pegawais as $item) {
				$user = $this->user_model->get_user_uid($item->user_id);
				$item->user = $user;
			}
		}

		return $pegawais;
	}

	public function get_pegawai_id($id)
	{
		$query = $this->db
			->where('id', $id)
			->get($this->_table);

		$pegawai = $query->row();

		if ($pegawai) {
			$this->load->model('user_model');
			$user = $this->user_model->get_user_uid($pegawai->user_id);
			$pegawai->user = $user;
		}

		return $pegawai;
	}

	public function get_pegawai_uid($uid)
	{
		$query = $this->db
			->where('user_id', $uid)
			->get($this->_table);

		$pegawai = $query->row();

		if ($pegawai) {
			$this->load->model('user_model');
			$this->load->model('organisasi_model');

			$pegawai->user =  $this->user_model->get_user_uid($pegawai->user_id);
			$pegawai->jabatan = $this->organisasi_model->get_jabatan_id($pegawai->jabatan_id);
			$pegawai->dinas = $this->organisasi_model->get_dinas_id($pegawai->dinas_id);
		}

		return $pegawai;
	}

	public function get_pegawai_nip($nip)
	{
		$query = $this->db
			->where('nip', $nip)
			->get($this->_table);

		$pegawai = $query->row();

		if ($pegawai) {
			$this->load->model('user_model');
			$user = $this->user_model->get_user_uid($pegawai->user_id);
			$pegawai->user = $user;
		}

		return $pegawai;
	}

	public function get_pegawais_dinas_id($dinas_id)
	{
		$query = $this->db
			->where('dinas_id', $dinas_id)
			->get(TABEL_PEGAWAI);

		$pegawais = $query->result();

		if ($pegawais) {
			$this->load->model('user_model');
			foreach ($pegawais as $item) {
				$user = $this->user_model->get_user_uid($item->user_id);
				$item->user = $user;
			}
		}

		return $pegawais;
	}

	public function get_pegawais_jabatan_id($jabatan_id)
	{
		$query = $this->db
			->where('jabatan_id', $jabatan_id)
			->get(TABEL_PEGAWAI);

		$pegawais = $query->result();

		if ($pegawais) {
			$this->load->model('user_model');
			foreach ($pegawais as $item) {
				$user = $this->user_model->get_user_uid($item->user_id);
				$item->user = $user;
			}
		}

		return $pegawais;
	}

	public function create($user_id, $nip, $jabatan_id, $dinas_id)
	{
		$this->db
			->set('user_id', $user_id)
			->set('nip', $nip)
			->set('jabatan_id', $jabatan_id)
			->set('dinas_id', $dinas_id);

		return $this->db->insert(TABEL_PEGAWAI);
	}

	public function update_pegawai($id, $nip, $jabatan_id, $dinas_id)
	{
		$this->db
			->set('nip', $nip)
			->set('jabatan_id', $jabatan_id)
			->set('dinas_id', $dinas_id)
			->where('id', $id);

		return $this->db->update(TABEL_PEGAWAI);
	}

	public function create_pegawai($name, $username, $email, $nip)
	{
		$this->load->model('user_model');
		$role_pegawai = $this->user_model->get_role_by_name('pegawai');

		// create user
		if (!$role_pegawai) return false;
		$this->db
			->set('name', $name)
			->set('email', $email)
			->set('username', $username)
			->set('password', password_hash(APP_PASSWORD_DEFAULT, PASSWORD_DEFAULT))
			->set('role', $role_pegawai->id);
		if (!$this->db->insert(TABEL_USER)) return false;
		$user_id = $this->db->insert_id();


		// create pegawai
		$this->db
			->set('user_id', $user_id)
			->set('nip', $nip);

		return $this->db->insert(TABEL_PEGAWAI);
	}

	public function delete_pegawai($id)
	{
		$pegawai = $this->get_pegawai_id($id);
		$this->db
			->where('id', $id);

		$this->load->model('user_model');
		if ($this->db->delete(TABEL_PEGAWAI)) {
			return $this->user_model->delete_user($pegawai->user_id);
		}
		return false;
	}

	public function check_regist_data($name, $username, $email, $nip)
	{
		// name
		// username
		$username = strtolower($username);
		$username = trim($username);
		if (!preg_match("/^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/", $username)) {
			return [
				'status' => false,
				'message' => 'username \'' . $username . '\' tidak valid'
			];
		}
		$this->load->model('user_model');
		if ($this->user_model->cek_username($username)) {
			return [
				'status' => false,
				'message' => 'username sudah terdaftar'
			];
		}
		// email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return [
				'status' => false,
				'message' => 'email ' . $email . ' tidak valid'
			];
		}
		if ($this->user_model->cek_email($email)) {
			return [
				'status' => false,
				'message' => 'email ' . $email . ' sudah terdaftar'
			];
		}
		// nip
		if (!preg_match("/[0-9]{18}/", $nip)) {
			return [
				'status' => false,
				'message' => 'nip ' . $nip . ' tidak valid. Nip harus 18 angka.'
			];
		}
		if ($this->get_pegawai_nip($nip)) {
			return [
				'status' => false,
				'message' => 'nip ' . $nip . '  sudah terdaftar'
			];
		}

		return true;
	}

	public function rules_edit_pegawai()
	{
		return [
			[
				'field' => 'txtNamaPegawai',
				'label' => 'Nama Pegawai',
				'rules' => 'required'
			],
			[
				'field' => 'txtEmailPegawai',
				'label' => 'Email',
				'rules' => 'required'
			],
			[
				'field' => 'txtNip',
				'label' => 'NIP',
				'rules' => 'required'
			],
			[
				'field' => 'txtDinas',
				'label' => 'Dinas',
				'rules' => 'required'
			],
			[
				'field' => 'txtJabatan',
				'label' => 'Jabatan',
				'rules' => 'required'
			],
		];
	}
}
