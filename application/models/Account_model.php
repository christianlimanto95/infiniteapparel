<?php

class Account_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_user_data($user_id) {
        $query = $this->db->query("
            SELECT u.*, c.city_name
            FROM user u
            LEFT JOIN (SELECT city_id, city_name FROM city) c
            ON u.kota_id = c.city_id
            WHERE u.user_id = " . $user_id . "
            LIMIT 1
        ");
        return $query->result();
    }

    function get_city() {
        return $this->db->get("city")->result();
    }

    function change_name($data) {
        $query = $this->db->query("
            UPDATE user
            SET user_first_name = '" . $data["user_first_name"] . "', user_last_name = '" . $data["user_last_name"] . "', modified_date = CURRENT_TIMESTAMP()
            WHERE user_id = " . $data["user_id"] . "
        ");
    }

    function change_city($data) {
        $query = $this->db->query("
            UPDATE user
            SET kota_id = '" . $data["kota_id"] . "', modified_date = CURRENT_TIMESTAMP()
            WHERE user_id = " . $data["user_id"] . "
        ");
    }

    function change_address($data) {
        $query = $this->db->query("
            UPDATE user
            SET user_address = '" . $data["user_address"] . "', modified_date = CURRENT_TIMESTAMP()
            WHERE user_id = " . $data["user_id"] . "
        ");
    }

    function change_phone($data) {
        $query = $this->db->query("
            UPDATE user
            SET user_handphone = '" . $data["user_handphone"] . "', modified_date = CURRENT_TIMESTAMP()
            WHERE user_id = " . $data["user_id"] . "
        ");
    }

    function change_password($data) {
        $current_password = $this->db->query("SELECT user_password FROM user WHERE user_id = " . $data["user_id"] . " LIMIT 1")->result();
        if (sizeof($current_password) > 0) {
            $current_password = $current_password[0]->user_password;
            if (password_verify($data["current_password"], $current_password)) {
                $data["new_password"] = password_hash($data["new_password"], PASSWORD_DEFAULT);
                $query = $this->db->query("
                    UPDATE user
                    SET user_password = '" . $data["new_password"] . "', modified_date = CURRENT_TIMESTAMP()
                    WHERE user_id = " . $data["user_id"] . "
                ");
                return true;
            }
        }

        return false;
    }
}
