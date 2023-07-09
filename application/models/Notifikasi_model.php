<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi_model extends CI_Model
{
	private $_table = TABEL_NOTIFIKASI;

	public function get_notifikasis()
	{
		$query = $this->db
			->get($this->_table);

		$notifikasis = $query->result();
		return $notifikasis;
	}

	public function get_notifikasis_unseen_uid($user_id)
	{
		$query = $this->db
			->get($this->_table);
		$notifikasis = $query->result();

		$notifikasi_unseen = [];
		foreach ($notifikasis as $notifikasi) {
			if (!$this->is_seen_by_uid($notifikasi->id, $user_id)) {
				array_push($notifikasi_unseen, $notifikasi);
			}
		}
		return $notifikasi_unseen;
	}

	public function get_notifikasi_id($id)
	{
		$query = $this->db
			->where('id', $id)
			->get($this->_table);

		$notifikasi = $query->row();
		return $notifikasi;
	}

	public function add_seen_by_id($notification_id, $user_id)
	{
		$notif = $this->get_notifikasi_id($notification_id);
		if (!$notif) return false;
		// if seen
		if ($this->is_seen_by_uid($notification_id, $user_id)) {
			return true;
		}

		$seen_by = $notif->seen_by;
		if ($seen_by == '') {
			$seen_by = [];
		} else {
			$seen_by = json_decode($seen_by);
		}

		// add viewer and encode back
		array_push($seen_by, $user_id);
		$seen_by = json_encode($seen_by);

		$this->db
			->set('seen_by', $seen_by)
			->where('id', $notif->id);

		return $this->db->update(TABEL_NOTIFIKASI);
	}

	public function create($title, $info, $creator_uid)
	{
		$this->db
			->set('title', $title)
			->set('info', $info)
			->set('created_by', $creator_uid);

		return $this->db->insert($this->_table);
	}

	public function update($id, $title, $info, $editor_uid)
	{
		$this->db
			->set('title', $title)
			->set('info', $info)
			->set('created_by', $editor_uid)
			->where('id', $id);

		return $this->db->update($this->_table);
	}

	public function delete($id)
	{
		$this->db
			->where('id', $id);
		return $this->db->delete($this->_table);
	}

	public function is_seen_by_uid($notification_id, $user_id)
	{
		$notif = $this->get_notifikasi_id($notification_id);
		$seen_by = $notif->seen_by;
		if (is_null($seen_by)) return false;

		$seen_by = json_decode($seen_by);
		return in_array($user_id, $seen_by);
	}

	public function reset_viewer($notification_id)
	{
		$notif = $this->get_notifikasi_id($notification_id);
		if (!$notif) return false;

		$seen_by = [];
		$seen_by = json_encode($seen_by);

		$this->db
			->set('seen_by', $seen_by)
			->where('id', $notif->id);

		return $this->db->update(TABEL_NOTIFIKASI);
	}

	public function rules_create()
	{
		return [
			[
				'field' => 'txtInfo',
				'label' => 'Info Pengumuman',
				'rules' => 'required'
			],
			[
				'field' => 'txtTitle',
				'label' => 'Judul Pengumuman',
				'rules' => 'required'
			],
		];
	}
}
