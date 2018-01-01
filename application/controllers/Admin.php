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

		if ($category_id && $item_name && $item_price && $item_image_count) {
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

			$this->session->set_flashdata("admin_message", "Sukses insert item");
		} else {
			$this->session->set_flashdata("admin_message_error", "Error insert item");
		}

		redirect(base_url("admin/inserting"));
	}

	function updating() {
		$cbId["null"] = "Select Id Barang";
		$all_items = $this->Admin_model->get_all_item();
		foreach ($all_items as $row) {
			$cbId[$row->item_id] = $row->item_id . " - " . $row->item_name;
		}

		$cbIdSelected = "null";
		
		$data = array(
			"title" => "Infinite Apparel | Admin Update",
			"navigation" => base_url("admin/updating"),
			"cbId" => $cbId,
			"cbIdSelected" => $cbIdSelected
		);

		if ($this->input->post("cbId") == true && $this->input->post("cbId") != "null")
		{
			$data["cbIdSelected"] = $this->input->post("cbId", true);
			$dataBarang = $this->Admin_model->get_item_by_id($data["cbIdSelected"]);
			
			if (sizeof($dataBarang) > 0) {
				$data["namaupdate"] = $dataBarang[0]->item_name;
				$data["hargaupdate"] = $dataBarang[0]->item_price;
				$data["keteranganupdate"] = $dataBarang[0]->item_description;
				$data["cbSeries"] = $dataBarang[0]->category_id;
				$data["jumlah_gambar"] = $dataBarang[0]->item_image_count;

				$data["allSeries"] = [];
				$all_category = $this->Admin_model->getAllSeries();
				foreach ($all_category as $row) {
					$data["allseries"][$row->category_id] = $row->category_name;
				}	
			}
		}

		parent::adminview('updating', $data);
	}

	function do_update_item() {
		$item_id = $this->input->post("item_id", true);
		$item_category = $this->input->post("cbSeries", true);
		$item_description = $this->input->post("keteranganupdate", true);
		$item_price = $this->input->post("urharga", true);
		$item_name = $this->input->post("namaupdate", true);

		if ($item_id && $item_category && $item_price && $item_name) {
			if ($item_price == "other") {
				$item_price = $this->input->post("hargaupdate", true);
			}

			$data = array(
				"item_id" => $item_id,
				"item_category" => $item_category,
				"item_description" => $item_description,
				"item_price" => $item_price,
				"item_name" => $item_name
			);
			$this->Admin_model->update_item($data);

			$this->session->set_flashdata("admin_message", "Sukses update item id " . $item_id);
		} else {
			$this->session->set_flashdata("admin_message_error", "Error update item id " . $data["cbIdSelected"]);
		}

		redirect(base_url("admin/updating"));
	}

	function deleting() {
		$cbId["null"] = "Select Id Barang";
		$all_items = $this->Admin_model->get_all_item();
		foreach ($all_items as $row) {
			$cbId[$row->item_id] = $row->item_id . " - " . $row->item_name;
		}

		$cbIdSelected = "null";
		
		$data = array(
			"title" => "Infinite Apparel | Admin Delete",
			"navigation" => base_url("admin/deleting"),
			"cbId" => $cbId,
			"cbIdSelected" => $cbIdSelected
		);
		$data["msg"] = $this->session->flashdata("admin_message");

		parent::adminview('deleting', $data);
	}

	function do_delete_item() {
		$item_id = $this->input->post("item_id", true);
		if ($item_id) {
			$this->Admin_model->delete_item($item_id);
		}

		$this->session->set_flashdata("admin_message", "Berhasil delete item id " . $item_id);
		redirect(base_url("admin/deleting"));
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
		$result = $this->Admin_model->do_confirmpayment($data);

		if (sizeof($result) > 0) {
			$result = $result[0];
			$this->load->library("email", parent::get_default_email_config());
			$this->email->from("admin@infiniteapparelid.com", "Infinite Apparel Admin");
			$this->email->to($result->user_email);
			$this->email->subject("Payment for order no. " . $hjual_id . " confirmed");
			$this->email->message("Dear, " . $result->user_first_name . ",<br />We have confirmed your payment for order no. " . $hjual_id . " at infiniteapparelid.com.<br />We are going to deliver to you.<br /><br />Thank you.");
			$this->email->send();

			$this->session->set_flashdata("admin_message", "Sukses konfirmasi pembayaran untuk " . $result->user_email . " dengan order no. " . $hjual_id);
		}

		redirect(base_url("admin/confirmpayment"));
	}

	function do_declinepayment() {
		$payment_id = $this->input->post("payment_id", true);
		$hjual_id = $this->input->post("hjual_id", true);
		$data = array(
			"hjual_id" => $hjual_id,
			"payment_id" => $payment_id
		);
		$result = $this->Admin_model->do_declinepayment($data);

		if (sizeof($result) > 0) {
			$result = $result[0];
			$this->load->library("email", parent::get_default_email_config());
			$this->email->from("admin@infiniteapparelid.com", "Infinite Apparel Admin");
			$this->email->to($result->user_email);
			$this->email->subject("Payment for order no. " . $hjual_id . " declined");
			$this->email->message("Dear, " . $result->user_first_name . ",<br />We have declined your payment for order no. " . $hjual_id . " because the payment is not valid. You can try to confirm your payment or you can contact us at admin@infiniteapparelid.com.<br /><br />Thank you.");
			$this->email->send();

			$this->session->set_flashdata("admin_message", "Sukses menolak pembayaran untuk " . $result->user_email . " dengan order no. " . $hjual_id);
		}

		redirect(base_url("admin/confirmpayment"));
	}

	function order_list() {
		$data = array(
			"title" => "Infinite Apparel | Admin Order List",
			"navigation" => base_url("admin/order_list")
		);

		$data['idpemesan']="";
		$data["cbOrder"]["null"] = "Select One";
		$data["cbOrder"]['onprocess'] = "On Process"; 
		$data["cbOrder"]['shipping'] = "Shipping"; 
		$data["cbOrder"]['delivered'] = "Delivered"; 
		$data["cbOrderSelected"] = "null";
		$status = "";
		
		if ($this->input->get("cbOrder") == true && $this->input->get("cbOrder") != "null")
		{
			$data["cbOrderSelected"] = $this->input->get("cbOrder", true);
			if($data["cbOrderSelected"] == 'onprocess')
			{
				$status = 3;
			}
			else if($data["cbOrderSelected"] == 'shipping')
			{
				$status = 4;
			}
			else if($data["cbOrderSelected"] == 'delivered')
			{
				$status = 5;
			}
		}
		
		if ($this->input->post('btnGO') == true)
		{
			$data['idpemesan'] = $this->input->post('idpemesan',true);
			$data['resi'] = $this->input->post("resi", true);
			
			$insertData = array(
				"hjual_nomor_resi" => $data["resi"],
				"hjual_id" => $data["idpemesan"]
			);

			$this->Admin_model->insert_nomor_resi($insertData);

			$this->session->set_flashdata("admin_message", "Sukses insert no resi");
			
			$data["cbOrderSelected"] = "onprocess";
			$status = 3;
		}
		else if ($this->input->post("btnSetDelivered") == true)
		{
			$data['idpemesan'] = $this->input->post('idpemesan',true);
			
			$this->Admin_model->set_hjual_delivered($data['idpemesan']);
			
			$this->session->set_flashdata("admin_message", "Sukses Set Delivered");

			$data["cbOrderSelected"] = "shipping";
			$status = 4;
		}
		
		$data["dataorder"] = "";
		if ($status != "") {
			$data["dataorder"] = $this->Admin_model->get_hjual_by_hjual_status($status);
		}
				
		parent::adminview('admin_order_list', $data);
	}

	function laporanpenjualan() {
		$data = array(
			"title" => "Infinite Apparel | Admin Laporan Penjualan",
			"navigation" => base_url("admin/laporanpenjualan")
		);

		$data["dateFrom"] = "";
		$data["dateFromEndDate"] = "0d";
		$data["dateTo"] = "";
		$data["dateToStartDate"] = "01 January 2016";
		$data["laporanbulan"] = "";
		$data["totalpenjualan"] = "";
		
		if ($this->input->get("dateFrom") == true)
		{
			$dateFrom = $this->input->get("dateFrom", true);
			$selectData["dateFrom"] = date("Y-m-d H:i:s", strtotime($dateFrom));
			$dateTo = $this->input->get("dateTo", true);
			$selectData["dateTo"] = date("Y-m-d H:i:s", strtotime($dateTo . " 23:59:59"));
			
			$data["laporanbulan"] = $this->Admin_model->getLaporanBulanan($selectData);
			$data["totalpenjualan"] = $this->Admin_model->getSumHJualBulanan($selectData);
			
			$data["dateFrom"] = date("d F Y", strtotime($selectData["dateFrom"]));
			$data["dateTo"] = date("d F Y", strtotime($selectData["dateTo"]));
			
			$data["dateToStartDate"] = $data["dateFrom"];
			$data["dateFromEndDate"] = $data["dateTo"];
		}
		
		parent::adminview('admin_laporanpenjualan', $data);
	}

	function laporanstatistik()
	{
		$data = array(
			"title" => "Infinite Apparel | Admin Laporan Statistik",
			"navigation" => base_url("admin/laporanstatistik")
		);

		$data["dateFrom"] = "";
		$data["dateFromEndDate"] = "0d";
		$data["dateTo"] = "";
		$data["dateToStartDate"] = "01 January 2016";
		$data["cbsearch"]="";
		$data["selectedsearch"]="";
		$data["dateError"] = "";
		
		$data["datastatistik"]="";
				
		if ($this->input->get("btnGO") == true)
		{
			$dateFrom = $this->input->get("dateFrom", true);
			$selectData["dateFrom"] = date("Y-m-d H:i:s", strtotime($dateFrom));
			$dateTo = $this->input->get("dateTo", true);
			$selectData["dateTo"] = date("Y-m-d H:i:s", strtotime($dateTo . " 23:59:59"));
			
			$data["dateFrom"] = date("d F Y", strtotime($selectData["dateFrom"]));
			$data["dateTo"] = date("d F Y", strtotime($selectData["dateTo"]));
			
			$data["dateToStartDate"] = $data["dateFrom"];
			$data["dateFromEndDate"] = $data["dateTo"];
					
			$data["selectedsearch"] = $this->input->get("cbsearch", true);
			
			if ($data["selectedsearch"] != "null")
			{
				if ($dateFrom != "" && $dateTo != "")
				{
					if ($data["selectedsearch"] == 'mostsize')
					{
						$data["datastatistik"]= $this->Admin_model->getStatistikUkuran($selectData);
					}	
					else if ($data["selectedsearch"] == 'bestseller')
					{
						$data["datastatistik"]= $this->Admin_model->getStatistikBestSellerBulan($selectData);
					}
					else if ($data["selectedsearch"] == 'mostregional')
					{
						$data["datastatistik"]= $this->Admin_model->getStatistikDaerah($selectData);
					}
					
				}
				else
				{
					$data["dateError"] = "Please select the date range first";
				}
			}
		}
		
		parent::adminview('admin_laporanstatistik', $data);
	}

	function change_password() {
		$data = array(
			"title" => "Infinite Apparel | Admin Change Password",
			"navigation" => base_url("admin/change_password")
		);
		
		parent::adminview('change_password', $data);
	}

	function do_change_password() {
		$current_password = $this->input->post("current_password", true);
		$new_password = $this->input->post("new_password", true);

		if ($current_password && $new_password) {
			$data = array(
				"current_password" => $current_password,
				"new_password" => $new_password
			);
			$result = $this->Admin_model->change_password($data);
			if ($result) {
				$this->session->set_flashdata("admin_message", "Sukses ganti password");
			} else {
				$this->session->set_flashdata("admin_message_error", "Password lama salah");
			}
		}

		redirect(base_url("admin/change_password"));
	}
}
