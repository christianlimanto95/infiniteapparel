<?php
	echo "<script>$(\"#navigation option[value='" . base_url("admin/inserting") . "']\").attr(\"selected\", true);</script>";
?>
<div id="container">
	<?php
	
		echo "<div class='insert-subtitle'>INSERT SERIES</div>";
		
		echo form_open('project/inserting');
		echo validation_errors(); 
		echo "Nama Series" .form_input('txtnama', $nama, 'class="insert-series-input"');
		echo form_submit('btninsertseries', 'Insert', 'class="button insert-button"') ;
		echo form_close();
		
		echo "<div class='insert-subtitle'>INSERT BARANG</div>";
		
		echo form_open_multipart('project/inserting');
		echo form_error();
		echo "<div class='insert-label'>Nama</div>" .form_input('txtnama',$nama);
		echo "<div class='insert-label'>Series</div>" .form_dropdown('cbSeries', $allseries, $cbSeries, 'class="cbseries"');
		
		echo "<div class='insert-label'>Harga</div>";
		
		echo "<label for='rharga-1'>";
			$data = array(
				'name'		=> 'rharga',
				'id'		=> 'rharga-1',
				'value'		=> '100000',
				'checked'	=> TRUE
				);
			echo form_radio($data) . number_format(100000, 0, ",", ".") . " IDR";
		echo "</label>";
		
		echo "<label for='rharga-2'>";
			$data = array(
				'name'		=> 'rharga',
				'id'		=> 'rharga-2',
				'value'		=> '125000',
				'checked'	=> TRUE
				);
			echo form_radio($data) . number_format(125000, 0, ",", ".") . " IDR";
		echo "</label>";
		
		echo "<label for='rharga-3'>";
			$data = array(
				'name'		=> 'rharga',
				'id'		=> 'rharga-3',
				'value'		=> 'other',
				'checked'	=> TRUE
				);
			echo form_radio($data);
			echo "Other " . "<input type='tel' name='txtharga' value='" . $harga . "'>";
			echo "<div class='insert-label'>Keterangan</div>" . form_textarea("txtketerangan", $keterangan);
		echo "</label>";
		
		echo "Image 1" . form_upload('foto1');
		echo "Image 2" . form_upload('foto2');
		echo "Image 3" . form_upload('foto3');
		echo "Image 4" . form_upload('foto4');
		echo form_submit('btninsert','Insert', 'class="button insert-button"') ;
		echo form_close();
		echo  $msg;
		
	?>
</div>