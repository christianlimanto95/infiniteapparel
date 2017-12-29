<div id="container">
<?php
	echo form_open("admin/order_list", array("id" => "formOrder"));
	echo "<div>STATUS ORDER :</div>";
	echo form_dropdown("cbOrder", $cbOrder, $cbOrderSelected, "id='cbOrder'");
	echo form_close();
	
	if ($cbOrderSelected != "null")
	{	?>
		<div class="result-count"><?php echo count($dataorder); ?> Results</div>
		<table class="order-table">
			<thead>
				<tr>
					<td class="td-id">Order ID</td>
					<td>Email</td>
					<td>Nama</td>	
					<td>Kota</td>	
					<td>Alamat</td>
					<td>HP</td>
					<td class="td-resi">RESI</td>
			<?php	if ($cbOrderSelected != "delivered") 
					{	?>
						<td class="td-action">Action</td>
			<?php	}	?>
				</tr>
			</thead>
			<tbody>
			<?php
			if ($cbOrderSelected == 'onprocess')
			{   
				$ctr = 0;
				foreach ($dataorder as $row)
				{
					$ctr++;
					$odd = "";
					if ($ctr % 2 == 1)
					{
						$odd = "odd";
					}
					
					echo "<tr class='" . $odd . "'>";
					echo "<form class='form-add-resi' method='post' action='" . base_url("admin/order_list") . "' >";
					echo "<td class='td-id'>" . "<a href='" . site_url("project/detail_laporan/" . $row->hjual_id) . "' class='id_pemesanan'>" . $row->hjual_id . "</td>";
					echo "<td>".$row->user_email."</td>";
					echo "<td>".$row->pemesanan_first_name." ".$row->pemesanan_last_name."</td>";
					echo "<td>".$row->city_name."</td>";
					echo "<td>".$row->pemesanan_address."</td>";
					echo "<td>".$row->pemesanan_handphone."</td>";
					echo "<td class='td-resi'>" . form_input("resi", "") . "</td>";
					echo form_hidden('idpemesan', $row->hjual_id) . "</td>";
					echo "<td class='td-action'>".form_submit('btnGO', 'Save')."</td>";
					echo form_close();
					echo "</tr>";
					
				}
			}
			else
			{
				$ctr = 0;
				foreach ($dataorder as $row)
				{
					$ctr++;
					$odd = "";
					if ($ctr % 2 == 1)
					{
						$odd = "odd";
					}
					
					echo "<tr class='" . $odd . "'>";
					echo form_open("admin/order_list", array("id" => "formDeliver", "data-nomor_resi" => $row->hjual_nomor_resi));
					echo "<td class='td-id'>" . "<a href='" . site_url("admin/detailpayment/" . $row->hjual_id) . "' class='id_pemesanan'>" . $row->hjual_id . "</td>";
					echo "<td>".$row->user_email."</td>";
					echo "<td>".$row->pemesanan_first_name." ".$row->pemesanan_last_name."</td>";
					echo "<td>".$row->city_name."</td>";
					echo "<td>".$row->pemesanan_address."</td>";
					echo "<td>" . $row->pemesanan_handphone . "</td>";
					echo "<td class='td-resi'>" . $row->hjual_nomor_resi . "</td>";
					if ($cbOrderSelected == "shipping")
					{
						echo "<td class='td-action'>";
						echo form_submit("btnSetDelivered", "Set Delivered", "class='btn-set-delivered'");
						echo "</td>";
					}
					echo form_hidden('idpemesan', $row->hjual_id) . "</td>";
					echo form_close();
					echo "</tr>";
					
				}
			}
			?>
			</tbody>
		</table>
<?php	}	?>
</div>