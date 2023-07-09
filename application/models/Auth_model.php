<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth_model extends CI_Model
{
	private $_table = TABEL_USER;
	const SESSION_KEY = "user_id";
	const SESSION_ROLE = "user_role";


	public function login($username, $password)
	{
		$this->db->where('email', $username)->or_where('username', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		// apakah user terdaftar
		if (!$user) {
			return [FALSE, "User tidak ditemukan"];
		}

		// apakah password benar
		if (!password_verify($password, $user->password)) {
			return [FALSE, "Password salah"];
		}

		// buat session
		$this->session->set_userdata([self::SESSION_KEY => $user->id]);
		$user = $this->current_user();
		$this->session->set_userdata([self::SESSION_ROLE => $user->role]);

		return [true, "Login berhasil"];
	}


	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		$this->session->unset_userdata(self::SESSION_ROLE);

		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	private function _update_last_login($id)
	{
		$data = [
			'last_login' => date('Y-m-d H:i:s')
		];
		return $this->db->update($this->_table, $data, ['id' => $id]);
	}

	// register
	public function register($username, $email, $tel, $name, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();
		if (!!$user)
			return [FALSE, "Username sudah terdaftar!"];

		$this->db->where('email', $email);
		$query = $this->db->get($this->_table);
		$user = $query->row();
		if (!!$user)
			return [FALSE, "Email sudah terdaftar!"];

		$data = [
			'email' => $email,
			'username' => $username,
			'role' => 2,
			'name' => $name,
			'password' => password_hash($password, PASSWORD_DEFAULT)
		];

		if (!$this->db->insert($this->_table, $data)) {
			return [false, "Gagal menyimpan data!"];
		}
		return [true, "Berhasil menyimpan data!"];
	}


	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}
		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['id' => $user_id]);

		$query = $this->db
			->select('
			' . TABEL_USER . '.id as id,
			' . TABEL_USER . '.name as name, 
			' . TABEL_USER . '.email as email, 
			' . TABEL_USER . '.username, 
			' . TABEL_USER . '.avatar,  
			' . TABEL_USER . '.password as password,
			' . TABEL_USER_ROLE . '.name as role')
			->from(TABEL_USER)
			->join(TABEL_USER_ROLE, TABEL_USER . '.role=' . TABEL_USER_ROLE . '.id')
			->where(TABEL_USER . '.id', $user_id)
			->get();

		$user =  $query->row();

		return $user;
	}

	public function role_validator($role = ['admin', 'pegawai'])
	{
		$user = $this->current_user();
		$valid = false;
		foreach ($role as $item) {
			$valid |=  ($user->role === $item);
		}
		if (!$valid) redirect('auth');
	}

	public function rules()
	{
		return [
			[
				'field' => 'txtUsername',
				'label' => 'Username atau Email',
				'rules' => 'required'
			],
			[
				'field' => 'txtPassword',
				'label' => 'Password',
				'rules' => 'required'
			]
		];
	}

	public function rules_register()
	{
		return [
			[
				'field' => 'txtNamaLengkap',
				'label' => 'Name',
				'rules' => 'required'
			],
			[
				'field' => 'txtUsername',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'txtEmail',
				'label' => 'Email',
				'rules' => 'required'
			],
			[
				'field' => 'txtNip',
				'label' => 'NIP',
				'rules' => 'required'
			],
			[
				'field' => 'txtPassword',
				'label' => 'Password',
				'rules' => 'required'
			],
			[
				'field' => 'txtPasswordConfirm',
				'label' => 'Password Confirm',
				'rules' => 'required'
			],
		];
	}

	public function rules_forgot_password()
	{
		return [
			[
				'field' => 'txtEmail',
				'label' => 'Email',
				'rules' => 'required'
			]
		];
	}
}
