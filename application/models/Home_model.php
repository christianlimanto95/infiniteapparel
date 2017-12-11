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

    function get_item_name_and_price_by_id($item_id) {
        $query = $this->db->query("
            SELECT item_name, item_price
            FROM item
            WHERE item_id = '" . $item_id . "'
            LIMIT 1
        ");
        return $query->result();
    }

    function insert_bags_from_cookie($data) {
        $this->db->trans_start();

        /*$this->db->query("
            UPDATE `hcart`
            SET hcart_total_price = 0, hcart_total_qty = 0, modified_date = CURRENT_TIMESTAMP()
            WHERE user_id = " . $data["user_id"] . ";
        ");*/
        
        $query = $this->db->query("
            SELECT hcart_id
            FROM hcart
            WHERE user_id = " . $data["user_id"] . "
            LIMIT 1
        ");
        $hcart_id = $query->result()[0]->hcart_id;
        
        /*$this->db->query("
            DELETE FROM `dcart`
            WHERE hcart_id = " . $hcart_id . ";
        ");*/

        $iLength = sizeof($data["data"]);
        for ($i = 0; $i < $iLength; $i++) {
            $dcart = $data["data"];
            $this->db->query("
                INSERT INTO dcart (hcart_id, item_id, item_name, item_size, item_price, item_qty, dcart_subtotal)
                VALUES ('" . $hcart_id . "', '" . $dcart[$i]["item_id"] . "', '" . $dcart[$i]["item_name"] . "', '" . $dcart[$i]["item_size"] . "', '" . $dcart[$i]["item_price"] . "', '" . $dcart[$i]["item_qty"] . "', '" . $dcart[$i]["item_subtotal"] . "')
            ");
        }

        $this->db->trans_complete();
    }
}
