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

			$is_page_valid = $this->Confirm_payment_model->is_page_valid($data);
			if ($is_page_valid) {
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
		} else {
			redirect(base_url("order-list"));
		}
	}

	function do_confirm() {
		$order_id = $this->input->post("order_id", true);
		if (!empty($_FILES["input-image"]["name"]) && $_FILES["input-image"]["size"] < 33554432 && $order_id) {
			$extension = pathinfo($_FILES["input-image"]["name"], PATHINFO_EXTENSION);

			$user_id = parent::is_logged_in();
			$bank = $this->input->post("bank", true);
			$bank_account_number =  $this->input->post("bank_account_number", true);
			$bank_account_name =  $this->input->post("bank_account_name", true);

			$data = array(
				"user_id" => $user_id,
				"hjual_id" => $order_id,
				"payment_bank_name" => $bank,
				"payment_account_number" => $bank_account_number,
				"payment_account_name" => $bank_account_name,
				"payment_extension" => $extension
			);
			$payment_id = $this->Confirm_payment_model->insert_payment($data);

			$file_name = $payment_id . "." . $extension;
			parent::upload_file_settings('uploads/', '33554432', $file_name);
			if (!$this->upload->do_upload('input-image')) {
				$error_upload = true;
			} else {
				$this->session->set_flashdata("message", "Waiting confirmation for order no. " . $order_id);
				redirect(base_url("order-list"));
			}
		} else {
			redirect(base_url("confirm_payment/" . $order_id));
		}
	}
}
