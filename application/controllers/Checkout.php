<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Checkout extends General_controller {
	public function __construct() {
		parent::__construct();
		parent::redirect_if_not_logged_in();
		$this->load->model("Checkout_model");
	}
	
	public function index()
	{
		$user_id = parent::is_logged_in();
		$data = array(
			"title" => "Infinite Apparel | Checkout",
			"header_additional_class" => " invers"
		);
		
		parent::disable_get_cart();
		parent::view("checkout", $data);
	}

	function do_checkout() {
		parent::show_404_if_not_ajax();

		$first_name = $this->input->post("first_name", true);
		$last_name = $this->input->post("last_name", true);
		$city_id = $this->input->post("city_id", true);
		$address = $this->input->post("address", true);
		$handphone = $this->input->post("handphone", true);
		$shipping_name = $this->input->post("shipping_name", true);
		$shipping_service = $this->input->post("shipping_service", true);

		if ($shipping_name != "" && $shipping_service != "") {
			$shipping = $this->getCost("444", $city_id, 1000, $shipping_name);
			$shipping_cost = intval($shipping[$shipping_service]);
			$data = array(
				"first_name" => $first_name,
				"last_name" => $last_name,
				"city_id" => $city_id,
				"address" => $address,
				"handphone" => $handphone,
				"shipping_name" => $shipping_name,
				"shipping_service" => $shipping_service,
				"shipping_cost" => $shipping_cost
			);
			$this->Checkout_model->do_checkout($data);
			echo json_encode(array(
				"status" => "success"
			));
		} else {
			echo json_encode(array(
				"status" => "error"
			));
		}
	}

	function get_city() {
		parent::show_404_if_not_ajax();
		$city = $this->Checkout_model->get_city();
		echo json_encode($city);
	}

	function get_cost() {
		parent::show_404_if_not_ajax();	
		$destination = $this->input->post("city_id", true);
		
		$results = [];
		$results["jne"] = $this->getCost("444", $destination, 1000, "jne");
		$results["pos"] = $this->getCost("444", $destination, 1000, "pos");
		$results["tiki"] = $this->getCost("444", $destination, 1000, "tiki");
		
		echo json_encode($results);
	}

	function getCost($origin, $destination, $weight, $service) {
		$curl = curl_init();
				
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $service,
		  CURLOPT_HTTPHEADER => array(
			"key: 5d1cb4473cdfbd9c57932438b0566cd5"
		  )
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		
		$apiResult = "";
		
		if ($err) {
			
		} else {
			$result = json_decode($response)->rajaongkir->results[0];
			$costs = $result->costs;
			
			foreach ($costs as $row) {
				$apiResult[$row->service] = $row->cost[0]->value;
			}
		}
		
		return $apiResult;
	}
}
