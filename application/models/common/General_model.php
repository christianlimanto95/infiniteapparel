<?php

class General_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_user_logged_in($id) {
        $query = $this->db->query("
            SELECT user_id, user_email, user_first_name, user_last_name
            FROM user
            WHERE user_id = " . $id . "
            LIMIT 1
        ");
        return $query->result();
    }
}
