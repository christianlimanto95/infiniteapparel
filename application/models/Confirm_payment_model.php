<?php

class Confirm_payment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_info($data) {
        $query = $this->db->query("
            SELECT h.hjual_id, h.hjual_grand_total_price, p.pemesanan_first_name, p.pemesanan_last_name, p.pemesanan_address, p.pemesanan_handphone
            FROM hjual h, pemesanan p
            WHERE h.user_id = " . $data["user_id"] . " AND h.hjual_id = " . $data["hjual_id"] . " AND h.hjual_id = p.hjual_id
            LIMIT 1
        ");
        return $query->result();
    }
}
