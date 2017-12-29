<div id="container">
	<?php
	
	echo form_open(base_url("admin/laporanpenjualan"), array("id" => "formLaporanPenjualan"));
		echo "<div class='input-group date dateFrom-container' id='datepickerFrom'>";
			echo "<div class='date-label'>From</div>";
			echo "<input type='text' name='dateFrom' class='dateFrom' value='" . $dateFrom . "' readonly data-provide='datepicker' data-date-end-date='" . $dateFromEndDate . "' data-date-disable-touch-keyboard='true' data-date-format='dd MM yyyy' data-date-max-view-mode='2' data-date-start-date='01 January 2016' data-date-autoclose='true'>";
			echo "<div class='input-group-addon'></div>";
		echo "</div>";
		echo "<div class='input-group date dateTo-container' id='datepickerTo'>";
			echo "<div class='date-label'>To</div>";
			echo "<input type='text' name='dateTo' class='dateTo' value='" . $dateTo . "' readonly data-provide='datepicker' data-date-end-date='0d' data-date-disable-touch-keyboard='true' data-date-format='dd MM yyyy' data-date-max-view-mode='2' data-date-start-date='" . $dateToStartDate . "' data-date-autoclose='true'>";
			echo "<div class='input-group-addon'></div>";
		echo "</div>";
	echo form_close();
	
	echo "<div class='total-penjualan'>";
	if ($totalpenjualan != "")
	{
		echo "Total Penjualan : ". number_format($totalpenjualan[0]->grandtotal, 0, ",", ".") . " IDR";
	}
	else
	{
		echo "Total Penjualan : Rp - " ;
	}
	echo "</div>";
	?>
	
	<table class='penjualan-table'>
		<thead>
			<tr>
				<td>ID Pemesanan</td>
				<td>Email</td>
				<td>Total</td>
				<td>Tanggal</td>	
			</tr>
		</thead>
		<tbody>
		<?php
		if ($laporanbulan != "")
		{
			$ctr = 0;
			foreach ($laporanbulan as $row)
			{
				$ctr++;
				$odd = "";
				if ($ctr % 2 == 1)
				{
					$odd = "odd";
				}
				echo "<tr class='result-each " . $odd . "' data-href='" . base_url("admin/detailpayment/" . $row->hjual_id) . "'>";
					echo "<td>" . $row->hjual_id . "</td>";
					echo "<td>".$row->user_email."</td>";
					echo "<td>" . number_format($row->total, 0, ",", ".") . " IDR</td>";
					echo "<td>" . date("d/m/Y", strtotime($row->tanggal_create)) . "</td>";
				echo "</tr>";
			}
		}
		?>
		</tbody>
	</table>


</div>