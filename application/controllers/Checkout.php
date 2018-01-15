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
		$city_name = $this->input->post("city_name", true);
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

			$weight = 200 * intval($total_qty) / 1000;
			if ($weight < 1) {
				$weight = 1;
			}
			$shipping = $this->getCost($city_id, $city_name, $weight, $shipping_name);
			$shipping_cost = intval($shipping[$shipping_service]["cost"]);

			$hjual_grand_total_price = intval($total_price) - $discount + $shipping_cost;

			$data = array(
				"user_id" => $user_id,
				"hjual_total_price" => $total_price,
				"hjual_discount" => $discount,
				"hjual_grand_total_price" => $hjual_grand_total_price,
				"first_name" => $first_name,
				"last_name" => $last_name,
				"city_id" => $city_id,
				"city_name" => $city_name,
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

		$keyword = $this->input->post("keyword", true);
		$curl = curl_init();
				
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://www.cektarif.com/exp/jne/jne.getoption.php?term=" . $keyword,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		$apiResult = $response;
		if ($err) {
			$apiResult = $err;
		}

		echo json_encode(json_decode($apiResult));
	}

	function get_cost() {
		parent::show_404_if_not_ajax();	
		$city_id = $this->input->post("city_id", true);
		$city_name = $this->input->post("city_name", true);
		$total_qty = intval($this->input->post("total_qty"));
		$weight = 200 * $total_qty / 1000;
		if ($weight < 1) {
			$weight = 1;
		}
		/*$curl = curl_init();
				
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://www.cektarif.com/exp/jne/jne.tarif.php",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "panel_type=info&exp_name=jne&exp_title=JNE&kotaAsaljne=PALU&kotaAsaljne_val=UExXMTAwMDBK&kotaTujuanjne=JAKARTA&kotaTujuanjne_val=Q0dLMTAwMDBK&beratKgjne=1",
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$info = curl_getinfo($curl);
		curl_close($curl);

		$apiResult = json_decode($response);
		if ($err) {
			$apiResult = json_decode($err);
		}*/

		$postdata = http_build_query(
			array(
				'panel_type' => 'info',
				'exp_name' => 'jne',
				"exp_title" => "JNE",
				"kotaAsaljne" => "PALU",
				"kotaAsaljne_val" => "UExXMTAwMDBK",
				"kotaTujuanjne" => $city_name,
				"kotaTujuanjne_val" => $city_id,
				"beratKgjne" => $weight . ""
			)
		);
		
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);
		
		$context  = stream_context_create($opts);
		
		$apiResult = file_get_contents('http://www.cektarif.com/exp/jne/jne.tarif.php', false, $context);

		$dom = new DOMDocument;
		libxml_use_internal_errors(true);
		$dom->loadHTML($apiResult);
		libxml_clear_errors();

		$xpath = new DomXPath($dom);
		$items = $xpath->query("//tbody");

		$services = array();
		foreach ($items as $item) {
			$nodeValue = $item->nodeValue;
			if ($item->childNodes->length > 0) {
				foreach ($item->childNodes as $tr) {
					$service_name = $tr->childNodes[0]->nodeValue;
					$service_cost = $tr->childNodes[4]->nodeValue;
					$service_time = $tr->childNodes[6]->nodeValue;
					array_push($services, array(
						"name" => $service_name,
						"cost" => str_replace(",", "", $service_cost),
						"time" => $service_time
					));
				}
			}	
		}

		echo json_encode($services);
	}

	function getCost($city_id, $city_name, $weight, $service) {
		/*$curl = curl_init();
				
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
		
		return $apiResult;*/

		$postdata = http_build_query(
			array(
				'panel_type' => 'info',
				'exp_name' => 'jne',
				"exp_title" => "JNE",
				"kotaAsaljne" => "PALU",
				"kotaAsaljne_val" => "UExXMTAwMDBK",
				"kotaTujuanjne" => $city_name,
				"kotaTujuanjne_val" => $city_id,
				"beratKgjne" => $weight . ""
			)
		);
		
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);
		
		$context  = stream_context_create($opts);
		
		$apiResult = file_get_contents('http://www.cektarif.com/exp/jne/jne.tarif.php', false, $context);

		$dom = new DOMDocument;
		libxml_use_internal_errors(true);
		$dom->loadHTML($apiResult);
		libxml_clear_errors();

		$xpath = new DomXPath($dom);
		$items = $xpath->query("//tbody");

		$services = array();
		foreach ($items as $item) {
			$nodeValue = $item->nodeValue;
			if ($item->childNodes->length > 0) {
				foreach ($item->childNodes as $tr) {
					$service_name = $tr->childNodes[0]->nodeValue;
					$service_cost = $tr->childNodes[4]->nodeValue;
					$service_time = $tr->childNodes[6]->nodeValue;
					
					$services[$service_name] = array(
						"cost" => str_replace(",", "", $service_cost),
						"time" => $service_time
					);
				}
			}	
		}

		return $services;
	}
}
