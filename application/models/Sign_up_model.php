<?php

class Sign_up_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_email($user_email) {
        $query = $this->db->query("
            SELECT user_email
            FROM user
            WHERE user_status = 1 AND user_email = '" . $user_email . "'
            LIMIT 1
        ");
        return $query->result();
    }

    public function insert_user($data) {
        $this->db->trans_start();

        $data["user_password"] = password_hash($data["user_password"], PASSWORD_DEFAULT);
        $insertData = array(
            "user_email" => $data["user_email"],
            "user_password" => $data["user_password"],
            "user_first_name" => $data["user_first_name"],
            "user_last_name" => $data["user_last_name"],
            "user_status" => 0
        );
        $this->db->insert("user", $insertData);

        $user_id = $this->db->insert_id();
        $verification_token = $this->random_str(60);

        $insertVerification = array(
            "user_id" => $user_id,
            "user_email" => $data["user_email"],
            "verification_token" => $verification_token,
            "verification_status" => 1
        );
        $this->db->insert("verification", $insertVerification);

        $this->db->trans_complete();

        return $verification_token;
    }

    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz') {
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[mt_rand(0, $max)];
		}
		return $str;
    }
    
    function check_verification_token($token) {
        $query = $this->db->query("CALL verify_email('" . $token . "');");
        return $query->result()[0];
    }
}
