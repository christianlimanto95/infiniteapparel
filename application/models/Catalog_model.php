<?php

class Catalog_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_catalog($page, $view_per_page) {
        if ($page > 0) {
			$page--;
		}
        $offset = $page * $view_per_page;
        $query = $this->db->query("
            SELECT *
            FROM item
            ORDER BY created_date DESC
            LIMIT " . $view_per_page . "
            OFFSET " . $offset . "
        ");
        return $query->result();
    }

    public function get_catalog_count() {
        $query = $this->db->query("
            SELECT COUNT(item_id) AS count
            FROM item
        ");
        return $query->result()[0]->count;
    }
}
