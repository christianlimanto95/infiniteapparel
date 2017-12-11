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

    function get_email_password($user_email) {
        $query = $this->db->query("
            SELECT user_id, user_email, user_password
            FROM user
            WHEre user_email = '" . $user_email . "'
            LIMIT 1
        ");
        return $query->result();
    }

    function get_product_by_id($item_id) {
        $query = $this->db->query("
            SELECT c.category_name, i.item_name, i.item_price, i.modified_date
            FROM item i, category c
            WHERE c.category_id = i.category_id AND i.item_id = '" . $item_id . "' AND item_status = 1
            LIMIT 1
        ");
        return $query->result();
    }

    function clear_hcart_dcart($user_id) {
        $query = $this->db->query("CALL clear_hcart_dcart('" . $user_id . "');");
        return $query->result();
    }

    function insert_bags_from_cookie($data) {
        $query = $this->db->query("CALL insert_dcart('" . $data["item_id"] . "', '" . $data["item_size"] . "', '" . $data["item_qty"] . "', '" . $data["user_id"] . "');");
        return $query->result();
    }
}
