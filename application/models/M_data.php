<?php
    class M_data extends CI_Model{
        //untuk update data ganti password
        function update_data($table,$data,$where) {
            $this->db->where($where);
            $this->db->update($table,$data);
        }

        //mengambil data dari database
        function get_data($table) {
            return $this->db->get($table);
        }

        // Kategori
        // menambah data kategori
        function insert_data($table,$data) {
            return $this->db->insert($table,$data);
        }

        // mengedit data kategori
        function edit_data($table,$where) {
            return $this->db->get_where($table,$where);
        }

        // menghapus data kategori
        function delete_data($table,$where) {
            return $this->db->delete($table,$where);
        }
        function get_artikel_terbaru() {
            $this->db->select('*');
            $this->db->from('artikel');
            $this->db->join('pengguna', 'artikel_author = pengguna_id');
            $this->db->join('kategori', 'artikel_kategori = kategori_id');
            $this->db->where('artikel_status', 'publish');
            $this->db->order_by('artikel_id', 'DESC');
            $this->db->limit(3);
            return $this->db->get();
        }

        public function get_layanan($limit = null) {
            $this->db->select('layanan.*, pengguna.pengguna_nama, kategori_layanan.kategori_layanan_nama as kategori_nama, kategori_layanan.kategori_layanan_slug as kategori_slug');
            $this->db->from('layanan');
            $this->db->join('pengguna', 'layanan.layanan_author = pengguna.pengguna_id');
            $this->db->join('kategori_layanan', 'layanan.layanan_kategori = kategori_layanan.kategori_layanan_id');
            $this->db->where('layanan.layanan_status', 'publish');
            $this->db->order_by('layanan.layanan_id', 'DESC');
            if ($limit !== null) {
                $this->db->limit($limit);
            }
            return $this->db->get();
        }

        public function get_portfolio_terbaru() {
            $this->db->select('portfolio.*, kategori_portfolio.kategori_portfolio_nama');
            $this->db->from('portfolio');
            $this->db->join('kategori_portfolio', 'portfolio.portfolio_kategori = kategori_portfolio.kategori_portfolio_id');
            $this->db->where('portfolio_status', 'publish');
            $this->db->order_by('portfolio_id', 'DESC');
            $this->db->limit(6);
            return $this->db->get();
        }
    }
?>