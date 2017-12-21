<html>
<head>
	<title><?php echo $title; ?></title>
	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/common/default_admin.css?v=1"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/" . $page_name . ".css?v=1"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css')?>" />
	<style>

	</style>
</head>
<body>
<a id="main-logo" href="<?php echo base_url("admin"); ?>" style='background-image: url("<?php echo base_url("assets/icons/logo_invers.png"); ?>");'></a>
<?php
	echo "<select id='navigation' onChange='window.location.href=this.value'>";
		echo "<option value='" . base_url('project/adminpanel') . "' data-id='1'>Home</option>";
		echo "<option value='" . base_url('project/inserting') . "' data-id='2'>Insert</option>";
		echo "<option value='" . base_url('project/updating') . "' data-id='3'>Update</option>";
		echo "<option value='" . base_url('project/deleting') . "' data-id='4'>Delete</option>";
		echo "<option value='" . base_url('project/confirmpayment') . "' data-id='5'>Confirm Payment</option>";
		echo "<option value='" . base_url('project/order_list') . "' data-id='6'>Order List</option>";
		echo "<option value='" . base_url('project/laporanpenjualan') . "' data-id='7'>Laporan Penjualan</option>";
		echo "<option value='" . base_url('project/laporanstatistik') . "' data-id='8'>Laporan Statistik</option>";
		echo "<option value='" . base_url('project/blogpost') . "' data-id='9'>Blogpost</option>";
		echo "<option value='" . base_url('project/user') . "' data-id='10'>View Users</option>";
	echo "</select>";
?>