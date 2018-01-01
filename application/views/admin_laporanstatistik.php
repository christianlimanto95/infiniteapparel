<div id="container">
	<?php
		echo "<form id='formLaporanBulan' method='get' action='" . base_url("admin/laporanstatistik") . "' >";
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
		echo "<div class='error'>" . $dateError . "</div>";
		echo "<div class='search-by'>";
			echo "Search By :";
			$cbsearch = array (
				'null' => 'Select One',
				'bestseller'  => 'Penjualan Kaos',
				'mostregional'    => 'Daerah Pembeli',
				'mostsize' => 'Ukuran Terbanyak'
			);
			echo form_dropdown('cbsearch', $cbsearch, $selectedsearch, "id='cbsearch' style='margin-left: 5px;'") . "<br>";
			echo form_submit("btnGO", "GO", "id='btnGo' class='button'");
			echo form_close();
		echo "</div>";
	?>
	
<?php	if ($selectedsearch == 'bestseller' && $datastatistik != "") 
		{	?>
			<table class='result-table'>
				<thead>
					<tr>
						<td>Nama Barang</td>
						<td>Total</td>	
					</tr>
				</thead>
				<tbody>
				<?php
					$ctr = 0;
					foreach ($datastatistik as $row)
					{
						$ctr++;
						$odd = "";
						if ($ctr % 2 == 1)
						{
							$odd = "odd";
						}
						echo "<tr class='" . $odd . "'>";
						echo "<td>" . $row->nama . "</td>";
						echo "<td style='text-align: center;'>" . $row->total . "</td>";
						echo "</tr>";
					}
				?>
				</tbody>
			</table>
<?php	}	?>
	
<?php	if ($selectedsearch== 'mostsize') 
		{
			if ($datastatistik != "")
			{	?>
				<table class='result-table'>
					<thead>
						<tr>
							<td>Ukuran</td>
							<td>Total</td>	
						</tr>
					</thead>
					<tbody>
					<?php
						$ctr = 0;
						foreach ($datastatistik as $row)
						{
							$ctr++;
							$odd = "";
							if ($ctr % 2 == 1)
							{
								$odd = "odd";
							}
							echo "<tr class='" . $odd . "'>";
							echo "<td style='text-align: center;'>" . strtoupper($row->ukuran) . "</td>";
							echo "<td style='text-align: center;'>" . $row->total . "</td>";
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
	<?php	}
		}	?>

<?php	if ($selectedsearch== 'mostregional') 
		{
			if ($datastatistik != "")
			{	?>
				<table class='result-table'>
					<thead>
						<tr>
							<td>Kota</td>
							<td>Provinsi</td>
							<td>Total</td>
						</tr>
					</thead>
					<tbody>
					<?php
						$ctr = 0;
						foreach ($datastatistik as $row)
						{
							$ctr++;
							$odd = "";
							if ($ctr % 2 == 1)
							{
								$odd = "odd";
							}
							echo "<tr class='" . $odd . "'>";
							echo "<td style='text-align: center;'>" . $row->nama_kota . "</td>";
							echo "<td style='text-align: center;'>" . $row->nama_provinsi . "</td>";
							echo "<td style='text-align: center;'>" . $row->total . "</td>";
							echo "</tr>";
						}
					?>
					</tbody>
				</table>
	<?php	}
		}	?>

</div>