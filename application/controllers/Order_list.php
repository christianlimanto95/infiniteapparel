<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Order_list extends General_controller {
	public function __construct() {
		parent::__construct();
		parent::redirect_if_not_logged_in();
		$this->load->model("Order_list_model");
	}
	
	public function index()
	{
		$data = array(
			"title" => "Infinite Apparel | Order List",
			"header_additional_class" => " invers"
		);
		
		parent::view("order_list", $data);
	}

	function get_order() {
		parent::show_404_if_not_ajax();
		$user_id = parent::is_logged_in();
		$data = $this->Order_list_model->get_order($user_id);
		$iLength = sizeof($data);
		for ($i = 0; $i < $iLength; $i++) {
			$data[$i]->hjual_total_price = number_format($data[$i]->hjual_total_price, 0, ",", ".");
			$data[$i]->hjual_shipping_cost = number_format($data[$i]->hjual_shipping_cost, 0, ",", ".");
			$data[$i]->hjual_discount = number_format($data[$i]->hjual_discount, 0, ",", ".");
			$data[$i]->hjual_grand_total_price = number_format($data[$i]->hjual_grand_total_price, 0, ",", ".");
		}
		echo json_encode($data);
	}
}
