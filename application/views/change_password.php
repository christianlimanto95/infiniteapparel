<div id="container">
	<form method="post" action="<?php echo base_url("admin/do_change_password"); ?>" class="form-change-password">
		<div class="form-label">Password lama</div>
		<input type="password" name="current_password" class="input-password" />
		<div class="form-label">Password baru</div>
		<input type="password" name="new_password" class="input-password" />
		<div class="form-label">Confirm Password baru</div>
		<input type="password" name="confirm_new_password" class="input-password" />
		<button type="submit" class="btn-change-password">Change Password</button>
	</form>
</div>