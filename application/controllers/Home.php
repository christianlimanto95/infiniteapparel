<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include general controller supaya bisa extends General_controller
require_once("application/core/General_controller.php");

class Home extends General_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Home_model");
	}
	
	public function index()
	{
		$available_now = $this->Home_model->get_available_now();
		$data = array(
			"title" => "Infinite Apparel",
			"header_additional_class" => "",
			"available_now" => $available_now
		);
		
		parent::view("home", $data);
	}

	function get_cart() {
		$cart = $this->input->cookie("infinite_apparel_cart", true);
		if ($cart) {
			$total_qty = 0;
			$total_subtotal = 0;
			$cart_item = explode("|", $cart);
			for ($i = 0; $i < sizeof($cart_item); $i++) {
				$cart_item_col = explode("~", $cart_item[$i]);
				$item_id = $cart_item_col[0];
				$item_size = $cart_item_col[1];
				$item_qty = intval($cart_item_col[2]);

				$item_data = $this->Home_model->get_product_by_id($item_id);
				if (sizeof($item_data) > 0) {
					$item_data = $item_data[0];

					$total_qty += $item_qty;
					$cart_item[$i] = new stdClass();
					$cart_item[$i]->item_id = $item_id;
					$cart_item[$i]->item_name = $item_data->item_name;
					$cart_item[$i]->item_price = number_format($item_data->item_price, 0, ",", ".");
					$cart_item[$i]->item_size = $item_size;
					$cart_item[$i]->item_qty = $item_qty;
					$subtotal = intval($item_data->item_price) * $item_qty;
					$cart_item[$i]->item_subtotal = number_format($subtotal, 0, ",", ".");
					$total_subtotal += $subtotal;
				} else {
					array_splice($cart_item, $i, 1);
				}
			}
			echo json_encode(array(
				"total_qty" => $total_qty,
				"total_subtotal" => number_format($total_subtotal, 0, ",", "."),
				"data" => $cart_item
			));
		} else {
			echo json_encode(array(
				"total_qty" => 0,
				"total_subtotal" => 0,
				"data" => array()
			));
		}
	}

	function add_to_cart_cookie() {
		$item_id = $this->input->post("item_id", true);
		$item_size = $this->input->post("item_size", true);
		$item_qty = intval($this->input->post("item_qty", true));

		$newItem = true;
		$current_cookie = $this->input->cookie("infinite_apparel_cart", true);
		if (!$current_cookie) {
			$current_cookie = "";
		} else {
			if ($current_cookie != "") {
				$current_cookie_item = explode("|", $current_cookie);
				for ($i = 0; $i < sizeof($current_cookie_item); $i++) {
					$current_cookie_item_col = explode("~", $current_cookie_item[$i]);
					if ($current_cookie_item_col[0] == $item_id && $current_cookie_item_col[1] == $item_size) {
						$current_cookie_item_col[2] += $item_qty;
						$current_cookie_item[$i] = $current_cookie_item_col[0] . "~" . $current_cookie_item_col[1] . "~" . $current_cookie_item_col[2];
						$newItem = false;
						break;
					}
				}

				if ($newItem) {
					$current_cookie .= "|";
				} else {
					$current_cookie = "";
					for ($i = 0; $i < sizeof($current_cookie_item); $i++) {
						if ($current_cookie != "") {
							$current_cookie .= "|";
						}
						$current_cookie .= $current_cookie_item[$i];
					}
				}
			}
		}

		if ($newItem) {
			$this->input->set_cookie(array(
				"name" => "infinite_apparel_cart",
				"value" => $current_cookie . $item_id . "~" . $item_size . "~" . $item_qty,
				"expire" => "31556926"
			));
		} else {
			$this->input->set_cookie(array(
				"name" => "infinite_apparel_cart",
				"value" => $current_cookie,
				"expire" => "31556926"
			));
		}

		echo json_encode(array(
			"status" => "success",
			"cookie" => $current_cookie
		));
	}

	function remove_from_cart_cookie() {
		$index = intval($this->input->post("index"));
		$current_cookie = $this->input->cookie("infinite_apparel_cart", true);
		if ($current_cookie) {
			$current_cookie_item = explode("|", $current_cookie);
			array_splice($current_cookie_item, $index, 1);

			$current_cookie = "";
			for ($i = 0; $i < sizeof($current_cookie_item); $i++) {
				if ($current_cookie != "") {
					$current_cookie .= "|";
				}
				$current_cookie .= $current_cookie_item[$i];
			}
			$this->input->set_cookie(array(
				"name" => "infinite_apparel_cart",
				"value" => $current_cookie,
				"expire" => "31556926"
			));
		}

		echo json_encode(array(
			"status" => "success"
		));
	}

	function cart_change_qty() {
		$item_qty = intval($this->input->post("item_qty"));
		$index = intval($this->input->post("index"));
		$current_cookie = $this->input->cookie("infinite_apparel_cart", true);
		if ($current_cookie) {
			$current_cookie_item = explode("|", $current_cookie);
			$cookie_item_col = explode("~", $current_cookie_item[$index]);
			$cookie_item_col[2] = $item_qty;
			$current_cookie_item[$index] = $cookie_item_col[0] . "~" . $cookie_item_col[1] . "~" . $cookie_item_col[2];

			$current_cookie = "";
			for ($i = 0; $i < sizeof($current_cookie_item); $i++) {
				if ($current_cookie != "") {
					$current_cookie .= "|";
				}
				$current_cookie .= $current_cookie_item[$i];
			}

			$this->input->set_cookie(array(
				"name" => "infinite_apparel_cart",
				"value" => $current_cookie,
				"expire" => "31556926"
			));
		}

		echo json_encode(array(
			"status" => "success"
		));
	}

	function cart_change_size() {
		$item_size = $this->input->post("item_size");
		$index = intval($this->input->post("index"));
		$current_cookie = $this->input->cookie("infinite_apparel_cart", true);
		if ($current_cookie) {
			$current_cookie_item = explode("|", $current_cookie);
			$cookie_item_col = explode("~", $current_cookie_item[$index]);
			$cookie_item_col[1] = $item_size;
			$current_cookie_item[$index] = $cookie_item_col[0] . "~" . $cookie_item_col[1] . "~" . $cookie_item_col[2];

			$current_cookie = "";
			for ($i = 0; $i < sizeof($current_cookie_item); $i++) {
				if ($current_cookie != "") {
					$current_cookie .= "|";
				}
				$current_cookie .= $current_cookie_item[$i];
			}

			$this->input->set_cookie(array(
				"name" => "infinite_apparel_cart",
				"value" => $current_cookie,
				"expire" => "31556926"
			));
		}

		echo json_encode(array(
			"status" => "success"
		));
	}
}
