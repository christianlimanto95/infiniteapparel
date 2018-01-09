<?php

class Home_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_available_now() {
        $query = $this->db->query("
            SELECT item_id, category_id, item_name, item_price, modified_date
            FROM item
            WHERE item_status = 1
            ORDER BY created_date DESC
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
            SELECT c.category_name, c.category_id, i.item_name, i.item_price, i.modified_date
            FROM item i, category c
            WHERE c.category_id = i.category_id AND i.item_id = '" . $item_id . "' AND item_status = 1
            LIMIT 1
        ");
        return $query->result();
    }

    function get_custom_name_price_by_custom_id($custom_id) {
        $query = $this->db->query("
            SELECT ct.custom_type_price AS item_price, 'Custom' AS item_name
            FROM `custom` c, `custom_type` ct
            WHERE c.custom_id = " . $custom_id . " AND c.custom_type_id = ct.custom_type_id
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
            SELECT category_id, item_name, item_price
            FROM item
            WHERE item_id = '" . $item_id . "'
            LIMIT 1
        ");
        return $query->result();
    }

    function insert_bags_from_cookie($data) {
        $this->db->trans_start();

        $this->db->query("
            UPDATE `hcart`
            SET hcart_total_price = 0, hcart_total_qty = 0, modified_date = CURRENT_TIMESTAMP()
            WHERE user_id = " . $data["user_id"] . ";
        ");
        
        $query = $this->db->query("
            SELECT hcart_id
            FROM hcart
            WHERE user_id = " . $data["user_id"] . "
            LIMIT 1
        ");
        $hcart_id = $query->result()[0]->hcart_id;
        
        $this->db->query("
            DELETE FROM `dcart`
            WHERE hcart_id = " . $hcart_id . ";
        ");

        $iLength = sizeof($data["data"]);
        $dcart = $data["data"];
        $total_qty = 0;
        $total_price = 0;
        $insertDcartQuery = "
            INSERT INTO dcart (hcart_id, item_id, shirt_custom_id, design_custom_id, item_type, item_name, item_size, item_price, item_qty, dcart_subtotal) VALUES ";
        for ($i = 0; $i < $iLength; $i++) {
            if ($i > 0) {
                $insertDcartQuery .= ", ";
            }
            $insertDcartQuery .= "('" . $hcart_id . "', '" . $dcart[$i]["item_id"] . "', '" . $dcart[$i]["shirt_custom_id"] . "', '" . $dcart[$i]["design_custom_id"] . "', '" . $dcart[$i]["item_type"] . "', '" . $dcart[$i]["item_name"] . "', '" . $dcart[$i]["item_size"] . "', '" . $dcart[$i]["item_price"] . "', '" . $dcart[$i]["item_qty"] . "', '" . $dcart[$i]["item_subtotal"] . "')";

            $total_qty += intval($dcart[$i]["item_qty"]);
            $total_price += intval($dcart[$i]["item_subtotal"]);
        }

        $this->db->query($insertDcartQuery);

        $this->db->query("
            UPDATE hcart
            SET hcart_total_qty = hcart_total_qty + " . $total_qty . ", hcart_total_price = hcart_total_price + " . $total_price . ", modified_date = CURRENT_TIMESTAMP()
            WHERE hcart_id = " . $hcart_id . "
        ");

        $this->db->trans_complete();
    }

    function get_cart($user_id) {
        $query = $this->db->query("CALL get_cart(" . $user_id . ");");
        return $query->result();
    }

    function insert_dcart($data) {
        $query = $this->db->query("CALL insert_dcart('" . $data["item_id"] . "', '" . $data["item_size"] . "', '" . $data["item_qty"] . "', '" . $data["item_type"] . "', '" . $data["user_id"] . "');");
        return $query->result();
    }

    function insert_dcart_custom($data) {
        $query = $this->db->query("CALL insert_dcart_custom('" . $data["shirt_custom_id"] . "', '" . $data["design_custom_id"] . "', '" . $data["item_size"] . "', '" . $data["item_qty"] . "', '" . $data["notes"] . "', '" . $data["user_id"] . "');");
        return $query->result();
    }

    function update_dcart_qty($data) {
        $query = $this->db->query("CALL update_dcart_qty('" . $data["dcart_id"] . "', '" . $data["item_qty"] . "', '" . $data["user_id"] . "');");
        return $query->result();
    }

    function update_dcart_size($data) {
        $query = $this->db->query("
            UPDATE dcart
            SET item_size = '" . $data["item_size"] . "', modified_date = CURRENT_TIMESTAMP()
            WHERE dcart_id = " . $data["dcart_id"] . "
        ");
    }

    function remove_from_cart($dcart_id) {
        $query = $this->db->query("CALL remove_from_cart(" . $dcart_id . ");");
        return $query->result();
    }
}
