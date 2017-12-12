<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Custom extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Custom_model");
	}
	
	public function index()
	{
		$customData = $this->Custom_model->get_custom();
		$customTypes = $this->Custom_model->get_custom_types();
		$shirts = array();
		$iLength = sizeof($customData);
		for ($i = 0; $i < $iLength; $i++) {
			if ($customData[$i]->custom_category == 1) {
				array_push($shirts, $customData[$i]);
				array_splice($customData, $i, 1);
				$iLength--;
				$i--;
			}
		}

		$data = array(
			"title" => "Infinite Apparel | Custom",
			"header_additional_class" => " invers",
			"shirts" => $shirts,
			"designs" => $customData,
			"types" => $customTypes
		);
		
		parent::view("custom", $data);
	}
}
