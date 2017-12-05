<?php

class Catalog_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_catalog() {
        return $this->db->get("item")->result();
    }
}
