<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Sign_up extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Sign_up_model");
	}
	
	public function index()
	{
		$input = array(
			"user_first_name" => $this->session->flashdata("user_first_name"),
			"user_last_name" => $this->session->flashdata("user_last_name"),
			"user_email" => $this->session->flashdata("user_email"),
			"user_password" => $this->session->flashdata("user_password"),
			"user_confirm_password" => $this->session->flashdata("user_confirm_password")
		);
		
		$error = array(
			"user_email" => $this->session->flashdata("error_user_email")
		);

		$data = array(
			"title" => "Infinite Apparel | Sign Up",
			"header_additional_class" => " invers",
			"input" => $input,
			"error" => $error
		);
		
		parent::view("sign_up", $data);
	}

	public function do_sign_up() {
		$user_first_name = $this->input->post("user_first_name", true);
		$user_last_name = $this->input->post("user_last_name", true);
		$user_email = $this->input->post("user_email", true);
		$user_password = $this->input->post("user_password", true);
		$user_confirm_password = $this->input->post("user_confirm_password", true);

		$duplicate_email = $this->Sign_up_model->get_email($user_email);
		if (sizeof($duplicate_email) > 0) {
			$this->session->set_flashdata(array(
				"user_first_name" => $user_first_name,
				"user_last_name" => $user_last_name,
				"user_email" => $user_email,
				"user_password" => $user_password,
				"user_confirm_password" => $user_confirm_password,
				"error_user_email" => "Email sudah ada"
			));
			redirect(base_url("sign-up"));
		} else {
			$insertData = array(
				"user_email" => $user_email,
				"user_password" => $user_password,
				"user_first_name" => $user_first_name,
				"user_last_name" => $user_last_name
			);
			$this->Sign_up_model->insert_user($insertData);
			$this->session->set_flashdata("message", "Sign up Successful. We have sent a confirmation email to " . $user_email);
			redirect(base_url("sign-up"));
		}
	}

	public function verify_email($verification_token) {
		$result = $this->Sign_up_model->check_verification_token($verification_token);

		$data = array(
			"title" => "Infinite Apparel | Verify Email",
			"header_additional_class" => " invers",
			"result" => $result
		);
		
		parent::view("verify_email", $data);
	}
}
