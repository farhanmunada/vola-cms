<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('m_login');
        $this->load->model('m_data');

        if ($this->session->userdata('status') != "telah_login") {
            redirect('login?alert=belum_login');
        }
    }

    // Fitur Index Dashboard
        function index() {
        // Hitung jumlah artikel
        $data['jumlah_artikel'] = $this->m_data->get_data('artikel')->num_rows();

        // Hitung jumlah kategori
        $data['jumlah_kategori'] = $this->m_data->get_data('kategori')->num_rows();

        // Hitung jumlah pengguna
        $data['jumlah_pengguna'] = $this->m_data->get_data('pengguna')->num_rows();

        // Hitung jumlah halaman
        $data['jumlah_halaman'] = $this->m_data->get_data('halaman')->num_rows();

        // Load view dengan data
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_index', $data);
        $this->load->view('dashboard/v_footer');
    }

    // Fitur Keluar
    function keluar() {
        $this->session->sess_destroy();
        redirect('login');
    }

    // Fitur Ganti Password
    public function ganti_password() {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_ganti_password');
        $this->load->view('dashboard/v_footer');
    }

    public function ganti_password_aksi()
    {
        // Set form validation
        $this->form_validation->set_rules('password_lama', 'Last Password', 'required');
        $this->form_validation->set_rules('password_baru', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('konfirmasi_password', 'Password Confirmation', 'required|matches[password_baru]');

        // Cek Validasi
        if ($this->form_validation->run() != false) {
            // Menangkap data dari input form
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru');

            // Cek kesesuaian password lama
            $where = array(
                'pengguna_id' => $this->session->userdata('id'),
                'pengguna_password' => md5($password_lama)
            );

            $cek = $this->m_login->cek_login('pengguna', $where);

            if ($cek->num_rows() > 0) {
                // Update data password pengguna
                $data = array(
                    'pengguna_password' => md5($password_baru)
                );

                $this->m_data->update_data('pengguna', $data, $where);

                // Alihkan halaman kembali ke halaman ganti password dengan alert sukses
                redirect('dashboard/ganti_password?alert=sukses');
            } else {
                // Password lama salah, redirect dengan alert gagal
                redirect('dashboard/ganti_password?alert=gagal');
            }
        } else {
            // Jika validasi gagal, muat ulang halaman form ganti password
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_ganti_password');
            $this->load->view('dashboard/v_footer');
        }
    }

    // kategori artikel
    public function kategori(){
        $data ['kategori'] = $this->m_data->get_data('kategori')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori',$data);
        $this->load->view('dashboard/v_footer');
    }

    // fitur tambah kategori artikel
    public function kategori_tambah(){
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori_tambah');
        $this->load->view('dashboard/v_footer');
    }

    // aksi tambah kategori artikel
    public function kategori_tambah_aksi(){
        // Validasi form
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {
            // Ambil data dari input
            $kategori = $this->input->post('kategori');

            // Siapkan data untuk insert
            $data = [
                'kategori_nama' => $kategori,
                'kategori_slug' => strtolower(url_title($kategori))
            ];

            // Simpan ke database
            $this->m_data->insert_data('kategori', $data);

            // Redirect ke halaman kategori
            redirect(base_url('dashboard/kategori'));
        } else {
            // Jika validasi gagal, tampilkan kembali form tambah kategori
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_kategori_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    // Fitur mengelola artikel
    public function artikel() {
        $data['artikel'] = $this->db
            ->query('
                SELECT * FROM artikel
                JOIN kategori ON artikel.artikel_kategori = kategori.kategori_id
                JOIN pengguna ON artikel.artikel_author = pengguna.pengguna_id
                ORDER BY artikel.artikel_id DESC
            ')
            ->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_artikel', $data);
        $this->load->view('dashboard/v_footer');
    }

    // edit kategori artikel
    public function kategori_edit($id){
        $where = array(
            'kategori_id' => $id
        );

        $data['kategori'] = $this->m_data->edit_data('kategori',$where)->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori_edit',$data);
        $this->load->view('dashboard/v_footer');
    }

    // update kategori artikel
    public function kategori_update(){
        // Validasi form
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {
            // Ambil data dari input
            $id       = $this->input->post('id');
            $kategori = $this->input->post('kategori');

            // Siapkan kondisi dan data yang akan diupdate
            $where = ['kategori_id' => $id];
            $data  = [
                'kategori_nama' => $kategori,
                'kategori_slug' => strtolower(url_title($kategori))
            ];

            // Update data kategori
            $this->m_data->update_data('kategori', $data, $where);

            // Redirect ke halaman daftar kategori
            redirect(base_url('dashboard/kategori'));
        } else {
            // Jika validasi gagal, ambil ulang data kategori berdasarkan ID
            $id    = $this->input->post('id');
            $where = ['kategori_id' => $id];

            $data['kategori'] = $this->m_data->edit_data('kategori', $where)->result();

            // Tampilkan kembali form edit dengan pesan error
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_kategori_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    // hapus kategori artikel
    public function kategori_hapus($id){
        $where = array(
            'kategori_id' => $id
        );
        $this->m_data->delete_data('kategori',$where);
        redirect (base_url().'dashboard/kategori');
    }

    // Fitur tambah artikel
    public function artikel_tambah() {
        $data['kategori'] = $this->m_data->get_data('kategori')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_artikel_tambah',$data);
        $this->load->view('dashboard/v_footer');
    }

    // Fitur aksi tambah artikel
    public function artikel_aksi(){
        // Validasi form: judul harus unik, konten dan kategori wajib diisi
        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        // Gambar juga wajib diisi
        if (empty($_FILES['sampul']['name'])) {
            $this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
        }

        // Jika validasi berhasil
        if ($this->form_validation->run() != false) {
            // Konfigurasi upload
            $config['upload_path'] = FCPATH . 'gambar/artikel/'; // gunakan FCPATH agar path absolut
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            // Proses upload
            if ($this->upload->do_upload('sampul')) {
                // Ambil data gambar
                $gambar = $this->upload->data();
                $sampul = $gambar['file_name'];

                // Ambil data form
                $tanggal  = date('Y-m-d H:i:s');
                $judul    = $this->input->post('judul');
                $slug     = strtolower(url_title($judul));
                $konten   = $this->input->post('konten');
                $author   = $this->session->userdata('id');
                $kategori = $this->input->post('kategori');
                $status   = $this->input->post('status');

                // Siapkan data untuk insert
                $data = array(
                    'artikel_tanggal'  => $tanggal,
                    'artikel_judul'    => $judul,
                    'artikel_slug'     => $slug,
                    'artikel_konten'   => $konten,
                    'artikel_sampul'   => $sampul,
                    'artikel_author'   => $author,
                    'artikel_kategori' => $kategori,
                    'artikel_status'   => $status
                );

                // Simpan ke database
                $this->m_data->insert_data('artikel', $data);

                // Redirect ke halaman daftar artikel
                redirect(base_url() . 'dashboard/artikel');
            } else {
                // Jika upload gagal, tampilkan error di halaman tambah artikel
                $data['gambar_error'] = $this->upload->display_errors();
                $data['kategori'] = $this->m_data->get_data('kategori')->result();

                $this->load->view('dashboard/v_header');
                $this->load->view('dashboard/v_artikel_tambah', $data);
                $this->load->view('dashboard/v_footer');
            }
        } else {
            // Jika validasi gagal, kembali ke halaman tambah artikel
            $data['kategori'] = $this->m_data->get_data('kategori')->result();

            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_artikel_tambah', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    // Fitur edit artikel
    public function artikel_edit($id){
        $where = array(
            'artikel_id' => $id
        );

        $data['artikel'] = $this->m_data->edit_data('artikel', $where)->result();
        $data['kategori'] = $this->m_data->get_data('kategori')->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_artikel_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    // Fitur update artikel
    public function artikel_update(){
        // Judul, konten dan kategori wajib diisi
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $slug = strtolower(url_title($judul));
            $konten = $this->input->post('konten');
            $kategori = $this->input->post('kategori');
            $status = $this->input->post('status');

            $where = array(
                'artikel_id' => $id
            );

            $data = array(
                'artikel_judul' => $judul,
                'artikel_slug' => $slug,
                'artikel_konten' => $konten,
                'artikel_kategori' => $kategori,
                'artikel_status' => $status
            );

            $this->m_data->update_data('artikel', $data, $where);

            if (!empty($_FILES['sampul']['name'])) {
                $config['upload_path'] = FCPATH . 'gambar/artikel/'; // gunakan FCPATH agar path absolut
                $config['allowed_types'] = 'gif|jpg|png|jpeg'; // tambahkan jpeg

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {
                    // Mengambil data gambar
                    $gambar = $this->upload->data();

                    $data = array(
                        'artikel_sampul' => $gambar['file_name']
                    );

                    $this->m_data->update_data('artikel', $data, $where);
                    redirect(base_url() . 'dashboard/artikel');
                } else {
                    $data['gambar_error'] = $this->upload->display_errors();

                    $data['artikel'] = $this->m_data->edit_data('artikel', $where)->result();
                    $data['kategori'] = $this->m_data->get_data('kategori')->result();

                    $this->load->view('dashboard/v_header');
                    $this->load->view('dashboard/v_artikel_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'dashboard/artikel');
            }
        } else {
            $id = $this->input->post('id');
            $where = array(
                'artikel_id' => $id
            );

            $data['artikel'] = $this->m_data->edit_data('artikel', $where)->result();
            $data['kategori'] = $this->m_data->get_data('kategori')->result();

            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_artikel_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    // Fitur hapus artikel
    public function artikel_hapus($id) {
        $where = array(
            'artikel_id' => $id
        );
        $this->m_data->delete_data('artikel',$where);
        redirect(base_url().'dashboard/artikel');
    }

    // Fitur mengelola halaman
    public function pages()
    {
        $data['halaman'] = $this->m_data->get_data('halaman')->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pages', $data);
        $this->load->view('dashboard/v_footer');
    }

    // Fitur tambah halaman
    public function pages_tambah() {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pages_tambah');
        $this->load->view('dashboard/v_footer');
    }

    // Fitur aksi tambah halaman
    public function pages_aksi(){
        // Validasi form: judul wajib diisi dan unik, konten wajib diisi
        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[halaman.halaman_judul]');
        $this->form_validation->set_rules('konten', 'Konten', 'required');

        if ($this->form_validation->run() !== false) {
            $judul  = $this->input->post('judul');
            $slug   = strtolower(url_title($judul));
            $konten = $this->input->post('konten');

            $data = array(
                'halaman_judul'  => $judul,
                'halaman_slug'   => $slug,
                'halaman_konten' => $konten
            );

            $this->m_data->insert_data('halaman', $data);
            redirect(base_url('dashboard/pages'));
        } else {
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_pages_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    // Fitur edit halaman
    public function pages_edit($id) {
        $where = array('halaman_id' => $id );
        $data['halaman'] = $this->m_data->edit_data('halaman',$where)->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pages_edit',$data);
        $this->load->view('dashboard/v_footer');
    }

    // fitur hapus halaman
    public function pages_hapus($id){
        $where = array(
            'halaman_id' => $id
        );
        $this->m_data->delete_data('halaman',$where);
        redirect(base_url().'dashboard/pages');
    }

    // Fitur profil pengguna
    public function profil(){
        // Ambil ID pengguna yang sedang login
        $id_pengguna = $this->session->userdata('id');

        $where = array(
            'pengguna_id' => $id_pengguna
        );

        $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_profil', $data);
        $this->load->view('dashboard/v_footer');
    }

    // Fitur update profil pengguna
    public function profil_update(){
        // Rules form wajib diisi untuk nama dan email
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->session->userdata('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            $where = array(
                'pengguna_id' => $id
            );

            $data = array(
                'pengguna_nama' => $nama,
                'pengguna_email' => $email
            );

            $this->m_data->update_data('pengguna', $data, $where);
            redirect(base_url('dashboard/profil/?alert=sukses'));
        } else {
            // Jika validasi gagal, tampilkan kembali form profil dengan data user
            $id = $this->session->userdata('id');
            $where = array(
                'pengguna_id' => $id
            );
            $data['pengguna'] = $this->m_data->edit_data('pengguna', $where)->result();

            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_profil', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    //fitur untuk pengaturan website
    public function pengaturan() {
        $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengaturan',$data);
        $this->load->view('dashboard/v_footer');
    }

    //aksi update pengaturan
    public function pengaturan_update() {
        // Wajib isi untuk nama dan deskripsi
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() != false) {
            $nama          = $this->input->post('nama');
            $deskripsi     = $this->input->post('deskripsi');
            $link_facebook = $this->input->post('link_facebook');
            $link_twitter  = $this->input->post('link_twitter');
            $link_instagram= $this->input->post('link_instagram');
            $link_github   = $this->input->post('link_github');

            // Jika kamu punya ID atau kondisi update, tambahkan di $where
            $where = array();

            $data = array(
                'nama'          => $nama,
                'deskripsi'     => $deskripsi,
                'link_facebook' => $link_facebook,
                'link_twitter'  => $link_twitter,
                'link_instagram'=> $link_instagram,
                'link_github'   => $link_github
            );

            // Update data pengaturan website
            $this->m_data->update_data('pengaturan', $data, $where);

            // Cek apakah ada file logo yang diupload
            if (!empty($_FILES['logo']['name'])) {
                $config['upload_path']   = './gambar/website/';
                $config['allowed_types'] = 'jpg|png';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo')) {
                    $gambar = $this->upload->data();
                    $logo   = $gambar['file_name'];
                    // Update logo di database
                    $this->db->query("UPDATE pengaturan SET logo='$logo'");
                }
            }

            redirect(base_url('dashboard/pengaturan/?alert=sukses'));
        } else {
            $data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_pengaturan', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    //fitur untuk mengelola pengguna
    public function pengguna() {
        $data['pengguna'] = $this->m_data->get_data('pengguna')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna',$data);
        $this->load->view('dashboard/v_footer');
    }

    //fitur untuk tambah pengguna
    public function pengguna_tambah() {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna_tambah');
        $this->load->view('dashboard/v_footer');
    }

    //aksi tambah pengguna
    public function pengguna_tambah_aksi() {
    // Aturan validasi form input wajib diisi
        $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('email', 'Email Pengguna', 'required|valid_email');
        $this->form_validation->set_rules('username', 'Username Pengguna', 'required');
        $this->form_validation->set_rules('password', 'Password Pengguna', 'required|min_length[8]');
        $this->form_validation->set_rules('level', 'Level Pengguna', 'required');
        $this->form_validation->set_rules('status', 'Status Pengguna', 'required');

        if ($this->form_validation->run() != false) {
            $nama     = $this->input->post('nama');
            $email    = $this->input->post('email');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $level    = $this->input->post('level');
            $status   = $this->input->post('status');

            $data = array(
                'pengguna_nama'     => $nama,
                'pengguna_email'    => $email,
                'pengguna_username' => $username,
                'pengguna_password' => $password,
                'pengguna_level'    => $level,
                'pengguna_status'   => $status
            );

            $this->m_data->insert_data('pengguna', $data);
            redirect(base_url('dashboard/pengguna'));
        } else {
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_pengguna_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

    //fitur untuk edit pengguna
    public function pengguna_edit($id){
        $where = array(
        'pengguna_id' => $id
        );
        $data['pengguna'] = $this->m_data->edit_data('pengguna',$where)->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    //aksi update pengguna
    public function pengguna_update(){
        // Rules untuk wajib diisi
        $this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
        $this->form_validation->set_rules('email', 'Email Pengguna', 'required');
        $this->form_validation->set_rules('username', 'Username Pengguna', 'required');
        $this->form_validation->set_rules('level', 'Level Pengguna', 'required');
        $this->form_validation->set_rules('status', 'Status Pengguna', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $level = $this->input->post('level');
            $status = $this->input->post('status');

            // Cek apabila password tidak diisi, maka kolom password tidak akan diupdate
            if ($password == "") {
                $data = array(
                    'pengguna_nama' => $nama,
                    'pengguna_email' => $email,
                    'pengguna_username' => $username,
                    'pengguna_level' => $level,
                    'pengguna_status' => $status
                );
            } else {
                $data = array(
                    'pengguna_nama' => $nama,
                    'pengguna_email' => $email,
                    'pengguna_username' => $username,
                    'pengguna_password' => md5($password),
                    'pengguna_level' => $level,
                    'pengguna_status' => $status
                );
            }

            $where = array(
                'pengguna_id' => $id
            );

            $this->m_data->update_data('pengguna', $data, $where);
            redirect(base_url() . 'dashboard/pengguna');
        } else {
            $id = $this->input->post('id');
            $where = array(
                'pengguna_id' => $id
            );
            $data['pengguna'] = $this->m_data->get_data('pengguna', $where)->result();

            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_pengguna_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    //fitur untuk hapus pengguna
    public function pengguna_hapus($id){
        $where = array(
            'pengguna_id' => $id
        );

        $data['pengguna_hapus'] = $this->m_data->edit_data('pengguna', $where)->row();
        $data['pengguna_lain'] = $this->db->query("SELECT * FROM pengguna WHERE pengguna_id != '$id'")->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_pengguna_hapus', $data);
        $this->load->view('dashboard/v_footer');
    }
    
    //aksi hapus pengguna
    public function pengguna_hapus_aksi() {
        $pengguna_hapus = $this->input->post('pengguna_hapus');
        $pengguna_tujuan = $this->input->post('pengguna_tujuan');

        // Hapus data pengguna
        $where = array(
            'pengguna_id' => $pengguna_hapus
        );
        $this->m_data->delete_data('pengguna', $where);

        // Pindahkan semua artikel pengguna yang dihapus ke pengguna tujuan
        $w = array(
            'artikel_author' => $pengguna_hapus
        );
        $d = array(
            'artikel_author' => $pengguna_tujuan
        );
        $this->m_data->update_data('artikel', $d, $w);

        redirect(base_url() . 'dashboard/pengguna');
    }

    // kategori layanan
    public function kategori_layanan(){
        $data['kategori'] = $this->m_data->get_data('kategori_layanan')->result(); // Ambil dari tabel kategori_layanan
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori_layanan', $data); // View baru khusus layanan
        $this->load->view('dashboard/v_footer');
    }

    // fitur tambah kategori layanan
    public function kategori_layanan_tambah() {
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori_layanan_tambah');
        $this->load->view('dashboard/v_footer');
    }

    // aksi tambah kategori layanan
    public function kategori_layanan_tambah_aksi(){
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {
            $kategori = $this->input->post('kategori');

            $data = [
                'kategori_layanan_nama' => $kategori,
                'kategori_layanan_slug' => strtolower(url_title($kategori))
            ];

            $this->m_data->insert_data('kategori_layanan', $data);

            redirect(base_url('dashboard/kategori_layanan'));
        } else {
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_kategori_layanan_tambah');
            $this->load->view('dashboard/v_footer');
        }
    }

        // edit kategori layanan
    public function kategori_layanan_edit($id) {
        $where = ['kategori_layanan_id' => $id];
        $data['kategori'] = $this->m_data->edit_data('kategori_layanan', $where)->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_kategori_layanan_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

        // update kategori layanan
    public function kategori_layanan_update(){
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {
            $id       = $this->input->post('id');
            $kategori = $this->input->post('kategori');

            $where = ['kategori_layanan_id' => $id];
            $data  = [
                'kategori_layanan_nama' => $kategori,
                'kategori_layanan_slug' => strtolower(url_title($kategori))
            ];

            $this->m_data->update_data('kategori_layanan', $data, $where);

            redirect(base_url('dashboard/kategori_layanan'));
        } else {
            $id    = $this->input->post('id');
            $where = ['kategori_layanan_id' => $id];
            $data['kategori'] = $this->m_data->edit_data('kategori_layanan', $where)->result();

            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_kategori_layanan_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

        // hapus kategori layanan
    public function kategori_layanan_hapus($id) {
        $where = ['kategori_layanan_id' => $id];
        $this->m_data->delete_data('kategori_layanan', $where);
        redirect(base_url('dashboard/kategori_layanan'));
    }

    // fitur mengelola layanan
    public function layanan() {
        $data['layanan'] = $this->db->query("
            SELECT * FROM layanan 
            JOIN kategori_layanan ON layanan_kategori = kategori_layanan_id 
            JOIN pengguna ON layanan_author = pengguna_id 
            ORDER BY layanan_id DESC
        ")->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_layanan', $data);
        $this->load->view('dashboard/v_footer');
    }

    // tambah layanan
    public function layanan_tambah() {
        $data['kategori_layanan'] = $this->m_data->get_data('kategori_layanan')->result();
        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_layanan_tambah', $data);
        $this->load->view('dashboard/v_footer');
    }

    // aksi tambah layanan
    public function layanan_aksi() {
        // Validasi input wajib
        $this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[layanan.layanan_judul]');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('kategori_layanan', 'Kategori Layanan', 'required');

        // Validasi upload gambar
        if (empty($_FILES['sampul']['name'])) {
            $this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
        }

        if ($this->form_validation->run() != false) {
            $config['upload_path'] = './gambar/layanan/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('sampul')) {
                $gambar = $this->upload->data();
                $tanggal = date('Y-m-d H:i:s');
                $judul = $this->input->post('judul');
                $slug = strtolower(url_title($judul));
                $konten = $this->input->post('konten'); // ambil konten dari textarea
                $sampul = $gambar['file_name'];
                $author = $this->session->userdata('id');
                $kategori = $this->input->post('kategori_layanan');
                $status = $this->input->post('status');

                $data = array(
                    'layanan_tanggal' => $tanggal,
                    'layanan_judul' => $judul,
                    'layanan_slug' => $slug,
                    'layanan_deskripsi' => $konten,
                    'layanan_gambar' => $sampul,
                    'layanan_author' => $author,
                    'layanan_kategori' => $kategori,
                    'layanan_status' => $status
                );

                $this->m_data->insert_data('layanan', $data);
                redirect(base_url() . 'dashboard/layanan');
            } else {
                $data['gambar_error'] = $this->upload->display_errors();
                $data['kategori'] = $this->m_data->get_data('kategori')->result();
                $this->load->view('dashboard/v_header');
                $this->load->view('dashboard/v_layanan_tambah', $data);
                $this->load->view('dashboard/v_footer');
            }
        } else {
            $data['kategori'] = $this->m_data->get_data('kategori')->result();
            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_layanan_tambah', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    // fitur edit layanan
    public function layanan_edit($id) {
        $where = array(
            'layanan_id' => $id
        );

        $data['layanan'] = $this->m_data->edit_data('layanan', $where)->result();
        $data['kategori'] = $this->m_data->get_data('kategori')->result();

        $this->load->view('dashboard/v_header');
        $this->load->view('dashboard/v_layanan_edit', $data);
        $this->load->view('dashboard/v_footer');
    }

    // aksi update layanan
    public function layanan_update(){
        // Validasi wajib
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('konten', 'Konten', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $judul = $this->input->post('judul');
            $slug = strtolower(url_title($judul));
            $konten = $this->input->post('konten');
            $kategori = $this->input->post('kategori');
            $status = $this->input->post('status');

            $where = array(
                'layanan_id' => $id
            );

            // Data utama tanpa gambar
            $data = array(
                'layanan_judul' => $judul,
                'layanan_slug' => $slug,
                'layanan_deskripsi' => $konten,
                'layanan_kategori' => $kategori,
                'layanan_status' => $status
            );

            // Update data layanan tanpa gambar dulu
            $this->m_data->update_data('layanan', $data, $where);

            // Cek jika ada file gambar baru diupload
            if (!empty($_FILES['sampul']['name'])) {
                $config['upload_path'] = './gambar/layanan/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('sampul')) {
                    $gambar = $this->upload->data();

                    $data_gambar = array(
                        'layanan_gambar' => $gambar['file_name']
                    );

                    $this->m_data->update_data('layanan', $data_gambar, $where);
                    redirect(base_url() . 'dashboard/layanan');
                } else {
                    // Jika upload gagal, tampilkan error
                    $this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());
                    $data['layanan'] = $this->m_data->edit_data('layanan', $where)->result();
                    $data['kategori_layanan'] = $this->m_data->get_data('kategori_layanan')->result();

                    $this->load->view('dashboard/v_header');
                    $this->load->view('dashboard/v_layanan_edit', $data);
                    $this->load->view('dashboard/v_footer');
                }
            } else {
                redirect(base_url() . 'dashboard/layanan');
            }
        } else {
            // Jika validasi gagal
            $id = $this->input->post('id');
            $where = array(
                'layanan_id' => $id
            );

            $data['layanan'] = $this->m_data->edit_data('layanan', $where)->result();
            $data['kategori_layanan'] = $this->m_data->get_data('kategori_layanan')->result();

            $this->load->view('dashboard/v_header');
            $this->load->view('dashboard/v_layanan_edit', $data);
            $this->load->view('dashboard/v_footer');
        }
    }

    public function layanan_hapus($id){
        $where = array(
            'layanan_id' => $id
        );

        $this->m_data->delete_data('layanan', $where);
        redirect(base_url() . 'dashboard/layanan');
    }
}
?>
