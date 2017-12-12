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
}
