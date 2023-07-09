<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Development extends CI_Controller
{
	public function reset()
	{
		$con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
		if (!$con) {
			die("Connection failed" . mysqli_connect_error());
		}

		if (!mysqli_query($con, 'USE ' . DB_NAME)) {
			die(mysqli_error($con));
		}

		// CLEAR DATABASE
		if (!mysqli_query($con, 'SET foreign_key_checks=0')) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_USER_ROLE)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_USER)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_REGISTER_JABATAN)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_REGISTER_DINAS)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_PEGAWAI)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_REGISTER_FAKTOR_PENILAIAN)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_REGISTER_NILAI)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_REGISTER_PREDIKAT_PENILAIAN)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_PENILAIAN)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_RESET_PASSWORD)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_NOTIFIKASI)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'DROP TABLE IF EXISTS ' . TABEL_JADWAL_PENILAIAN)) {
			die(mysqli_error($con));
		}
		if (!mysqli_query($con, 'SET foreign_key_checks=1')) {
			die(mysqli_error($con));
		}

		// CREATE DATABASES
		$query = "CREATE TABLE " . TABEL_USER_ROLE . " (
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(20) NOT NULL
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}
		$query = "CREATE TABLE " . TABEL_USER . " (
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				created_at DATETIME NOT NULL DEFAULT NOW(),
				updated_at DATETIME DEFAULT NULL,
				email VARCHAR(70) UNIQUE NOT NULL,
				username VARCHAR(70) UNIQUE NOT NULL,
				name VARCHAR(70) NOT NULL,
				password VARCHAR(200) NOT NULL,
                role INT UNSIGNED,
				avatar VARCHAR(200) DEFAULT NULL,
                FOREIGN KEY(role) REFERENCES " . TABEL_USER_ROLE . "(id)
			);
		";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		// register jabatan
		$query = "CREATE TABLE " . TABEL_REGISTER_JABATAN . " (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(20) NOT NULL
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		// register dinas
		$query = "CREATE TABLE " . TABEL_REGISTER_DINAS . " (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(20) NOT NULL
            );
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		// tabel pegawai
		$query = "CREATE TABLE " . TABEL_PEGAWAI . " (
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				created_at DATETIME NOT NULL DEFAULT NOW(),
				updated_at DATETIME DEFAULT NULL,
                user_id INT UNSIGNED NOT NULL,
                nip VARCHAR(30) UNIQUE NOT NULL,
                jabatan_id INT UNSIGNED DEFAULT NULL,
                dinas_id INT UNSIGNED DEFAULT NULL,
                FOREIGN KEY(jabatan_id) REFERENCES " . TABEL_REGISTER_JABATAN . "(id),
                FOREIGN KEY(dinas_id) REFERENCES " . TABEL_REGISTER_DINAS . "(id)
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		// faktor penilaian
		$query = "CREATE TABLE " . TABEL_REGISTER_FAKTOR_PENILAIAN . " (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                code_name VARCHAR(30) DEFAULT NULL,
				alias VARCHAR(100) DEFAULT NULL,
				nilai_cf FLOAT DEFAULT NULL
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		// register nilai
		$query = "CREATE TABLE " . TABEL_REGISTER_NILAI . " (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) DEFAULT NULL,
				alias VARCHAR(100) DEFAULT NULL,
				value float DEFAULT NULL
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		// register predikat penilaian
		$query = "CREATE TABLE " . TABEL_REGISTER_PREDIKAT_PENILAIAN . " (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				code_name VARCHAR(10) DEFAULT NULL,
                name VARCHAR(30) DEFAULT NULL,
				value float DEFAULT NULL
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}


		// jadwal penilaian
		$query = "CREATE TABLE " . TABEL_JADWAL_PENILAIAN . " (
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                created_at DATETIME NOT NULL DEFAULT NOW(),
                updated_at DATETIME DEFAULT NULL,
                deskripsi VARCHAR(100) DEFAULT NULL,
				waktu_mulai DATETIME DEFAULT NULL,
				waktu_batas DATETIME DEFAULT NULL,
				waktu_selesai DATETIME DEFAULT NULL
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		// tabel penilaian
		$query = "CREATE TABLE " . TABEL_PENILAIAN . " (
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                created_at DATETIME NOT NULL DEFAULT NOW(),
                updated_at DATETIME DEFAULT NULL,
				jadwal_id INT UNSIGNED NOT NULL,
                penilai_pegawai_id INT UNSIGNED NOT NULL,
                dinilai_pegawai_id INT UNSIGNED NOT NULL,
                penilaian JSON NOT NULL,
				FOREIGN KEY(penilai_pegawai_id) REFERENCES " . TABEL_PEGAWAI . "(id),
				FOREIGN KEY(dinilai_pegawai_id) REFERENCES " . TABEL_PEGAWAI . "(id),
				FOREIGN KEY(jadwal_id) REFERENCES " . TABEL_JADWAL_PENILAIAN . "(id)
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		// tabel password reset
		$query = "CREATE TABLE " . TABEL_RESET_PASSWORD . " (
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                created_at DATETIME NOT NULL DEFAULT NOW(),
				expired_at DATETIME NOT NULL,
				used_at DATETIME NOT NULL,
				email VARCHAR(70) NOT NULL,
				pin INT UNSIGNED NOT NULL,
				token VARCHAR(70) DEFAULT NULL
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}
		// tabel password reset
		$query = "CREATE TABLE " . TABEL_NOTIFIKASI . " (
				id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				created_at DATETIME NOT NULL DEFAULT NOW(),
				updated_at DATETIME DEFAULT NULL,
				release_at DATETIME DEFAULT NULL,
				created_by INT UNSIGNED NOT NULL,
				seen_by JSON DEFAULT NULL,
				title VARCHAR(100) NOT NULL,
				info VARCHAR(1000) NOT NULL,
				FOREIGN KEY(created_by) REFERENCES " . TABEL_USER . "(id)
			);
			";
		if (!mysqli_query($con, $query)) {
			die(mysqli_error($con));
		}

		mysqli_close($con);
		$this->load_data();
		echo "Reset Success";
	}

	public function load_data()
	{
		// user roles
		$user_roles = [
			['id' => 1, 'name' => 'admin'],
			['id' => 2, 'name' => 'pegawai'],
		];
		if (!$this->db->insert_batch(TABEL_USER_ROLE, $user_roles)) {
		}

		// user
		$user = [
			[
				'id' => 1,
				'name' => 'Pegawai Satu',
				'email' => 'pegawai1@penilaipeg.com',
				'username' => 'pegawai1',
				'password' => password_hash(APP_PASSWORD_DEFAULT, PASSWORD_DEFAULT),
				'avatar' => APP_AVATAR_DEFAULT,
				'role' => 2,
			],
			[
				'id' => 2,
				'name' => 'Pegawai Dua',
				'email' => 'pegawai2@penilaipeg.com',
				'username' => 'pegawai2',
				'password' => password_hash(APP_PASSWORD_DEFAULT, PASSWORD_DEFAULT),
				'avatar' => APP_AVATAR_DEFAULT,
				'role' => 2,
			],
			[
				'id' => 3,
				'name' => 'Pegawai Tiga',
				'email' => 'pegawai3@penilaipeg.com',
				'username' => 'pegawai3',
				'password' => password_hash(APP_PASSWORD_DEFAULT, PASSWORD_DEFAULT),
				'avatar' => APP_AVATAR_DEFAULT,
				'role' => 2,
			],
			[
				'id' => 4,
				'name' => 'Pegawai Admin',
				'email' => 'admin@penilaipeg.com',
				'username' => 'pegawaimin',
				'password' => password_hash(APP_PASSWORD_DEFAULT, PASSWORD_DEFAULT),
				'avatar' => APP_AVATAR_DEFAULT,
				'role' => 1,
			]

		];

		if (!$this->db->insert_batch(TABEL_USER, $user)) {
		}

		// register jabatan
		$jabatans = [
			[
				'id' => 1,
				'name' => 'Jabatan 1'
			],
			[
				'id' => 2,
				'name' => 'Jabatan 2'
			],
			[
				'id' => 3,
				'name' => 'Jabatan 3'
			],
			[
				'id' => 4,
				'name' => 'Jabatan 4'
			]
		];
		if (!$this->db->insert_batch(TABEL_REGISTER_JABATAN, $jabatans)) {
		}

		// register dinas
		$dinas = [
			[
				'id' => 1,
				'name' => 'Dinas satu'
			],
			[
				'id' => 2,
				'name' => 'Dinas Dua'
			],
			[
				'id' => 3,
				'name' => 'Dinas Tiga'
			],
			[
				'id' => 4,
				'name' => 'Dinas Empat'
			],
		];
		if (!$this->db->insert_batch(TABEL_REGISTER_DINAS, $dinas)) {
		}

		// pegawai 
		$pegawais = [
			[
				'user_id' => 1,
				'nip' => '199919991999100',
				'jabatan_id' => '1',
				'dinas_id' => '1',
			],
			[
				'user_id' => 2,
				'nip' => '199919991999101',
				'jabatan_id' => '2',
				'dinas_id' => '1',
			],
			[
				'user_id' => 3,
				'nip' => '199919991999102',
				'jabatan_id' => '3',
				'dinas_id' => '2',
			],
			[
				'user_id' => 4,
				'nip' => '199919991999103',
				'jabatan_id' => '4',
				'dinas_id' => '3',
			],
		];
		if (!$this->db->insert_batch(TABEL_PEGAWAI, $pegawais)) {
		}

		// faktor penilaian
		$faktors = [
			[
				'id' => 1,
				'code_name' => 'GP_1',
				'alias' => 'Memiliki jiwa kepemimpinan',
				'nilai_cf' => '0.7'
			],
			[
				'id' => 2,
				'code_name' => 'GP_2',
				'alias' => 'Mampu menjalankan tugas sesuai kewajiban',
				'nilai_cf' => '0.8'
			],
			[
				'id' => 3,
				'code_name' => 'GP_3',
				'alias' => 'Menghormati sesama rekan kerja',
				'nilai_cf' => '0.5'
			],
			[
				'id' => 4,
				'code_name' => 'GP_4',
				'alias' => 'Berorientasi pada pelayanan',
				'nilai_cf' => '1'
			],
			[
				'id' => 5,
				'code_name' => 'GP_5',
				'alias' => 'Dapat bekerjasama dengan baik',
				'nilai_cf' => '0.7'
			],
			[
				'id' => 6,
				'code_name' => 'GP_6',
				'alias' => 'Memiliki jiwa integritas yang tinggi',
				'nilai_cf' => '0.5'
			],
			[
				'id' => 7,
				'code_name' => 'GP_7',
				'alias' => 'Memiliki komitmen yang baik dalam bekerja',
				'nilai_cf' => '0.6'
			],
		];
		if (!$this->db->insert_batch(TABEL_REGISTER_FAKTOR_PENILAIAN, $faktors)) {
		}

		// register nilai
		$nilais = [
			[
				'id' => 1,
				'name' => 'sangat_setuju',
				'alias' => 'Sangat Setuju',
				'value' => '1',
			],
			[
				'id' => 2,
				'name' => 'setuju',
				'alias' => 'Setuju',
				'value' => '0.8',
			],
			[
				'id' => 3,
				'name' => 'cukup_setuju',
				'alias' => 'Cukup Setuju',
				'value' => '0.6',
			],
			[
				'id' => 4,
				'name' => 'sedikit_setuju',
				'alias' => 'Sedikit Setuju',
				'value' => '0.4',
			],
			[
				'id' => 5,
				'name' => 'tidak_setuju',
				'alias' => 'Tidak Setuju',
				'value' => '0.2',
			],
			[
				'id' => 6,
				'name' => 'sangat_tidak_setuju',
				'alias' => 'Sangat Tidak Setuju',
				'value' => '0',
			],
		];
		if (!$this->db->insert_batch(TABEL_REGISTER_NILAI, $nilais)) {
		}
		// pengumuman
		$date = new DateTime('now');
		$pengumuman = [
			[
				'created_by' => '4',
				'title' => 'Title Notif 1 Lorem ipsum dolor sit amet ',
				'info' => 'Info notif 1 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis possimus doloribus facere iusto quibusdam ullam. Obcaecati assumenda nisi quod placeat necessitatibus at explicabo, velit odit perferendis suscipit quis consectetur ipsa? ',
			],
			[
				'created_by' => '4',
				'title' => 'Title Notif 2 Lorem ipsum dolor sit amet ',
				'info' => 'Info notif 2 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis possimus doloribus facere iusto quibusdam ullam. Obcaecati assumenda nisi quod placeat necessitatibus at explicabo, velit odit perferendis suscipit quis consectetur ipsa? ',
			],
			[
				'created_by' => '4',
				'title' => 'Title Notif 3 Lorem ipsum dolor sit amet ',
				'info' => 'Info notif 3 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis possimus doloribus facere iusto quibusdam ullam. Obcaecati assumenda nisi quod placeat necessitatibus at explicabo, velit odit perferendis suscipit quis consectetur ipsa? ',
			],
			[
				'created_by' => '4',
				'title' => 'Title Notif 4 Lorem ipsum dolor sit amet ',
				'info' => 'Info notif 4 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis possimus doloribus facere iusto quibusdam ullam. Obcaecati assumenda nisi quod placeat necessitatibus at explicabo, velit odit perferendis suscipit quis consectetur ipsa? ',
			],
		];
		if (!$this->db->insert_batch(TABEL_NOTIFIKASI, $pengumuman)) {
		}
	}
}
