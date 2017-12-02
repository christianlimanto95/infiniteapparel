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
		$data = array(
			"title" => "Infinite Apparel | Sign Up",
			"header_additional_class" => " invers"
		);
		
		parent::view("sign_up", $data);
	}
}
