<div id="container">
	<?php
	
		echo "<div class='subtitle'>UPDATE BARANG</div>";
		
		echo form_open("project/updating", array("id" => "formIdBarang"));	
		echo form_dropdown("cbId", $cbId, $cbIdSelected, "id='cbId' style='margin-left: 5px;'");
		echo form_close();
		
		if ($cbIdSelected != "null")
		{
			echo form_open_multipart("project/updating");
			echo form_hidden("hidden_id", $cbIdSelected);
			echo form_hidden("jumlah_pic", $jumlah_gambar);
			echo "<div class='update-label'>Nama</div>" . form_input('namaupdate', $namaupdate, "class='input-nama'");
			echo "<div class='update-label'>Series</div>" . form_dropdown('cbSeries', $allseries, $cbSeries, "class='cbseries'");
			
			echo "<div class='update-label'>Harga</div>";
			echo "<label for='urharga-1'>";
				$data = array(
					'name'        => 'urharga',
					'id'		=> 'urharga-1',
					'value'       => '100000',
					'checked'     => TRUE
					);

				echo form_radio($data) . number_format(100000, 0, ",", ".") . " IDR";
			echo "</label>";
			
			echo "<label for='urharga-2'>";
				$data = array(
					'name'        => 'urharga',
					'id'		=> 'urharga-2',
					'value'       => '125000',
					'checked'     => TRUE
					);

				echo form_radio($data) . number_format(125000, 0, ",", ".") . " IDR";
			echo "</label>";
			
			echo "<label for='urharga-3'>";
				$data = array(
					'name'        => 'urharga',
					'id'		=> 'urharga-3',
					'value'       => 'other',
					'checked'     => TRUE
					);
				echo form_radio($data);
				echo "Other " . "<input type='tel' name='hargaupdate' value='" . $hargaupdate . "'>";
			echo "</label>";
			echo "Keterangan <br>" . form_textarea("keteranganupdate", $keteranganupdate)."<br>";
			echo "<br>";
			for($i=1;$i<=$jumlah_gambar;$i++)
			{
				echo "<div style='float: left;'><img src='" . "http://localhost/infiniteapparel/assets/images/products" . "/" . $cbIdSelected. "_".$i.".jpg '>";
				echo "<div>";
			}
			/*for($i=($jumlah_gambar+1);$i<=4;$i++)
			{
				echo "<br><b>Tambahkan Gambar</b> " . form_upload("'foto".$i."'");
				echo "          <div>";
			}*/
			echo "Image " . form_upload('foto1');
			echo "Image " . form_upload('foto2');
			echo "Image " . form_upload('foto3');
			echo "Image " . form_upload('foto4');
			echo "<br><br>";
			echo form_submit('btnupdate','Update', 'class="button update-button"') ;
			echo form_close();
		}
		
	?>


</div>