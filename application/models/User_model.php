<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{
	private $_table = TABEL_USER;
	public
		$_id,
		$_created_at,
		$_updated_at,
		$_release_at,
		$_created_by,
		$_title,
		$_info;

	public function get_users()
	{
		$query = $this->db
			->get($this->_table);

		$users = $query->result();

		return $users;
	}

	public function get_user_uid($uid)
	{
		$query = $this->db
			->where('id', $uid)
			->get($this->_table);

		$user = $query->row();

		return $user;
	}

	public function get_user_email($email)
	{
		$query = $this->db
			->where('email', $email)
			->get(TABEL_USER);

		$user = $query->row();

		return $user;
	}

	public function update_profil($id, $nama, $email)
	{
		$this->db
			->set('name', $nama)
			->set('email', $email)
			->where('id', $id);
		return $this->db->update(TABEL_USER);
	}

	function update_avatar($id, $url)
	{
		$this->db
			->set('avatar', $url)
			->where('id', $id);
		return $this->db->update(TABEL_USER);
	}

	public function cek_sandi($id, $password)
	{
		$user = $this->get_user_uid($id);

		if (!$user) return false;

		if (!password_verify($password, $user->password)) {
			return false;
		}

		return true;
	}

	public function update_sandi($id, $newPassword)
	{
		$time = new DateTime('now');

		$user = $this->get_user_uid($id);
		if (!$user) return false;

		$this->db
			->set('updated_at', $time->format('Y-m-d H:i:s'))
			->set('password', password_hash($newPassword, PASSWORD_DEFAULT))
			->where('id', $id);

		return $this->db->update(TABEL_USER);
	}

	// generate reset pin
	public function generate_password_reset($email)
	{
		$time = new DateTime('now');
		$time->modify('+30 minutes');
		$pin = rand(1000, 9999);
		$this->db
			->set('email', $email)
			->set('pin', $pin)
			->set('expired_at', $time->format('Y-m-d H:i:s'));

		if ($this->db->insert(TABEL_RESET_PASSWORD)) {
			return $pin;
		}
		return false;
	}

	// pin to token
	public function generate_reset_token($email, $pin)
	{
		$query = $this->db
			->where('email', $email)
			->where('pin', $pin)
			->get(TABEL_RESET_PASSWORD);
		$pin = $query->row();

		if ($pin) {
			$now = new DateTime('now');
			$pin_expire = new DateTime($pin->expired_at);
			if ($pin_expire > $now) {
				// generate token
				$this->load->helper('string');
				$token = random_string('alnum', 70);
				$this->db
					->set('token', $token)
					->where('id', $pin->id)
					->update(TABEL_RESET_PASSWORD);

				return $token;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	// reset password with token
	public function password_reset_token($token, $new_password)
	{
		$query = $this->db
			->where('token', $token)
			->get(TABEL_RESET_PASSWORD);
		$token = $query->row();

		if ($token) {
			$now = new DateTime('now');
			$pin_expire = new DateTime($token->expired_at);
			if ($pin_expire > $now) {
				$user = $this->user_model->get_user_email($token->email);
				if ($user) {
					if ($this->update_sandi($user->id, $new_password)) {
						$time = new DateTime('now');
						$this->db
							->set('used_at', $time->format('Y-m-d H:i:s'))
							->where('id', $token->id)
							->update(TABEL_RESET_PASSWORD);
						return true;
					}
				}
			}
		}
		return false;
	}

	public function cek_email($email)
	{
		$query = $this->db
			->where('email', $email)
			->get(TABEL_USER);
		return $query->row();
	}

	public function cek_username($username)
	{

		$query = $this->db
			->where('username', $username)
			->get(TABEL_USER);
		return $query->row();
	}

	public function register($name, $username, $email, $password)
	{
		$this->db
			->set('name', $name)
			->set('email', $email)
			->set('username', $username)
			->set('role', 2)
			->set('avatar', APP_AVATAR_DEFAULT)
			->set('password', password_hash($password, PASSWORD_DEFAULT));

		return $this->db->insert(TABEL_USER);
	}

	public function delete_user($id_user)
	{
		$this->db
			->where('id', $id_user);
		return $this->db->delete(TABEL_USER);
	}

	public function rules_update_profil()
	{
		return [
			[
				'field' => 'txtNama',
				'label' => 'Nama Lengkap',
				'rules' => 'required'
			],
			[
				'field' => 'txtNip',
				'label' => 'NIP',
				'rules' => 'required'
			],
			[
				'field' => 'txtEmail',
				'label' => 'Email',
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

	public function rules_update_sandi()
	{
		return [
			[
				'field' => 'txtOldPassword',
				'label' => 'Password Lama',
				'rules' => 'required'
			],
			[
				'field' => 'txtNewPassword',
				'label' => 'Password Baru',
				'rules' => 'required'
			],
			[
				'field' => 'txtNewPasswordConfirm',
				'label' => 'Konfirmasi Password Baru',
				'rules' => 'required'
			],
		];
	}

	public function rules_new_password_reset()
	{
		return [
			[
				'field' => 'txtNewPassword',
				'label' => 'Password Baru',
				'rules' => 'required'
			],
			[
				'field' => 'txtNewPasswordConfirm',
				'label' => 'Konfirmasi Password Baru',
				'rules' => 'required'
			],
		];
	}

	// role utils
	public function get_role_by_name($role_name)
	{
		$query = $this->db
			->where('name', $role_name)
			->get(TABEL_USER_ROLE);
		return $query->row();
	}
}
