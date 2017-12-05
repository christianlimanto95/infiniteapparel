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
		$page = intval($this->input->get("page"));
		$view_per_page = 16;
		$catalog = $this->Catalog_model->get_catalog($page, $view_per_page);
		$count = intval($this->Catalog_model->get_catalog_count());
		if ($page == 0) {
			$page = 1;
		}
		$data = array(
			"title" => "Infinite Apparel | Catalog",
			"header_additional_class" => " invers",
			"catalog" => $catalog,
			"count" => $count,
			"page" => $page
		);
		
		parent::view("catalog", $data);
	}
}
