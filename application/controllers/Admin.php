<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Admin extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('table');
		$this->load->library('form_validation');
		$this->load->model("Admin_model");
	}
	
	public function index()
	{
		$this->show_404_if_not_logged_in();
		
		$data = array(
			"title" => "Infinite Apparel | Admin",
			"navigation" => base_url("admin")
		);
		$data["jumlah"] = $this->Admin_model->getCountConfirm();
		
		parent::adminview("admin", $data);
	}

	function show_404_if_not_logged_in() {
        if (!$this->session->userdata('infinite_apparel_admin', true)) {
            show_404();
        }
	}
	
	function is_logged_in() {
		return $this->session->userdata('infinite_apparel_admin', true);
	}

	function admin_login() {
		$data = array(
			"title" => "Infinite Apparel | Admin Login"
		);
		$this->load->view("admin_login", $data);
	}

	function do_admin_login() {
		$username = $this->input->post("username", true);
		$password = $this->input->post("password", true);
		if ($username != "" && $password != "") {
			$stored_password = $this->Admin_model->get_password()->admin_password;
			if (password_verify($password, $stored_password)) {
				$this->session->set_userdata("infinite_apparel_admin", 1);
				redirect(base_url("admin"));
			} else {
				$this->session->set_flashdata("error_message", "Wrong Username / Password");
				redirect(base_url("admin/admin_login"));
			}
		}
	}

	function inserting()
	{
		$data['nama']="";
		$data['harga']="";
		$data['keterangan']="";
		$data["msg"]="";
		$data["cbSeries"]="";
		$data["cbId"]="";
		$data["cbcbIdSelected"]="";
		$param["jumlahgambar"]=0;
		//--
		$data['namaupdate']="";
		$data['hargaupdate']="";
		$data['keteranganupdate']="";
		//--
		$querySeries=$this->Admin_model->getAllSeries();
		foreach ($querySeries as $row)
		{
			$data["allseries"][$row->category_id] = $row->category_name;
		}
		$data["title"] = "Infinite Apparel | Admin Insert";
		$data["navigation"] = base_url("admin/inserting");
		
		parent::adminview('inserting', $data);
	}

	function insert_category() {
		$category_name = $this->input->post("category_name");
		if ($category_name) {
			$data = array(
				"category_name" => $category_name
			);

			$this->session->set_flashdata("message", "Sukses insert kategori");
			$this->Admin_model->insert_category($data);
		} else {
			$this->session->set_flashdata("error_message", "Error insert kategori");
		}

		redirect(base_url("admin/inserting"));
	}

	function insert_item() {
		$category_id = $this->input->post("cbSeries");
		$item_name = $this->input->post("txtnama");
		$item_price = $this->input->post("rharga");
		$item_description = $this->input->post("txtketerangan");
		$item_image_count = intval($this->input->post("image_count"));

		$real_image_count = 0;
		for ($i = 1; $i <= $item_image_count; $i++) {
			if (!empty($_FILES["image_" . $i]["name"])) {
				$real_image_count++;
			}
		}

		$data = array(
			"category_id" => $category_id,
			"item_name" => $item_name,
			"item_price" => $item_price,
			"item_description" => $item_description,
			"item_image_count" => $real_image_count
		);
		$item_id = $this->Admin_model->insert_item($data);

		$file_name = $item_id . "_1.png";
		parent::upload_file_settings('assets/images/catalog/', '33554432', $file_name);
		if (!empty($_FILES["image_1"]["name"]) && $_FILES["image_1"]["size"] > 0 && $_FILES["image_1"]["size"] < 33554432) {
			if (!$this->upload->do_upload('image_1')) {
				echo $this->upload->display_errors();
				
			}
		}

		$ctr = 2;
		for ($i = 2; $i <= $item_image_count; $i++) {
			if (!empty($_FILES["image_" . $i]["name"]) && $_FILES["image_" . $i]["size"] > 0 && $_FILES["image_" . $i]["size"] < 33554432) {
				$file_name = $item_id . "_" . $ctr . ".jpg";
				parent::upload_file_settings('assets/images/catalog/', '33554432', $file_name);
				if (!$this->upload->do_upload('image_' . $i)) {
					echo $this->upload->display_errors();
				}
				$ctr++;
			}
		}

		redirect(base_url("admin/inserting"));
	}

	function confirmpayment() {
		$page = intval($this->input->get("page"));
		$view_per_page = 10;
		$result = $this->Admin_model->get_confirm_payment($page, $view_per_page);
		$count = intval($this->Admin_model->get_confirm_payment_count());
		if ($page == 0) {
			$page = 1;
		}

		$data = array(
			"title" => "Infinite Apparel | Admin Confirm Payment",
			"navigation" => base_url("admin/confirmpayment"),
			"totalResults" => $count,
			"waitingconfirm" => $result,
			"page" => $page
		);
		
		parent::adminview('confirmpayment', $data);
	}

	function detailpayment() {
		$id = $this->uri->segment(3);
		$hjual = $this->Admin_model->get_hjual_by_id($id);
		if (sizeof($hjual) > 0) {
			$djual = $this->Admin_model->get_djual_by_hjual_id($id);
			$data = array(
				"title" => "Infinite Apparel | Admin Detail Payment",
				"navigation" => base_url("admin/detailpayment"),
				"hpemesanan" => $hjual,
				"dpemesanan" => $djual
			);
			parent::adminview('detailpayment', $data);
		} else {
			redirect(base_url("admin/confirmpayment"));
		}
	}

	function do_confirmpayment() {
		$payment_id = $this->input->post("payment_id", true);
		$hjual_id = $this->input->post("hjual_id", true);
		$data = array(
			"hjual_id" => $hjual_id,
			"payment_id" => $payment_id
		);
		$this->Admin_model->do_confirmpayment($data);
		redirect(base_url("admin/confirmpayment"));
	}
}
