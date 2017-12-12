<?php

class Custom_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_custom() {
        return $this->db->get("custom")->result();
    }

    function get_custom_types() {
        $query = $this->db->query("
            SELECT *
            FROM custom_type
            WHERE custom_type_id != 1
        ");
        return $query->result();
    }
}
