<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Catalog extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Catalog_model");
	}
	
	public function index()
	{
		$catalog = $this->Catalog_model->get_catalog();
		$data = array(
			"title" => "Infinite Apparel | Catalog",
			"header_additional_class" => " invers",
			"catalog" => $catalog
		);
		
		parent::view("catalog", $data);
	}
}
