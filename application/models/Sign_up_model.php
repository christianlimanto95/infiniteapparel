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
            "verification_token" => $verification_token,
            "verification_status" => 1
        );
        $this->db->insert("verification", $insertVerification);

        $this->db->trans_complete();
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
        $query = $this->db->query("
            SELECT verification_token
            FROM verification
            WHERE verification_token = '" . $token . "' AND verification_status = 1
            LIMIT 1
        ");
        $result = $query->result();
        if (sizeof($result) > 0) {
            $this->db->trans_start();

            $this->db->select("user_id");
            $this->db->where("verification_token", $token);
            $this->db->where("verification_status", 1);
            $user_id = $this->db->get("verification")->result()[0]->user_id;

            $this->db->where("verification_token", $token);
            $this->db->where("verification_status", 1);
            $this->db->set("verification_status", 0, false);
            $this->db->set("modified_date", "NOW()", false);
            $this->db->update("verification");

            $this->db->where("user_id", $user_id);
            $this->db->set("user_status", 1);
            $this->db->set("modified_date", "NOW()", false);
            $this->db->update("user");
            
            $this->db->trans_complete();

            return true;
        } else {
            return false;
        }
    }
}
