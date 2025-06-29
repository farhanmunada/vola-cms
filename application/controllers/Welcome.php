<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() { 
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('m_data');
    }

	public function index() {
		$data['artikel'] = $this->m_data->get_artikel_terbaru()->result();
		$data['layanan'] = $this->m_data->get_layanan(3)->result();
		$data['portfolio'] = $this->m_data->get_portfolio_terbaru()->result();
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['testimonial'] = $this->m_data->get_data('testimonials')->result();
		$data['counter'] = $this->m_data->get_data('counter_statistik')->result();
		$data['logo_client'] = $this->m_data->get_data('client_logo')->result();

		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_homepage', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Halaman single artikel (detail artikel)
	public function single($slug){
		// Ambil data artikel berdasarkan slug
		$data['artikel'] = $this->db->query("
			SELECT * FROM artikel, pengguna, kategori
			WHERE artikel_status = 'publish'
			AND artikel_author = pengguna_id
			AND artikel_kategori = kategori_id
			AND artikel_slug = '$slug'
		")->result();

		// Data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO Meta
		if (count($data['artikel']) > 0) {
			$data['meta_keyword'] = $data['artikel'][0]->artikel_judul;
			$data['meta_description'] = substr($data['artikel'][0]->artikel_konten, 0, 100);
		} else {
			$data['meta_keyword'] = $data['pengaturan']->nama;
			$data['meta_description'] = $data['pengaturan']->deskripsi;
		}

		// Load view
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_single', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// halaman blog
	public function blog() {
		// Data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO Meta
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		// Hitung jumlah data artikel
		$jumlah_data = $this->m_data->get_data('artikel')->num_rows();

		// Load library pagination
		$this->load->library('pagination');

		// Konfigurasi pagination
		$config['base_url']        = base_url() . 'blog/';
		$config['total_rows']      = $jumlah_data;
		$config['per_page']        = 3;

		$config['first_link']      = 'First';
		$config['last_link']       = 'Last';
		$config['prev_link']       = 'Prev';
		$config['next_link']       = 'Next';

		$config['full_tag_open']   = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']  = '</ul></nav></div>';

		$config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']   = '</span></li>';

		$config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']   = '<span class="sr-only">(current)</span></span></li>';

		$config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']  = '</span></li>';

		$config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']  = '</span></li>';

		$config['first_tag_open']  = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';

		$config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']  = '</span></li>';

		// Ambil segment URL untuk pagination
		$FROM = $this->uri->segment(2);
		if ($FROM == "") {
			$FROM = 0;
		}

		// Inisialisasi pagination
		$this->pagination->initialize($config);

		// Ambil data artikel dengan join dan limit
		$data['artikel'] = $this->db->query("
			SELECT * FROM artikel, pengguna, kategori
			WHERE artikel_status = 'publish'
			AND artikel_author = pengguna_id
			AND artikel_kategori = kategori_id
			ORDER BY artikel_id DESC
			LIMIT $config[per_page] OFFSET $FROM
		")->result();

		// Load view
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_blog', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Halaman statis (halaman informasi)
	public function page($slug) {
		// Tentukan kondisi untuk query
		$where = array(
			'halaman_slug' => $slug
		);
		
		// Ambil data halaman berdasarkan slug
		$data['halaman'] = $this->m_data->edit_data('halaman', $where)->result();
		
		// Ambil data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		
		// SEO Meta
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;
		
		// Load view dengan data
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_page', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// kategori artikel
	public function kategori($slug) {
		// Data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO Meta
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		// Hitung jumlah artikel sesuai kategori
		$jumlah_artikel = $this->db->query("
			SELECT * FROM artikel, pengguna, kategori
			WHERE artikel_status = 'publish'
			AND artikel_author = pengguna_id
			AND artikel_kategori = kategori_id
			AND kategori_slug = '$slug'
		")->num_rows();

		// Load library pagination
		$this->load->library('pagination');

		// Konfigurasi pagination
		$config['base_url'] = base_url().'kategori/'.$slug;
		$config['total_rows'] = $jumlah_artikel;
		$config['per_page'] = 4;
		$config['first_link'] = 'first';
		$config['last_link'] = 'last';
		$config['prev_link'] = 'prev';
		$config['next_link'] = 'next';

		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav></div>';

		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';

		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span>Next</li>';

		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';

		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';

		// Ambil offset dari URI segment 3
		$FROM = $this->uri->segment(3);
		if ($FROM == "") {
			$FROM = 0;
		}

		// Inisialisasi pagination
		$this->pagination->initialize($config);

		// Ambil data artikel berdasarkan kategori dengan limit dan offset
		$data['artikel'] = $this->db->query("
			SELECT * FROM artikel, pengguna, kategori
			WHERE artikel_status = 'publish'
			AND artikel_author = pengguna_id
			AND artikel_kategori = kategori_id
			AND kategori_slug = '$slug'
			ORDER BY artikel_id DESC
			LIMIT $config[per_page] OFFSET $FROM
		")->result();

		// Load view
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_kategori', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// search artikel
	public function search() {
		// Mengambil nilai keyword dari form pencarian
		$cari = htmlentities(trim($this->input->post('cari', true)) ?: '');
		// Jika uri segmen 2 ada, maka nilai variabel $cari akan diganti dengan nilai uri segmen 2
		$cari = ($this->uri->segment(2)) ? $this->uri->segment(2) : $cari;

		// Data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO Meta
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		// Hitung jumlah artikel yang cocok
		$jumlah_artikel = $this->db->query("
			SELECT * FROM artikel, pengguna, kategori
			WHERE artikel_status = 'publish'
			AND artikel_author = pengguna_id
			AND artikel_kategori = kategori_id
			AND (artikel_judul LIKE '%$cari%' OR artikel_konten LIKE '%$cari%')
		")->num_rows();

		// Load library pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url().'search/'.$cari;
		$config['total_rows'] = $jumlah_artikel;
		$config['per_page'] = 4;

		$config['first_link'] = 'first';
		$config['last_link'] = 'last';
		$config['prev_link'] = 'prev';
		$config['next_link'] = 'next';

		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav></div>';

		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';

		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span>Next</li>';

		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';

		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';

		// Ambil offset dari segment URI ke-3
		$FROM = $this->uri->segment(3);
		if ($FROM == "") {
			$FROM = 0;
		}

		$this->pagination->initialize($config);

		// Ambil data artikel sesuai pencarian dan pagination
		$data['artikel'] = $this->db->query("
			SELECT * FROM artikel, pengguna, kategori
			WHERE artikel_status = 'publish'
			AND artikel_author = pengguna_id
			AND artikel_kategori = kategori_id
			AND (artikel_judul LIKE '%$cari%' OR artikel_konten LIKE '%$cari%')
			ORDER BY artikel_id DESC
			LIMIT $config[per_page] OFFSET $FROM
		")->result();

		$data['cari'] = $cari;

		// Load view
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_search', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Halaman not found
	public function notfound() {
		// Data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO Meta
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		// Load view
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_notfound', $data);
		$this->load->view('frontend/v_footer', $data);
	}


	// Layanan (Services)
	public function layanan($offset = 0) {
		$limit = 6; // Jumlah layanan per halaman
		$this->load->library('pagination');

		// Total jumlah data
		$this->db->where('layanan_status', 'publish');
		$jumlah_data = $this->db->count_all_results('layanan');

		// Konfigurasi pagination
		$config['base_url'] = base_url('layanan');
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 2;

		// Styling pagination (opsional, bisa kamu sesuaikan dengan Bootstrap 4/5)
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);

		// Ambil data layanan dengan join pengguna dan kategori jika dibutuhkan
		$data['layanan'] = $this->db->query("
			SELECT * FROM layanan
			JOIN pengguna ON layanan_author = pengguna_id
			JOIN kategori_layanan ON layanan_kategori = kategori_layanan_id
			WHERE layanan_status = 'publish'
			ORDER BY layanan_id DESC
			LIMIT $config[per_page] OFFSET $offset
		")->result();

		// Data tambahan
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['meta_keyword'] = "Layanan";
		$data['meta_description'] = "Daftar layanan yang tersedia";

		// Load views
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_layanan', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function layanan_single($slug)
	{
		$data['layanan'] = $this->db->query("
			SELECT layanan.*, pengguna.*, kategori_layanan.*, kategori_layanan.kategori_layanan_nama AS kategori_nama
			FROM layanan, pengguna, kategori_layanan
			WHERE layanan.layanan_status = 'publish'
			AND layanan.layanan_author = pengguna.pengguna_id
			AND layanan.layanan_kategori = kategori_layanan.kategori_layanan_id
			AND layanan.layanan_slug = '$slug'
		")->result();

		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		if (count($data['layanan']) > 0) {
			$data['meta_keyword'] = $data['layanan'][0]->layanan_judul;
			$data['meta_description'] = substr($data['layanan'][0]->layanan_deskripsi, 0, 150);
		} else {
			redirect(base_url('notfound'));
		}

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_layanan_single', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Halaman kategori layanan
	public function kategori_layanan($slug, $offset = 0) {
		$this->load->library('pagination');
		
		// Ambil data pengaturan
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		// Hitung jumlah data
		$jumlah_data = $this->db->query("
			SELECT * FROM layanan, kategori_layanan, pengguna
			WHERE layanan.layanan_status = 'publish'
			AND layanan.layanan_kategori = kategori_layanan.kategori_layanan_id
			AND layanan.layanan_author = pengguna.pengguna_id
			AND kategori_layanan.kategori_layanan_slug = '$slug'
		")->num_rows();

		$config['base_url'] = base_url('layanan/kategori/' . $slug);
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 4;
		$config['uri_segment'] = 4;

		// Gaya pagination
		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '</span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';

		$this->pagination->initialize($config);

		// Ambil data layanan
		$data['layanan'] = $this->db->query("
			SELECT * FROM layanan, kategori_layanan, pengguna
			WHERE layanan.layanan_status = 'publish'
			AND layanan.layanan_kategori = kategori_layanan.kategori_layanan_id
			AND layanan.layanan_author = pengguna.pengguna_id
			AND kategori_layanan.kategori_layanan_slug = '$slug'
			ORDER BY layanan_id DESC
			LIMIT $config[per_page] OFFSET $offset
		")->result();

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_layanan', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// search layanan
	public function search_layanan() {
		// Mengambil nilai keyword dari form pencarian
		$cari = htmlentities(trim($this->input->post('cari', true)) ?: '');
		// Jika uri segmen 3 ada, maka nilai variabel $cari akan diganti dengan nilai uri segmen 3
		$cari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $cari;

		// Data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO Meta
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		// Hitung jumlah layanan yang cocok
		$jumlah_layanan = $this->db->query("
			SELECT * FROM layanan, pengguna, kategori_layanan
			WHERE layanan.layanan_status = 'publish'
			AND layanan.layanan_author = pengguna.pengguna_id
			AND layanan.layanan_kategori = kategori_layanan.kategori_layanan_id
			AND (layanan.layanan_judul LIKE '%$cari%' OR layanan.layanan_deskripsi LIKE '%$cari%')
		")->num_rows();

		// Load library pagination
		$this->load->library('pagination');

		$config['base_url'] = base_url().'layanan/search/'.$cari;
		$config['total_rows'] = $jumlah_layanan;
		$config['per_page'] = 4;

		$config['first_link'] = 'first';
		$config['last_link'] = 'last';
		$config['prev_link'] = 'prev';
		$config['next_link'] = 'next';

		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav></div>';

		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';

		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';

		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span>Next</li>';

		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';

		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';

		// Ambil offset dari segment URI ke-4
		$FROM = $this->uri->segment(4);
		if ($FROM == "") {
			$FROM = 0;
		}

		$this->pagination->initialize($config);

		// Ambil data layanan sesuai pencarian dan pagination
		$data['layanan'] = $this->db->query("
			SELECT * FROM layanan, pengguna, kategori_layanan
			WHERE layanan.layanan_status = 'publish'
			AND layanan.layanan_author = pengguna.pengguna_id
			AND layanan.layanan_kategori = kategori_layanan.kategori_layanan_id
			AND (layanan.layanan_judul LIKE '%$cari%' OR layanan.layanan_deskripsi LIKE '%$cari%')
			ORDER BY layanan_id DESC
			LIMIT $config[per_page] OFFSET $FROM
		")->result();

		$data['cari'] = $cari;

		// Load view (gunakan v_layanan agar tampilannya sama dengan daftar layanan)
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_layanan', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Portfolio
	public function portfolio($offset = 0) {
		$limit = 6;
		$this->load->library('pagination');

		$this->db->where('portfolio_status', 'publish');
		$jumlah_data = $this->db->count_all_results('portfolio');

		$config['base_url'] = base_url('portfolio');
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 2;

		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);

		$data['portfolio'] = $this->db->query("
			SELECT * FROM portfolio
			JOIN pengguna ON portfolio_author = pengguna_id
			JOIN kategori_portfolio ON portfolio_kategori = kategori_portfolio_id
			WHERE portfolio_status = 'publish'
			ORDER BY portfolio_id DESC
			LIMIT $config[per_page] OFFSET $offset
		")->result();

		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['meta_keyword'] = "Portfolio";
		$data['meta_description'] = "Daftar portfolio yang tersedia";

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_portfolio', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Halaman portfolio single (detail portfolio)
	public function portfolio_single($slug) {
		$data['portfolio'] = $this->db->query("
			SELECT portfolio.*, pengguna.*, kategori_portfolio.*, kategori_portfolio.kategori_portfolio_nama AS kategori_nama
			FROM portfolio, pengguna, kategori_portfolio
			WHERE portfolio.portfolio_status = 'publish'
			AND portfolio.portfolio_author = pengguna.pengguna_id
			AND portfolio.portfolio_kategori = kategori_portfolio.kategori_portfolio_id
			AND portfolio.portfolio_slug = '$slug'
		")->result();

		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		if (count($data['portfolio']) > 0) {
			$data['meta_keyword'] = $data['portfolio'][0]->portfolio_judul;
			$data['meta_description'] = substr($data['portfolio'][0]->portfolio_deskripsi, 0, 150);
		} else {
			redirect(base_url('notfound'));
		}

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_portfolio_single', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Halaman kategori portfolio
	public function kategori_portfolio($slug, $offset = 0) {
		$this->load->library('pagination');
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$jumlah_data = $this->db->query("
			SELECT * FROM portfolio, kategori_portfolio, pengguna
			WHERE portfolio.portfolio_status = 'publish'
			AND portfolio.portfolio_kategori = kategori_portfolio.kategori_portfolio_id
			AND portfolio.portfolio_author = pengguna.pengguna_id
			AND kategori_portfolio.kategori_portfolio_slug = '$slug'
		")->num_rows();

		$config['base_url'] = base_url('portfolio/kategori/' . $slug);
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 4;
		$config['uri_segment'] = 4;

		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '</span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';

		$this->pagination->initialize($config);

		$data['portfolio'] = $this->db->query("
			SELECT * FROM portfolio, kategori_portfolio, pengguna
			WHERE portfolio.portfolio_status = 'publish'
			AND portfolio.portfolio_kategori = kategori_portfolio.kategori_portfolio_id
			AND portfolio.portfolio_author = pengguna.pengguna_id
			AND kategori_portfolio.kategori_portfolio_slug = '$slug'
			ORDER BY portfolio_id DESC
			LIMIT $config[per_page] OFFSET $offset
		")->result();

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_portfolio', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Search portfolio
	public function search_portfolio() {
		$cari = htmlentities(trim($this->input->post('cari', true)) ?: '');
		$cari = ($this->uri->segment(3)) ? $this->uri->segment(3) : $cari;
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$jumlah_portfolio = $this->db->query("
			SELECT * FROM portfolio, pengguna, kategori_portfolio
			WHERE portfolio.portfolio_status = 'publish'
			AND portfolio.portfolio_author = pengguna.pengguna_id
			AND portfolio.portfolio_kategori = kategori_portfolio.kategori_portfolio_id
			AND (portfolio.portfolio_judul LIKE '%$cari%' OR portfolio.portfolio_deskripsi LIKE '%$cari%')
		")->num_rows();

		$this->load->library('pagination');
		$config['base_url'] = base_url().'portfolio/search/'.$cari;
		$config['total_rows'] = $jumlah_portfolio;
		$config['per_page'] = 4;

		$config['first_link'] = 'first';
		$config['last_link'] = 'last';
		$config['prev_link'] = 'prev';
		$config['next_link'] = 'next';

		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '</span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span></li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';

		$FROM = $this->uri->segment(4);
		if ($FROM == "") {
			$FROM = 0;
		}

		$this->pagination->initialize($config);

		$data['portfolio'] = $this->db->query("
			SELECT * FROM portfolio, pengguna, kategori_portfolio
			WHERE portfolio.portfolio_status = 'publish'
			AND portfolio.portfolio_author = pengguna.pengguna_id
			AND portfolio.portfolio_kategori = kategori_portfolio.kategori_portfolio_id
			AND (portfolio.portfolio_judul LIKE '%$cari%' OR portfolio.portfolio_deskripsi LIKE '%$cari%')
			ORDER BY portfolio_id DESC
			LIMIT $config[per_page] OFFSET $FROM
		")->result();

		$data['cari'] = $cari;
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_portfolio', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Testimonial
	public function testimonial()
	{
		$query = $this->input->get('q');
		$rating = $this->input->get('rating');

		$this->db->select('*');
		$this->db->from('testimonials');

		if (!empty($query)) {
			$this->db->group_start();
			$this->db->like('nama', $query);
			$this->db->or_like('deskripsi', $query);
			$this->db->group_end();
		}

		if (!empty($rating)) {
			$this->db->where('rating', (int)$rating);
		}

		$this->db->order_by('id', 'DESC');
		$data['testimonial'] = $this->db->get()->result();

		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$data['meta_keyword'] = "Testimonial";
		$data['meta_description'] = "Kumpulan testimonial dari pengguna";

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_testimonial', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// Halaman kontak
	public function kontak()
	{
		$data['meta_keyword'] = 'kontak, vola dev, hubungi kami';
    	$data['meta_description'] = 'Hubungi Vola Dev untuk informasi lebih lanjut atau kerja sama proyek.';

		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_kontak');
		$this->load->view('frontend/v_footer');
	}

	public function kirim_pesan()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('subjek', 'Subjek', 'required');
		$this->form_validation->set_rules('pesan', 'Pesan', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('kontak');
		} else {
			$data = [
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'subjek' => $this->input->post('subjek'),
				'pesan' => $this->input->post('pesan'),
				'tanggal' => date('Y-m-d H:i:s')
			];
			$this->m_data->insert_data('kontak', $data);

			$this->session->set_flashdata('success', 'Pesan berhasil dikirim.');
			redirect('kontak');
		}
	}
}
