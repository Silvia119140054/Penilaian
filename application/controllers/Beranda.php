<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth_model->role_validator();
		$this->user = $this->auth_model->current_user();
	}

	public function index()
	{
		$this->load->view('beranda/index', [
			'user' => $this->user
		]);
	}

	public function tatacara()
	{
		$this->load->view('beranda/tatacara', [
			'user' => $this->user
		]);
	}

	public function pedoman()
	{
		$this->load->view('beranda/pedoman', [
			'user' => $this->user
		]);
	}

	public function tentang()
	{
		$this->load->view('beranda/tentang', [
			'user' => $this->user
		]);
	}

	public function manfaat()
	{
		$this->load->view('beranda/manfaat', [
			'user' => $this->user
		]);
	}

	public function bantuan()
	{
		$this->load->view('beranda/bantuan', [
			'user' => $this->user
		]);
	}
}
