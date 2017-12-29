<div id="container">
	<?php
		echo "<div class='subtitle'>DELETE BARANG</div>";
		echo "<form method='post' action='" . base_url("admin/do_delete_item") . "' class='form-delete'>";
		echo form_dropdown("item_id", $cbId, $cbIdSelected, "id='cbId' style='margin-left: 5px;'");
		echo form_submit("btndelete","Delete", "class='button delete-button'");
		echo form_close();
	?>

</div>