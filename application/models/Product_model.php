<?php

class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_product($id) {
        $query = $this->db->query("
            SELECT i.*, c.category_name
            FROM item i, category c
            WHERE i.category_id = c.category_id AND i.item_id = " . $id . "
            LIMIT 1
        ");
        return $query->result();
    }
}
