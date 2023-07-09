<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pegawai_model');
        $this->load->model('penilaian_model');
        $this->auth_model->role_validator();
        $this->user = $this->auth_model->current_user();
        $this->pegawai = $this->pegawai_model->get_pegawai_id($this->user->id);
    }

    public function penilaian_jadwal_index()
    {
        $penilaians = $this->penilaian_model->get_jadwals_active();

        $this->load->view('penilaian/step_daftar_jadwal', [
            'penilaians' => $penilaians,
            'user' => $this->user,
        ]);
    }

    public function index()
    {
        $jadwals = $this->penilaian_model->get_jadwals_active();

        foreach ($jadwals as $jadwal) {
            $pegawais = $this->pegawai_model->get_pegawais_except($this->pegawai->id);
            foreach ($pegawais as $pegawai) {
                $penilaian = $this->penilaian_model->get_penilaian_jadwal_penilai_dinilai($jadwal->id, $this->pegawai->id, $pegawai->id);
                $pegawai->penilaian = $penilaian;
            }
            $jadwal->pegawais = $pegawais;
        }
        $this->load->view('penilaian/step_data_pegawai', [
            'jadwals' => $jadwals,
            'user' => $this->user,
        ]);
    }

    public function nilaipegawai($idjadwal, $idpegawai)
    {
        $jadwal = $this->penilaian_model->get_jadwal_id($idjadwal);
        $pegawai = $this->pegawai_model->get_pegawai_id($idpegawai);
        $penilaian = $this->penilaian_model->get_penilaian_jadwal_penilai_dinilai($jadwal->id, $this->pegawai->id, $pegawai->id);

        if (!$jadwal) {
            $this->session->set_flashdata(['message_error' => 'Jadwal penilaian tidak valid!']);
            redirect('penilaian');
        }
        if ($penilaian) {
            $this->session->set_flashdata(['message_error' => 'Anda sudah menilai pegawai ini!']);
            redirect('penilaian');
        }
        if (!$pegawai) {
            $this->session->set_flashdata(['message_error' => 'Pegawai tidak valid!']);
            redirect('penilaian');
        }

        $faktors = $this->penilaian_model->get_faktor_penilaians();
        $nilais = $this->penilaian_model->get_nilais();

        $rules = [];
        foreach ($faktors as $faktor) {
            array_push($rules, [
                'field' => $faktor->code_name,
                'label' => $faktor->alias,
                'rules' => 'required',
            ]);
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {
            $penilaian = [];
            foreach ($faktors as $faktor) {
                $penilaian[$faktor->code_name] = $this->input->post($faktor->code_name);
            }
            $proses_nilai = $this->penilaian_model->nilai($jadwal->id, $this->pegawai->id, $pegawai->id, $penilaian);
            if ($proses_nilai >= 0) {
                redirect('penilaian');
            }
        }

        $this->load->view('penilaian/step_nilai_pegawai', [
            'jadwal' => $jadwal,
            'pegawai' => $pegawai,
            'faktors' => $faktors,
            'nilais' => $nilais,
            'user' => $this->user,
        ]);
    }

    public function result($id)
    {
        $this->load->model('organisasi_model');
        $penilaian = $this->penilaian_model->get_penilaian_id($id);

        if (!$penilaian) {
            $this->session->set_flashdata(['message_error' => 'Penilaian tidak valid']);
            redirect('penilaian');
        }
        $this->penilaian_model->calculate_certainty_penilaian_id($penilaian->id);
        // exit;
        $this->load->view('penilaian/step_hasil_penilaian', [
            'user' => $this->user,
            'penilaian' => $penilaian,
        ]);
    }

    public function hapus()
    {
        $id = $this->input->post('penilaianId');
        $this->load->model('penilaian_model');

        $penilaian = $this->penilaian_model->get_penilaian_id($id);

        if (!$penilaian) {
            $this->session->set_flashdata(['message_error' => 'Riwayat penilaian tidak valid']);
            redirect('riwayat');
        }

        if ($this->penilaian_model->delete($id)) {
            $this->session->set_flashdata(['message_success' => 'Berhasil menghapus riwayat penilaian']);
        }
        return redirect('riwayat');
    }

    public function riwayat()
    {
        $penilaians = $this->penilaian_model->get_penilaians_penilai_id($this->pegawai->id);
        foreach ($penilaians as $penilaian) {
            $jadwal = $this->penilaian_model->get_jadwal_id($penilaian->jadwal_id);
            $penilaian->jadwal = $jadwal;
        }

        $this->load->view('penilaian/riwayat', [
            'penilaians' => $penilaians,
            'user' => $this->user,
        ]);
    }

    public function calculate()
    {
        echo $this->penilaian_model->calculate_certainty_penilaian_id(1);
    }

    // FAKTOR
    public function faktor_index()
    {
        $faktors = $this->penilaian_model->get_faktor_penilaians();
        $this->load->view('faktor/index', [
            'faktors' => $faktors,
            'user' => $this->user,
        ]);
    }

    function faktor_tambah()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->penilaian_model->rules_faktor_baru());

        if ($this->form_validation->run()) {
            $txtFaktorPenilaian = $this->input->post('txtNamaFaktor');
            $txtNilaiCf = $this->input->post('txtNilaiCf');

            if ($this->penilaian_model->create_faktor($txtFaktorPenilaian, $txtNilaiCf)) {
                $this->session->set_flashdata(['message_success' => 'Berhasil menambahkan faktor penilaian']);
                return redirect('faktor');
            }
        }

        $this->load->view('faktor/tambah', [
            'user' => $this->user,
        ]);
    }

    function faktor_edit($id = null)
    {
        if (is_null($id)) {
            $id = $this->input->post('idFaktor');
        }

        $faktor = $this->penilaian_model->get_faktor_penilaian_id($id);

        if (!$faktor) {
            $this->session->set_flashdata(['message_error' => 'Faktor penilaian tidak valid']);
            redirect('admin/pengaturan_penilaian');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->penilaian_model->rules_faktor_edit());

        if ($this->form_validation->run()) {
            $txtNamaFaktor = $this->input->post('txtNamaFaktor');
            $txtNilaiCf = $this->input->post('txtNilaiCf');

            if ($this->penilaian_model->update_faktor($id, $txtNamaFaktor, $txtNilaiCf)) {
                $this->session->set_flashdata(['message_success' => 'Berhasil mengupdate faktor penilaian']);
                return redirect('faktor');
            } else {
                $this->session->set_flashdata(['message_success' => 'Gagal mengupdate faktor penilaian']);
            }
        }

        $this->load->view('faktor/edit', [
            'faktor' => $faktor,
            'user' => $this->user,
        ]);
    }

    function faktor_hapus()
    {
        $id = $this->input->post('idFaktor');

        $faktor = $this->penilaian_model->get_faktor_penilaian_id($id);

        if (!$faktor) {
            $this->session->set_flashdata(['message_error' => 'Faktor penilaian tidak valid']);
            redirect('admin/pengaturan_penilaian');
        }

        if ($this->penilaian_model->delete_faktor($id)) {
            $this->session->set_flashdata(['message_success' => 'Berhasil menghapus faktor penilaian']);
            return redirect('faktor');
        }
        return redirect('faktor');
    }

    // JADWAL
    public function jadwal()
    {
        $jadwals = $this->penilaian_model->get_jadwals();
        $this->load->view('jadwal/index', [
            'jadwals' => $jadwals,
            'user' => $this->user,
        ]);
    }

    public function jadwal_lihat($id)
    {
        $jadwal = $this->penilaian_model->get_jadwal_id($id);
        if (!$jadwal) {
            $this->session->set_flashdata(['message_error' => 'Jadwal penilaian tidak valid']);
            return redirect('admin/pengaturan_jadwal');
        }

        $this->load->model('pegawai_model');

        $penilaians = $this->penilaian_model->get_penilaians_jadwal_id($jadwal->id);
        $pegawais = $this->pegawai_model->get_pegawais();
        $this->load->view('jadwal/lihat', [
            'user' => $this->user,
            'jadwal' => $jadwal,
            'penilaians' => $penilaians,
            'pegawais' => $pegawais,
            'total_penilaian' => count($pegawais) * (count($pegawais) - 1),
            'telah_menilai' => count($penilaians),
        ]);
    }

    public function jadwal_tambah()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->penilaian_model->rules_jadwal_baru());
        $faktors = $this->penilaian_model->get_faktor_penilaians();

        if ($this->form_validation->run()) {
            $txtDeskripsiJadwal = $this->input->post('txtDeskripsiJadwal');
            $txtWaktuMulai = $this->input->post('txtWaktuMulai');

            $txtWaktuBatas = $this->input->post('txtWaktuBatas');

            if ($this->penilaian_model->create_jadwal($txtDeskripsiJadwal, $txtWaktuMulai, $txtWaktuBatas)) {
                $this->load->model('notifikasi_model');

                $notif_title = 'Jadwal penilaian baru';
                $notif_info .= 'Segera lakukan penilaian.\n';
                $notif_info = 'Terdapat penilaian baru "' . $txtDeskripsiJadwal . '"';
                $this->notifikasi_model->create($notif_title, $notif_info, $this->user->id);
                $this->session->set_flashdata(['message_success' => 'Berhasil menambahkan jadwal penilaian']);
                return redirect('jadwal');
            }
        }

        $this->load->view('jadwal/tambah', [
            'user' => $this->user,
            'faktors' => $faktors,
        ]);
    }

    public function jadwal_edit($id = null)
    {
    }

    public function jadwal_hapus()
    {
        $id = $this->input->post('idJadwal');

        $jadwal = $this->penilaian_model->get_jadwal_id($id);

        if (!$jadwal) {
            $this->session->set_flashdata(['message_error' => 'Jadwal penilaian tidak valid']);
            return redirect('jadwal');
        }

        if ($this->penilaian_model->delete_jadwal($id)) {
            $this->session->set_flashdata(['message_success' => 'Berhasil menghapus jadwal penilaian']);
            return redirect('jadwal');
        }
        return redirect('jadwal');
    }

    public function jadwal_selesai()
    {
        $id = $this->input->post('idJadwal');

        $jadwal = $this->penilaian_model->get_jadwal_id($id);

        if (!$jadwal) {
            $this->session->set_flashdata(['message_error' => 'Jadwal penilaian tidak valid']);
            return redirect('admin/pengaturan_jadwal');
        }

        if ($this->penilaian_model->selesai_jadwal($id)) {
            $this->session->set_flashdata(['message_success' => 'Jadwal telah selesai']);
            return redirect('jadwal');
        }
    }

    // GRAFIK
    public function grafik_pegawai($id_pegawai)
    {
        $pegawai = $this->pegawai_model->get_pegawai_id($id_pegawai);
        if (!$pegawai) {
            $this->session->set_flashdata([
                'message_error' => 'Pegawai tidak valid',
            ]);
            redirect('riwayat');
        }
        // ambil daftar jadwal
        $jadwals = $this->penilaian_model->get_jadwals();

        if (!$jadwals) {
            $this->session->set_flashdata([
                'message_error' => 'Penilaian tidak valid',
            ]);
            redirect('riwayat');
        }
        // ambil penilaian pegawai untuk tiap jadwal
        foreach ($jadwals as $jadwal) {
            // ambil semua penilaian untuk pegawai pada jadwal ini
            $penilaians = $this->penilaian_model->get_penilaians_jadwal_dinilai($jadwal->id, $id_pegawai);

            if (!$penilaians) {
                $jadwal->penilaian_rata_rata = 0;
                continue;
            }
            // hitung rata-rata penilaian
            $penilaian_sum = 0;
            foreach ($penilaians as $penilaian) {
                $penilaian_sum += $this->penilaian_model->calculate_certainty_penilaian_id($penilaian->id);
            }
            $penilaian_avg = $penilaian_sum / count($penilaians);

            $jadwal->penilaian_rata_rata = $penilaian_avg;
        }

        $this->load->view('penilaian/grafik_pegawai', [
            'user' => $this->user,
            'pegawai' => $pegawai,
            'jadwals' => $jadwals,
        ]);
    }
}
