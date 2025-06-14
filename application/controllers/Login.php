<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('v_login');
    }

    public function aksi()
    {
        // Validasi form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() !== false) {
            // Ambil data dari form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Data yang digunakan untuk pengecekan
            $where = array(
                'pengguna_username' => $username,
                'pengguna_password' => md5($password),
                'pengguna_status'   => 1
            );

            // Cek login
            $cek = $this->m_login->cek_login('pengguna', $where);

            if ($cek->num_rows() > 0) {
                // Login berhasil
                $data = $cek->row();

                // Buat session
                $data_session = array(
                    'id'       => $data->pengguna_id,
                    'username' => $data->pengguna_username,
                    'level'    => $data->pengguna_level,
                    'status'   => 'telah_login'
                );
                $this->session->set_userdata($data_session);

                // Arahkan ke dashboard
                redirect('dashboard');
            } else {
                // Login gagal
                redirect('login?alert=gagal');
            }
        } else {
            // Validasi gagal, kembali ke halaman login
            $this->load->view('v_login');
        }
    }
}
?>
