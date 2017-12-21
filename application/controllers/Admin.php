<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Admin extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Admin_model");
	}
	
	public function index()
	{
		$this->show_404_if_not_logged_in();
		
		$data = array(
			"title" => "Infinite Apparel | Admin"
		);
		$data["jumlah"] = $this->Admin_model->getCountConfirm();
		
		parent::adminview("admin", $data);
	}

	function show_404_if_not_logged_in() {
        if (!$this->session->userdata('infinite_apparel_admin', true)) {
            show_404();
        }
	}
	
	function is_logged_in() {
		return $this->session->userdata('infinite_apparel_admin', true);
	}

	function admin_login() {
		$data = array(
			"title" => "Infinite Apparel | Admin Login"
		);
		$this->load->view("admin_login", $data);
	}

	function do_admin_login() {
		$username = $this->input->post("username", true);
		$password = $this->input->post("password", true);
		if ($username != "" && $password != "") {
			$stored_password = $this->Admin_model->get_password()->admin_password;
			if (password_verify($password, $stored_password)) {
				$this->session->set_userdata("infinite_apparel_admin", 1);
				redirect(base_url("admin"));
			} else {
				$this->session->set_flashdata("error_message", "Wrong Username / Password");
				redirect(base_url("admin/admin_login"));
			}
		}
	}
}
