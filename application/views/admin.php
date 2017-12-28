<div id="container">
	<?php
		echo  "<div class='notification-label'>NOTIFICATION :</div>";
		
		foreach ($jumlah as $row)
		{
			$count = $row->getcount;
		}
		
		echo "<div class='notification-detail'>";
		if($count>0)
		{
			echo anchor(site_url('admin/confirmpayment'), $count. " Pembayaran membutuhkan konfirmasi");
			
		}
		else
		echo "TIDAK ADA NOTIFIKASI";
		echo "</div>";
		
	?>
</div>