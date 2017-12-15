<?php

class Checkout_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_city() {
        return $this->db->get("city")->result();
    }

    function do_checkout($data) {
        $this->db->trans_start();

        $insertData = array(
            "user_id" => $data["user_id"],
            "hjual_total_price" => $data["hjual_total_price"],
            "hjual_shipping_cost" => $data["hjual_shipping_cost"],
            "hjual_discount" => $data["hjual_discount"],
            "hjual_grand_total_price" => $data["hjual_grand_total_price"],
            "hjual_shipping_name" => $data["hjual_shipping_name"],
            "hjual_shipping_service" => $data["hjual_shipping_service"]
        );
        $this->db->insert("hjual", $insertData);
        $hjual_id = $this->db->insert_id();

        $insertDjualQuery = "INSERT INTO djual (hjual_id, item_id, shirt_custom_id, design_custom_id, item_type, item_name, item_price, item_size, item_qty, djual_subtotal, djual_notes) VALUES ";
        $iLength = sizeof($data["cart"]);
        for ($i = 0; $i < $iLength; $i++) {
            $cart = $data["cart"][$i];
            if ($i > 0) {
                $insertDjualQuery .= ", ";
            }
            $insertDjualQuery .= "('" . $hjual_id . "', '" . $cart["item_id"] . "', '" . $cart["shirt_custom_id"] . "', '" . $cart["design_custom_id"] . "', '" . $cart["item_type"] . "', '" . $cart["item_name"] . "', '" . $cart["item_price"] . "', '" . $cart["item_size"] . "', '" . $cart["item_qty"] . "', '" . $cart["dcart_subtotal"] . "', '" . $cart["dcart_notes"] . "')";
        }
        $this->db->query($insertDjualQuery);

        $this->db->query("INSERT INTO pemesanan (hjual_id, pemesanan_first_name, pemesanan_last_name, city_id, pemesanan_address, pemesanan_handphone) VALUES ('" . $hjual_id . "', '" . $data["first_name"] . "', '" . $data["last_name"] . "', '" . $data["city_id"] . "', '" . $data["address"] . "', '" . $data["handphone"] . "')");

        $this->db->trans_complete();
    }
}
