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
		$data = array(
			"title" => "Infinite Apparel | Account Settings",
			"header_additional_class" => " invers",
		);
		
		parent::view("account", $data);
	}
}
