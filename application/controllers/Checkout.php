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
			$user_id = parent::is_logged_in();
			$cart = $this->Checkout_model->get_cart($user_id);
			$user_total_payment = intval($cart[0]["user_total_payment"]);
			
			$total_qty = $cart[0]["hcart_total_qty"];
			$total_price = $cart[0]["hcart_total_price"];
			$discount = 0;
			if ($user_total_payment > 1500000) {
				$discount = intval($total_price) / 10;
			}

			$weight = 200 * intval($total_qty);
			$shipping = $this->getCost("329", $city_id, $weight, $shipping_name);
			$shipping_cost = intval($shipping[$shipping_service]);

			$hjual_grand_total_price = intval($total_price) - $discount + $shipping_cost;

			$data = array(
				"user_id" => $user_id,
				"hjual_total_price" => $total_price,
				"hjual_discount" => $discount,
				"hjual_grand_total_price" => $hjual_grand_total_price,
				"first_name" => $first_name,
				"last_name" => $last_name,
				"city_id" => $city_id,
				"address" => $address,
				"handphone" => $handphone,
				"hjual_shipping_name" => $shipping_name,
				"hjual_shipping_service" => $shipping_service,
				"hjual_shipping_cost" => $shipping_cost,
				"cart" => $cart
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

	function get_discount() {
		parent::show_404_if_not_ajax();
		$user_id = parent::is_logged_in();
		$user_total_payment = intval($this->Checkout_model->get_user_total_payment($user_id));
		if ($user_total_payment > 1500000) {
			echo json_encode(array(
				"status" => "success",
				"discount" => "yes"
			));
		} else {
			echo json_encode(array(
				"status" => "success",
				"discount" => "no"
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
		$total_qty = intval($this->input->post("total_qty"));
		$weight = 200 * $total_qty;
		$results = [];
		$results["jne"] = $this->getCost("329", $destination, $weight, "jne");
		$results["pos"] = $this->getCost("329", $destination, $weight, "pos");
		$results["tiki"] = $this->getCost("329", $destination, $weight, "tiki");
		
		echo json_encode($results);
	}

	function getCost($origin, $destination, $weight, $service) {
		$curl = curl_init();
				
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $service,
		  CURLOPT_HTTPHEADER => array(
			"content-type: application/x-www-form-urlencoded",
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
