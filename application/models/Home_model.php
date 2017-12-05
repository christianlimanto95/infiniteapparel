<?php

class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_available_now() {
        $query = $this->db->query("
            SELECT item_id, item_name, item_price, modified_date
            FROM item
            WHERE item_status = 1
            LIMIT 3
        ");
        return $query->result();
    }
}
