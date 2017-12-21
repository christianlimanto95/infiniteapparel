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
		$this->load->library("upload");
		$this->load->library('form_validation');
		$this->load->model("Admin_model");
	}
	
	public function index()
	{
		$this->show_404_if_not_logged_in();
		
		$data = array(
			"title" => "Infinite Apparel | Admin"
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
	
		
		//---INSERT SERIES
		if ($this->input->post('btninsertseries')==true)
		{
			$param['nama']=$this->input->post('txtnama',true);
			$countid = $this->Admin_model->getCountSeries();
			foreach ($countid as $row)
			{
				$maxid = $row->getcount;
			}
			$maxid++;
			
			$param['id']= "SRS" . str_pad($maxid,3,"0",STR_PAD_LEFT);
			$this->form_validation->set_rules("txtnama", "Nama", "trim|required");
			if ($this->form_validation->run() == true)
			{
				$this->Admin_model->insertSeries($param);
			}
		}
		
		//INSERT BARANG
		if ($this->input->post('btninsert')==true)
		{
			$param['nama']=$this->input->post('txtnama',true);
			
			$harga=$this->input->post('rharga',true);
			if ($harga != "other")
			{
				$param['harga'] = $this->input->post('rharga',true);
			}
			else
			{
				$param['harga'] = $this->input->post('txtharga',true);
			}
			
			$param['series']=$this->input->post('cbSeries',true);
			$param['keterangan']=$this->input->post('txtketerangan',true);
			
			$countid = $this->Admin_model->getCountBarang();
			foreach ($countid as $row)
			{
				$maxid = $row->getcount;
			}
			$maxid++;
			
			$param['id']= "INFT" . str_pad($maxid,4,"0",STR_PAD_LEFT);
			
			$url = strtolower($param['nama']);
			$url = str_replace("'","",$url);
			$param['url']= str_replace(" ","-",$url);
			
			$this->form_validation->set_rules("txtnama", "Nama", "trim|required");
			$this->form_validation->set_rules("txtketerangan", "Keterangan", "trim|required");
			
			if ($_FILES["foto1"]["error"] != 4)
			{
				$config =
				[
					'upload_path' => 'C:/xampp/htdocs/infiniteapparel/assets/images/products',
					'allowed_types' => 'jpg|JPG|jpeg|JPEG',
					'overwrite' => true,
					'file_name' => $param["id"] . "_1",
					'max_size' => 100				];
			
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('foto1'))
				{
					$data["msg" ] = "sukses";
				}
				else
				{
					$data["msg"] = $this->upload->display_errors();
				}
				$param["jumlahgambar"]++;
			}
			if ($_FILES["foto2"]["error"] != 4)
			{
				$config =
				[
					'upload_path' => 'C:/xampp/htdocs/infiniteapparel/assets/images/products',
					'allowed_types' => 'jpg|JPG|jpeg|JPEG',
					'overwrite' => true,
					'file_name' => $param["id"] . "_2",
					'max_size' => 100				];
			
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('foto2'))
				{
					$data["msg" ] = "sukses";
				}
				else
				{
					$data["msg"] = $this->upload->display_errors();
				}
				$param["jumlahgambar"]++;
			}
			
			if ($_FILES["foto3"]["error"] != 4)
			{
				$config =
				[
					'upload_path' => 'C:/xampp/htdocs/infiniteapparel/assets/images/products',
					'allowed_types' => 'jpg|JPG|jpeg|JPEG',
					'overwrite' => true,
					'file_name' => $param["id"] . "_3",
					'max_size' => 100				];
			
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('foto3'))
				{
					$data["msg" ] = "sukses";
				}
				else
				{
					$data["msg"] = $this->upload->display_errors();
				}
				$param["jumlahgambar"]++;
			}
			
			if ($_FILES["foto4"]["error"] != 4)
			{
				$config =
				[
					'upload_path' => 'C:/xampp/htdocs/infiniteapparel/assets/images/products',
					'allowed_types' => 'jpg|JPG|jpeg|JPEG',
					'overwrite' => true,
					'file_name' => $param["id"] . "_4",
					'max_size' => 100				];
			
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('foto4'))
				{
					$data["msg" ] = "sukses";
				}
				else
				{
					$data["msg"] = $this->upload->display_errors();
				}
				
				$param["jumlahgambar"]++;
			}
			
			
			if ($this->form_validation->run() == true)
			{
				$this->Admin_model->insertBarang($param);
			}
		}
		
		parent::adminview('inserting', $data);
	}
}
