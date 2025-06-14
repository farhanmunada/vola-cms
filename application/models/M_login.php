<?php
class M_login extends CI_Model {

    function cek_login($table, $where) {
        return $this->db->get_where($table, $where);
    }

    // Tambahkan fungsi ini
    function get_user_by_id($id) {
        return $this->db->get_where('pengguna', array('pengguna_id' => $id))->row();
    }
}
