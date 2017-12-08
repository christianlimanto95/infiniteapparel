<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Home extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Home_model");
	}
	
	public function index()
	{
		$available_now = $this->Home_model->get_available_now();
		$data = array(
			"title" => "Infinite Apparel",
			"header_additional_class" => "",
			"available_now" => $available_now
		);
		
		parent::view("home", $data);
	}

	function get_cart_from_cookies() {
		$data = $this->input->post("cookies_data", true);
	}
}
