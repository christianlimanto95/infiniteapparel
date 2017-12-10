<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
NOTE
Just put general function which frequently used in this class
**/

class General_controller extends CI_Controller
{
	protected $additional_files = "";
   
    public function __construct()
    {
		parent::__construct();
		$this->load->helper("cookie");
        $this->load->model('common/General_model');
    }

	public function load_module($module_name) {
		$this->load_additional_css($module_name);
		$this->load_additional_js($module_name);
	}
	
	public function load_additional_css($file_name) {
		$this->additional_files .= "<link href='" . base_url("assets/css/template/" . $file_name . ".css") . "' rel='stylesheet'>";
	}
	
	public function load_additional_js($file_name) {
		$this->additional_files .= "<script src='" . base_url("assets/js/template/" . $file_name . ".js") . "' defer></script>";
	}

    public function view($file, $data){
		$data["additional_files"] = $this->additional_files;
		$data["page_name"] = $file;
		$infinite_apparel_cart = $this->input->cookie("infinite_apparel_cart", true);
		$infinite_apparel_cart_qty = 0;
		if ($infinite_apparel_cart) {
			$infinite_apparel_cart = explode("|", $infinite_apparel_cart);
			$infinite_apparel_cart_qty = sizeof($infinite_apparel_cart);
		}
		$data["infinite_apparel_cart"] = $infinite_apparel_cart;
		$data["infinite_apparel_cart_qty"] = $infinite_apparel_cart_qty;
		
        $this->load->view('common/header', $data);
        $this->load->view($file, $data);
        $this->load->view('common/footer');
    }

	public function cek_login() {
        if ($this->session->userdata('isLoggedIn') != 1) {
            redirect(base_url());
        }
    }

    public function currency_format($nominal) {
        return number_format($number, 0, ".", ",");
    }

    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz') {
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[mt_rand(0, $max)];
		}
		return $str;
	}

	function add_to_cart_cookie() {
		$item_id = $this->input->post("item_id", true);
		$item_size = $this->input->post("item_size", true);
		$item_qty = $this->input->post("item_qty", true);

		$current_cookie = $this->input->cookie("infinite_apparel_cart", true);
		if (!$current_cookie) {
			$current_cookie = "";
		} else {
			if ($current_cookie != "") {
				$current_cookie .= "|";
			}
		}
		$this->input->set_cookie(array(
			"name" => "infinite_apparel_cart",
			"value" => $current_cookie . $item_id . "~" . $item_size . "~" . $item_qty,
			"expire" => "31556926"
		));
		echo json_encode(array(
			"status" => "success"
		));
	}
}