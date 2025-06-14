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
    }
?>