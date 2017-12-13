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

	function do_login() {
		$user_email = $this->input->post("user_email", true);
		$user_password = $this->input->post("user_password", true);
		$data = $this->Home_model->get_email_password($user_email);
		if (sizeof($data) > 0) {
			$stored_password = $data[0]->user_password;
			if (password_verify($user_password, $stored_password)) {
				$this->input->set_cookie(array(
					"name" => "infinite_apparel_user",
					"value" => $data[0]->user_id,
					"expire" => "2592000"
				));

				$cart = $this->input->cookie("infinite_apparel_cart", true);
				if ($cart) {
					$cart_item = explode("|", $cart);
					if (sizeof($cart_item) > 0) {
						$dcart = array(
							"user_id" => $data[0]->user_id,
							"data" => array()
						);
						
						for ($i = 0; $i < sizeof($cart_item); $i++) {
							$cart_item_col = explode("~", $cart_item[$i]);
							$item_id = $cart_item_col[0];
							$item_size = $cart_item_col[1];
							$item_qty = intval($cart_item_col[2]);
							$item_type = $cart_item_col[3];
							$shirt_custom_id = $cart_item_col[4];
							$design_custom_id = $cart_item_col[5];
							$item_name_price = ($item_type == 1) ? $this->Home_model->get_item_name_and_price_by_id($item_id) : $this->Home_model->get_custom_name_price_by_custom_id($design_custom_id);
							$item_name = $item_name_price[0]->item_name;
							$item_price = intval($item_name_price[0]->item_price);
							$item_subtotal = intval($item_qty * $item_price);

							$itemData = array(
								"item_id" => $item_id,
								"item_size" => $item_size,
								"item_qty" => $item_qty,
								"item_type" => $item_type,
								"shirt_custom_id" => $shirt_custom_id,
								"design_custom_id" => $design_custom_id,
								"item_name" => $item_name,
								"item_price" => $item_price,
								"item_subtotal" => $item_subtotal
							);
							array_push($dcart["data"], $itemData);
						}
						$this->Home_model->insert_bags_from_cookie($dcart);
					}
					delete_cookie("infinite_apparel_cart");
				}

				echo json_encode(array(
					"status" => "success"
				));
			} else {
				echo json_encode(array(
					"status" => "error"
				));
			}
		} else {
			echo json_encode(array(
				"status" => "error"
			));
		}
	}

	function logout() {
		delete_cookie("infinite_apparel_user");
		echo json_encode(array(
			"status" => "success"
		));
	}

	function get_cart() {
		$user_id = parent::is_logged_in();
		if ($user_id) {
			$cart = $this->Home_model->get_cart($user_id);
			if ($cart) {
				if ($cart[0]->status == "success") {
					$iLength = sizeof($cart);
					for ($i = 0; $i < $iLength; $i++) {
						$cart[$i]->item_price = number_format($cart[$i]->item_price, 0, ",", ".");
						$cart[$i]->item_subtotal = number_format($cart[$i]->item_subtotal, 0, ",", ".");
					}

					echo json_encode(array(
						"total_qty" => $cart[0]->hcart_total_qty,
						"total_subtotal" => number_format($cart[0]->hcart_total_price, 0, ",", "."),
						"data" => $cart
					));
					
				} else {
					echo json_encode(array(
						"total_qty" => 0,
						"total_subtotal" => 0,
						"data" => array()
					));
				}
			} else {
				echo json_encode(array(
					"total_qty" => 0,
					"total_subtotal" => 0,
					"data" => array()
				));
			}
		} else {
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
					$item_type = $cart_item_col[3];
					$shirt_custom_id = $cart_item_col[4];
					$design_custom_id = $cart_item_col[5];

					$item_data = ($item_type == 1) ? $this->Home_model->get_product_by_id($item_id) : $this->Home_model->get_custom_name_price_by_custom_id($design_custom_id);
					if (sizeof($item_data) > 0) {
						$item_data = $item_data[0];

						$total_qty += $item_qty;
						$cart_item[$i] = new stdClass();
						$cart_item[$i]->dcart_id = -1;
						$cart_item[$i]->item_id = $item_id;
						$cart_item[$i]->item_type = $item_type;
						$cart_item[$i]->item_name = $item_data->item_name;
						$cart_item[$i]->item_price = number_format($item_data->item_price, 0, ",", ".");
						$cart_item[$i]->item_size = $item_size;
						$cart_item[$i]->item_qty = $item_qty;
						$cart_item[$i]->shirt_custom_id = $shirt_custom_id;
						$cart_item[$i]->design_custom_id = $design_custom_id;
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
	}

	function add_to_cart() {
		$item_id = $this->input->post("item_id", true);
		$item_size = $this->input->post("item_size", true);
		$item_qty = intval($this->input->post("item_qty", true));
		$item_type = $this->input->post("item_type", true);
		$shirt_custom_id = $this->input->post("shirt_custom_id", true);
		$design_custom_id = $this->input->post("design_custom_id", true);

		if ($item_type == 1) {
			$shirt_custom_id = -1;
			$design_custom_id = -1;
		} else {
			$item_id = -1;
		}

		$user_id = parent::is_logged_in();
		if ($user_id) {
			if ($item_type == 2) {
				$notes = $this->input->post("notes", true);
				$data = array(
					"shirt_custom_id" => $shirt_custom_id,
					"design_custom_id" => $design_custom_id,
					"item_size" => $item_size,
					"item_qty" => $item_qty,
					"notes" => $notes,
					"user_id" => $user_id
				);
				$result = $this->Home_model->insert_dcart_custom($data)[0];
				echo json_encode($result);
			} else {
				$data = array(
					"item_id" => $item_id,
					"item_size" => $item_size,
					"item_qty" => $item_qty,
					"item_type" => $item_type,
					"user_id" => $user_id
				);
				$result = $this->Home_model->insert_dcart($data)[0];
				echo json_encode($result);
			}
		} else {
			$newItem = true;
			$current_cookie = $this->input->cookie("infinite_apparel_cart", true);
			if (!$current_cookie) {
				$current_cookie = "";
			} else {
				if ($current_cookie != "") {
					$current_cookie_item = explode("|", $current_cookie);

					if ($item_type == 1) {
						for ($i = 0; $i < sizeof($current_cookie_item); $i++) {
							$current_cookie_item_col = explode("~", $current_cookie_item[$i]);
							if ($current_cookie_item_col[0] == $item_id && $current_cookie_item_col[1] == $item_size && $current_cookie_item_col[3] == 1) {
								$current_cookie_item_col[2] += $item_qty;
								$current_cookie_item[$i] = $current_cookie_item_col[0] . "~" . $current_cookie_item_col[1] . "~" . $current_cookie_item_col[2] . "~" . $current_cookie_item_col[3] . "~" . $current_cookie_item_col[4] . "~" . $current_cookie_item_col[5];
								$newItem = false;
								break;
							}
						}
					} else {
						for ($i = 0; $i < sizeof($current_cookie_item); $i++) {
							$current_cookie_item_col = explode("~", $current_cookie_item[$i]);
							if ($current_cookie_item_col[1] == $item_size && $current_cookie_item_col[4] == $shirt_custom_id && $current_cookie_item_col[5] == $design_custom_id && $current_cookie_item_col[3] == 2) {
								$current_cookie_item_col[2] += $item_qty;
								$current_cookie_item[$i] = $current_cookie_item_col[0] . "~" . $current_cookie_item_col[1] . "~" . $current_cookie_item_col[2] . "~" . $current_cookie_item_col[3] . "~" . $current_cookie_item_col[4] . "~" . $current_cookie_item_col[5];
								$newItem = false;
								break;
							}
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
					"value" => $current_cookie . $item_id . "~" . $item_size . "~" . $item_qty . "~" . $item_type . "~" . $shirt_custom_id . "~" . $design_custom_id,
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
				"status" => "success"
			));
		}
	}

	function remove_from_cart() {
		$index = intval($this->input->post("index"));
		$dcart_id = $this->input->post("dcart_id", true);

		$user_id = parent::is_logged_in();
		if ($user_id) {
			$result = $this->Home_model->remove_from_cart($dcart_id)[0];
			echo json_encode($result);
		} else {
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
	}

	function cart_change_qty() {
		$item_qty = intval($this->input->post("item_qty"));
		$index = intval($this->input->post("index"));
		$dcart_id = $this->input->post("dcart_id", true);

		$user_id = parent::is_logged_in();
		if ($user_id) {
			$data = array(
				"dcart_id" => $dcart_id,
				"item_qty" => $item_qty,
				"user_id" => $user_id
			);
			$result = $this->Home_model->update_dcart_qty($data)[0];
			echo json_encode($result);
		} else {
			$current_cookie = $this->input->cookie("infinite_apparel_cart", true);
			if ($current_cookie) {
				$current_cookie_item = explode("|", $current_cookie);
				$cookie_item_col = explode("~", $current_cookie_item[$index]);
				$cookie_item_col[2] = $item_qty;
				$current_cookie_item[$index] = $cookie_item_col[0] . "~" . $cookie_item_col[1] . "~" . $cookie_item_col[2] . "~" . $cookie_item_col[3] . "~" . $cookie_item_col[4] . "~" . $cookie_item_col[5];

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

	function cart_change_size() {
		$item_size = $this->input->post("item_size");
		$index = intval($this->input->post("index"));
		$dcart_id = $this->input->post("dcart_id", true);

		$user_id = parent::is_logged_in();
		if ($user_id) {
			$data = array(
				"dcart_id" => $dcart_id,
				"item_size" => $item_size
			);
			$this->Home_model->update_dcart_size($data);
			echo json_encode(array(
				"status" => "success"
			));
		} else {
			$current_cookie = $this->input->cookie("infinite_apparel_cart", true);
			if ($current_cookie) {
				$current_cookie_item = explode("|", $current_cookie);
				$cookie_item_col = explode("~", $current_cookie_item[$index]);
				$cookie_item_col[1] = $item_size;
				$current_cookie_item[$index] = $cookie_item_col[0] . "~" . $cookie_item_col[1] . "~" . $cookie_item_col[2] . "~" . $cookie_item_col[3] . "~" . $cookie_item_col[4] . "~" . $cookie_item_col[5];

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
}
