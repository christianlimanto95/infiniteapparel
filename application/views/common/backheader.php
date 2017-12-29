<html>
<head>
	<title><?php echo $title; ?></title>
	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/common/default_admin.css?v=2"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css')?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap-datepicker.css')?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/" . $page_name . ".css?v=2"); ?>" />
	<style>

	</style>
</head>
<body>
<a id="main-logo" href="<?php echo base_url("admin"); ?>" style='background-image: url("<?php echo base_url("assets/icons/logo_invers.png"); ?>");'></a>
<?php
	echo "<select id='navigation' onChange='window.location.href=this.value'>";
		echo "<option value='" . base_url('admin') . "' data-id='1'>Home</option>";
		echo "<option value='" . base_url('admin/inserting') . "' data-id='2'>Insert</option>";
		echo "<option value='" . base_url('admin/updating') . "' data-id='3'>Update</option>";
		echo "<option value='" . base_url('admin/deleting') . "' data-id='4'>Delete</option>";
		echo "<option value='" . base_url('admin/confirmpayment') . "' data-id='5'>Confirm Payment</option>";
		echo "<option value='" . base_url('admin/order_list') . "' data-id='6'>Order List</option>";
		echo "<option value='" . base_url('admin/laporanpenjualan') . "' data-id='7'>Laporan Penjualan</option>";
		echo "<option value='" . base_url('admin/laporanstatistik') . "' data-id='8'>Laporan Statistik</option>";
		echo "<option value='" . base_url('admin/user') . "' data-id='10'>View Users</option>";
		echo "<option value='" . base_url('admin/change_password') . "' data-id='11'>Change Password</option>";
	echo "</select>";
?>

<?php
if ($this->session->flashdata("admin_message")) {
	echo "<div class='admin_message'>" . $this->session->flashdata("admin_message") . "</div>";
} 

if ($this->session->flashdata("admin_message_error")) {
	echo "<div class='admin_message_error'>" . $this->session->flashdata("admin_message_error") . "</div>";
}
?>