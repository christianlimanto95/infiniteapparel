<?php

class Order_list_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_order($user_id) {
        $query = $this->db->query("
            SELECT h.*, p.pemesanan_first_name, p.pemesanan_last_name, p.pemesanan_address, p.pemesanan_handphone
            FROM hjual h, pemesanan p
            WHERE user_id = " . $user_id . " AND p.hjual_id = h.hjual_id
        ");
        return $query->result();
    }
}
