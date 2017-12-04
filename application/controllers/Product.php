<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Product extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Product_model");
	}
	
	public function index()
	{
		$id = $this->uri->segment(2);
		$product_name = "180 Degree";
		$id_found = true;
		if ($id_found) {
			$data = array(
				"title" => "Infinite Apparel | Product",
				"header_additional_class" => " invers",
				"product_name" => $product_name
			);
			
			parent::view("product", $data);
		} else {
			show_404();
		}
	}
}
