<div id="container">
<?php
	echo "<div class='subtitle'>DETAIL CONFIRM PAYMENT</div>";
	$r = $hpemesanan[0];
	$shipping_service = strtoupper($r->hjual_shipping_name) . " - " . $r->hjual_shipping_service;
	echo "<table class='table-detail' >";
		echo "<tr>";
			echo "<td class='table-label'>ID</td>";
			echo "<td> : " . $r->hjual_id . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td class='table-label'>Email</td>";
			echo "<td> : " . $r->user_email . "</td>";
		echo "</tr>";
	echo "</table>";
	echo "<div class='subtitle-section'>Recipient Info</div>";
	echo "<table class='table-recipient'>";
		echo "<tr>";
			echo "<td class='table-label'>Name</td>";
			echo "<td class='titik-dua'>:</td>";
			echo "<td>" . $r->pemesanan_first_name . " " . $r->pemesanan_last_name . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td class='table-label'>City</td>";
			echo "<td class='titik-dua'>:</td>";
			echo "<td>" . $r->city_name . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td class='table-label'>Address</td>";
			echo "<td class='titik-dua'>:</td>";
			echo "<td>" . $r->pemesanan_address . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td class='table-label'>Total</td>";
			echo "<td class='titik-dua'>:</td>";
			echo "<td>IDR " . number_format($r->hjual_grand_total_price, 0, ",", ".") . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td class='table-label'>Service</td>";
			echo "<td class='titik-dua'>:</td>";
			echo "<td>" . $shipping_service . "</td>";
		echo "</tr>";
	echo "</table>";
	echo "<div class='order-detail-container'>";
		echo "<div class='order-detail-panel' data-toggle='collapse' data-target='.order-detail-collapse'>Order Detail<span class='glyphicon glyphicon-menu-down'></span></div>";
		echo "<div class='collapse order-detail-collapse'>";
			echo "<table class='table-order-detail'>";
				echo "<thead>";
					echo "<tr>";
						echo "<td>Name</td>";
						echo "<td style='text-align: center;'>Size</td>";
						echo "<td style='text-align: center;'>Price</td>";
						echo "<td style='text-align: center;'>Qty</td>";
						echo "<td style='text-align: center;'>Subtotal</td>";
					echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				
				$ctr = 0;
				foreach ($dpemesanan as $row)
				{
					$odd = "";
					$ctr++;
					if ($ctr % 2 == 1)
					{
						$odd = "odd";
					}
					
					echo "<tr class='" . $odd . "'>";
						echo "<td>" . $row->item_name . "</td>";
						echo "<td style='text-align: center;'>" . strtoupper($row->item_size) . "</td>";
						echo "<td style='text-align: right;'>IDR " . number_format($row->item_price, 0, ",", ".") . "</td>";
						echo "<td style='text-align: center;'>" . $row->item_qty . "</td>";
						echo "<td style='text-align: right;'>IDR " . number_format($row->djual_subtotal, 0, ",", ".") . "</td>";
					echo "</tr>";
				}
				echo "</tbody>";
			echo "</table>";
			echo "<div class='order-detail-cost'>";
				echo "<span class='order-detail-cost-label'>Subtotal : </span><span>IDR " . number_format($r->hjual_total_price, 0, ",", ".") . "</span>";
			echo "</div>";
			echo "<div class='order-detail-cost'>";
				echo "<span class='order-detail-cost-label'>Shipping Cost : </span><span>IDR " . number_format($r->hjual_shipping_cost, 0, ",", ".") . "</span>";
			echo "</div>";
			echo "<div class='order-detail-cost'>";
				echo "<span class='order-detail-cost-label'>Discount : </span><span>IDR " . number_format($r->hjual_discount, 0, ",", ".") . "</span>";
			echo "</div>";
			echo "<div class='order-detail-cost'>";
				echo "<span class='order-detail-cost-label'>Total : </span><span>IDR " . number_format($r->hjual_grand_total_price, 0, ",", ".") . "</span>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	echo "<div class='subtitle-section payment-info'>Payment Info</div>";
	echo "<table class='table-payment'>";
		echo "<tr>";
			echo "<td class='table-label'>Bank</td>";
			echo "<td> : " . $r->payment_bank_name . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td class='table-label'>No Rekening</td>";
			echo "<td> : " . $r->payment_account_number . "</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td class='table-label'>Atas Nama</td>";
			echo "<td> : " . $r->payment_account_name . "</td>";
		echo "</tr>";
	echo "</table>";
	echo "<img src='" . base_url("uploads/") . $r->payment_id . ".jpg' width='100%'>";
	
	
	if($r->hjual_status == 2)
	{
		echo "<form class='form-confirm' method='post' action='" . base_url("admin/do_confirmpayment") . "'>";
		echo form_hidden('payment_id', $r->payment_id);
		echo form_hidden("hjual_id", $r->hjual_id);
		echo form_submit('btnconfirm','Confirm', 'class="button confirm-button"');
		echo form_close();

		echo "<form class='form-decline' method='post' action='" . base_url("admin/do_declinepayment") . "'>";
		echo form_hidden('payment_id', $r->payment_id);
		echo form_hidden("hjual_id", $r->hjual_id);
		echo form_submit('btndecline','Decline', 'class="button decline-button"');
		echo form_close();
	}
?>
</div>