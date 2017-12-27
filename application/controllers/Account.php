<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Account extends General_controller {
	public function __construct() {
		parent::__construct();
		parent::redirect_if_not_logged_in();
		$this->load->model("Account_model");
	}
	
	public function index()
	{
		$user_id = parent::is_logged_in();
		$user_data = $this->Account_model->get_user_data($user_id);
		$city = $this->Account_model->get_city();
		if (sizeof($user_data) > 0) {
			$data = array(
				"title" => "Infinite Apparel | Account Settings",
				"header_additional_class" => " invers",
				"data" => $user_data[0],
				"city" => $city
			);
			
			parent::view("account", $data);
		} else {
			show_404();
		}
	}

	function change_name() {
		$user_first_name = $this->input->post("user_first_name", true);
		$user_last_name = $this->input->post("user_last_name", true);
		$user_id = parent::is_logged_in();

		if ($user_first_name && $user_id) {
			$data = array(
				"user_first_name" => $user_first_name,
				"user_last_name" => $user_last_name,
				"user_id" => $user_id
			);
			$this->Account_model->change_name($data);
			$this->session->set_flashdata("message", "Name Changed");
		}

		redirect(base_url("account-settings"));
	}

	function change_city() {
		$kota_id = $this->input->post("city_id", true);
		$user_id = parent::is_logged_in();

		if ($kota_id && $user_id) {
			$data = array(
				"kota_id" => $kota_id,
				"user_id" => $user_id
			);
			$this->Account_model->change_city($data);
			$this->session->set_flashdata("message", "City Changed");
		}

		redirect(base_url("account-settings"));
	}

	function change_address() {
		$user_address = $this->input->post("user_address", true);
		$user_id = parent::is_logged_in();

		if ($user_address && $user_id) {
			$data = array(
				"user_address" => $user_address,
				"user_id" => $user_id
			);
			$this->Account_model->change_address($data);
			$this->session->set_flashdata("message", "Address Changed");
		}

		redirect(base_url("account-settings"));
	}

	function change_phone() {
		$user_handphone = $this->input->post("user_handphone", true);
		$user_id = parent::is_logged_in();

		if ($user_handphone && $user_id) {
			$data = array(
				"user_handphone" => $user_handphone,
				"user_id" => $user_id
			);
			$this->Account_model->change_phone($data);
			$this->session->set_flashdata("message", "Phone Number Changed");
		}

		redirect(base_url("account-settings"));
	}

	function change_password() {
		$current_password = $this->input->post("current_password", true);
		$new_password = $this->input->post("new_password", true);
		$user_id = parent::is_logged_in();

		if ($current_password && $new_password && $user_id) {
			$data = array(
				"current_password" => $current_password,
				"new_password" => $new_password,
				"user_id" => $user_id
			);
			$result = $this->Account_model->change_password($data);
			if ($result) {
				$this->session->set_flashdata("message", "Password Changed");
			} else {
				$this->session->set_flashdata("error_message", "Current Password is wrong");
			}
		}

		redirect(base_url("account-settings"));
	}
}
