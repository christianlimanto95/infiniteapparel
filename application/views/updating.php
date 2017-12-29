<div id="container">
	<?php
	
		echo "<div class='subtitle'>UPDATE BARANG</div>";
		
		echo form_open(base_url("admin/updating"), array("id" => "formIdBarang"));	
		echo form_dropdown("cbId", $cbId, $cbIdSelected, "id='cbId' style='margin-left: 5px;'");
		echo form_close();
		
		if ($cbIdSelected != "null")
		{
			echo "<form method='post' action='" . base_url("admin/do_update_item") . "' class='form-update-item'>";
			echo form_hidden("item_id", $cbIdSelected);
			echo "<div class='update-label'>Nama</div>" . form_input('namaupdate', $namaupdate, "class='input-nama'");
			echo "<div class='update-label'>Series</div>" . form_dropdown('cbSeries', $allseries, $cbSeries, "class='cbseries'");
			
			echo "<div class='update-label'>Harga</div>";
			echo "<label for='urharga-1'>";
				$checked = false;
				if ($hargaupdate == "125000") {
					$checked = true;
				}
				$data = array(
					'name'        => 'urharga',
					'id'		=> 'urharga-1',
					'value'       => '125000',
					'checked'     => $checked
					);
				
				echo form_radio($data) . "IDR " . number_format(125000, 0, ",", ".");
			echo "</label>";
			
			echo "<label for='urharga-2'>";
				$checked = false;
				if ($hargaupdate == "140000") {
					$checked = true;
				}
				$data = array(
					'name'        => 'urharga',
					'id'		=> 'urharga-2',
					'value'       => '140000',
					'checked'     => $checked
					);

				echo form_radio($data) . "IDR " . number_format(140000, 0, ",", ".");
			echo "</label>";

			echo "<label for='urharga-3'>";
				$checked = false;
				if ($hargaupdate == "325000") {
					$checked = true;
				}
				$data = array(
					'name'        => 'urharga',
					'id'		=> 'urharga-3',
					'value'       => '325000',
					'checked'     => $checked
					);

				echo form_radio($data) . "IDR " . number_format(325000, 0, ",", ".");
			echo "</label>";
			
			echo "<label for='urharga-4'>";
				$checked = false;
				if ($hargaupdate != "125000" && $hargaupdate != "140000" && $hargaupdate != "325000") {
					$checked = true;
				}
				$data = array(
					'name'        => 'urharga',
					'id'		=> 'urharga-4',
					'value'       => 'other',
					'checked'     => $checked
					);
				echo form_radio($data);
				$harga = "";
				if ($checked) {
					$harga = $hargaupdate;
				}
				echo "Other " . "<input type='number' name='hargaupdate' value='" . $harga . "'>";
			echo "</label>";
			echo "Keterangan <br>" . form_textarea("keteranganupdate", $keteranganupdate)."<br>";
			echo "<br><br>";
			echo form_submit('btnupdate','Update', 'class="button update-button"') ;
			echo form_close();
		}
		
	?>


</div>