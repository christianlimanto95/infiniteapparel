<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
NOTE
Just put general function which frequently used in this class
**/

class General_controller extends CI_Controller
{
	protected $additional_files = "";
	protected $do_get_cart = "true";
   
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

	public function disable_get_cart() {
		$this->do_get_cart = "false";
	}

    public function view($file, $data){
		$data["page_name"] = $file;
		$data["is_logged_in"] = false;
		$data["do_get_cart"] = $this->do_get_cart;

		$user = $this->input->cookie("infinite_apparel_user", true);
		if ($user) {
			$user_data = $this->General_model->get_user_logged_in($user);
			if (sizeof($user_data) > 0) {
				$data["is_logged_in"] = true;
				$data["user_first_name"] = $user_data[0]->user_first_name;
			}
		}
		
        $this->load->view('common/header', $data);
        $this->load->view($file, $data);
        $this->load->view('common/footer');
	}
	
	public function adminview($file, $data){
		$data["additional_files"] = $this->additional_files;
        $data["page_name"] = $file;
        
        $this->load->view('common/backheader', $data);
        $this->load->view($file, $data);
        $this->load->view('common/backfooter', $data);
    }

	public function redirect_if_not_logged_in() {
        if (!$this->input->cookie('infinite_apparel_user', true)) {
            redirect(base_url("product"));
        }
	}
	
	public function is_logged_in() {
		return $this->input->cookie('infinite_apparel_user', true);
	}

	function show_404_if_not_ajax() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
            return true;
        } else {
            show_404();
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

	public function upload_file_settings($path = '', $max_size = '', $file_name = "") {
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = $max_size;
        $config['remove_spaces'] = true;
        $config['overwrite'] = true;
        $config['encrypt_name'] = false;
        $config['max_width'] = '';
        $config['max_height'] = '';
        if ($file_name != "") {
            $config["file_name"] = $file_name;
        }
        $this->load->library('upload', $config);
	}
	
	public function get_default_email_config() {
        $config["protocol"] = "smtp";
		$config["smtp_host"] = "mail.infiniteapparelid.com";
		$config["smtp_user"] = "admin@infiniteapparelid.com";
		$config["smtp_pass"] = "sembarang1";
		$config["smtp_port"] = 465;
        $config["smtp_crypto"] = "ssl";
        $config["mailtype"] = "html";
        return $config;
    }
}