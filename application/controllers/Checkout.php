<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Checkout extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Checkout_model");
	}
	
	public function index()
	{
		$user_id = parent::is_logged_in();
		if ($user_id) {
			//$cart = $this->Checkout_model->get_cart($user_id);
			$data = array(
				"title" => "Infinite Apparel | Checkout",
				"header_additional_class" => " invers"
			);
			
			parent::disable_get_cart();
			parent::view("checkout", $data);
		} else {
			redirect(base_url());
		}
	}
}
