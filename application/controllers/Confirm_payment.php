<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Confirm_payment extends General_controller {
	public function __construct() {
		parent::__construct();
		parent::redirect_if_not_logged_in();
		$this->load->model("Confirm_payment_model");
	}
	
	public function index()
	{
		$hjual_id = $this->uri->segment(2);
		if ($hjual_id != null) {
			$user_id = parent::is_logged_in();
			$data = array(
				"hjual_id" => $hjual_id,
				"user_id" => $user_id
			);

			$info = $this->Confirm_payment_model->get_info($data);
			if (sizeof($info) > 0) {
				$info = $info[0];
				$data = array(
					"title" => "Infinite Apparel | Confirm Payment",
					"header_additional_class" => " invers",
					"data" => $info
				);
				
				parent::view("confirm_payment", $data);
			} else {
				redirect(base_url("order-list"));
			}
		} else {
			redirect(base_url("order-list"));
		}
	}
}
