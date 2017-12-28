<div id="container">
	<?php
	
		echo "<div class='insert-subtitle'>INSERT KATEGORI</div>";
		
		echo form_open(base_url("admin/insert_category"));
		echo "Nama Kategori" .form_input('category_name', "", 'class="insert-series-input"');
		echo form_submit('btninsertseries', 'Insert', 'class="button insert-button"') ;
		echo form_close();
		
		echo "<div class='insert-subtitle'>INSERT BARANG</div>";
		
		echo "<form class='form-insert-item' method='post' action='" . base_url("admin/insert_item") . "' enctype='multipart/form-data'>";
		echo "<div class='insert-label'>Nama</div>" .form_input('txtnama', "");
		echo "<div class='insert-label'>Kategori</div>" .form_dropdown('cbSeries', $allseries, $cbSeries, 'class="cbseries"');
		
		echo "<div class='insert-label'>Harga</div>";
		
		echo "<label for='rharga-1'>";
			$data = array(
				'name'		=> 'rharga',
				'id'		=> 'rharga-1',
				'value'		=> '125000',
				'checked'	=> TRUE
				);
			echo form_radio($data) . "IDR " . number_format(125000, 0, ",", ".");
		echo "</label>";
		
		echo "<label for='rharga-2'>";
			$data = array(
				'name'		=> 'rharga',
				'id'		=> 'rharga-2',
				'value'		=> '140000',
				'checked'	=> FALSE
				);
			echo form_radio($data) . "IDR " . number_format(140000, 0, ",", ".");
		echo "</label>";

		echo "<label for='rharga-3'>";
			$data = array(
				'name'		=> 'rharga',
				'id'		=> 'rharga-3',
				'value'		=> '325000',
				'checked'	=> FALSE
				);
			echo form_radio($data) . "IDR " . number_format(325000, 0, ",", ".");
		echo "</label>";
		
		echo "<label for='rharga-4'>";
			$data = array(
				'name'		=> 'rharga',
				'id'		=> 'rharga-4',
				'value'		=> 'other',
				'checked'	=> FALSE
				);
			echo form_radio($data);
			echo "Other " . "<input type='number' class='txtharga' name='txtharga' />";
			echo "<div class='insert-label'>Keterangan</div>" . form_textarea("txtketerangan", $keterangan);
		echo "</label>";
		echo "<input type='hidden' name='image_count' value='1' />";
		echo "<div class='input-image-container'>";
		echo "<input type='file' name='image_1' data-ctr='1' class='input-image' />";
		echo "<img class='preview' />";
		echo "</div>";
		echo "<button type='button' class='btn-remove-image'>Hapus gambar</button>";
		echo "<button type='button' class='btn-add-image'>Tambah gambar</button>";
		
		echo form_submit('btninsert','Insert', 'class="button insert-button"') ;
		echo form_close();
		echo  $msg;
		
	?>
</div>