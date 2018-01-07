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
		$product = $this->Product_model->get_product($id);
		$id_found = false;
		if (sizeof($product) > 0) {
			$id_found = true;
			$product = $product[0];
		}
		
		if ($id_found) {
			$data = array(
				"title" => "Infinite Apparel | " . $product->item_name . " " . $product->category_name,
				"header_additional_class" => " invers",
				"product" => $product
			);
			
			parent::view("product", $data);
		} else {
			show_404();
		}
	}
}
