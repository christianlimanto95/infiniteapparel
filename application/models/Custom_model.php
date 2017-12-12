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
        $this->db->where("custom_type_id != 1");
        return $this->db->get("custom_type")->result();
    }
}
