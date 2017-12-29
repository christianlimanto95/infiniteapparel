<?php

class Confirm_payment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function is_page_valid($data) {
        $query = $this->db->query("
            SELECT hjual_id
            FROM hjual
            WHERE hjual_id = " . $data["hjual_id"] . " AND user_id = " . $data["user_id"] . " AND hjual_status = 1
            LIMIT 1
        ");
        $result = $query->result();
        if (sizeof($result) > 0) {
            return true;
        }
        return false;
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

    function insert_payment($data) {
        $this->db->trans_start();

        $this->db->where("hjual_id", $data["hjual_id"]);
        $this->db->where("user_id", $data["user_id"]);
        $this->db->set("hjual_status", 2, false);
        $this->db->set("hjual_confirm_payment_date", "NOW()", false);
        $this->db->set("modified_date", "NOW()", false);
        $this->db->update("hjual");

        $insertData = array(
            "hjual_id" => $data["hjual_id"],
            "payment_bank_name" => $data["payment_bank_name"],
            "payment_account_number" => $data["payment_account_number"],
            "payment_account_name" => $data["payment_account_name"],
            "payment_extension" => $data["payment_extension"],
            "payment_status" => 1
        );
        $this->db->insert("payment", $insertData);
        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();
        return $insert_id;
    }
}
