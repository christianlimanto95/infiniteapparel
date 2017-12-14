<?php

class Checkout_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_cart($user_id) {
        $query = $this->db->query("CALL get_cart(" . $user_id . ");");
        return $query->result();
    }
}
