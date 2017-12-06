<html>
<head>
	<title><?php echo $title; ?></title>
	<style>
		@font-face {
			font-family: champagne;
			src: url(<?php echo base_url("assets/fonts/champagne.ttf"); ?>);
		}

		@font-face {
			font-family: moon-bold;
			src: url(<?php echo base_url("assets/fonts/moon-bold.otf"); ?>);
		}

		@font-face {
			font-family: moon-regular;
			src: url(<?php echo base_url("assets/fonts/moon-regular.otf"); ?>);
		}

		@font-face {
			font-family: pier-bold;
			src: url(<?php echo base_url("assets/fonts/pier-bold.otf"); ?>);
		}

		@font-face {
			font-family: pier-regular;
			src: url(<?php echo base_url("assets/fonts/pier-regular.otf"); ?>);
		}
	</style>
	<link rel="shortcut icon" href="<?php echo base_url("assets/icons/favicon.png"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/common/default.css?v=1"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/" . $page_name . ".css?v=1"); ?>" />
	
	<?php echo $additional_files; ?>
</head>
<body>
<div class="header<?php echo $header_additional_class; ?>">
	<div class="header-inner">
		<a href="<?php echo base_url(); ?>" class="logo" >
			<div class="logo-inner-container">
				<div class="logo-image logo-image-white" style="background-image: url(<?php echo base_url("assets/icons/logo.png"); ?>);"></div>
				<div class="logo-image logo-image-black" style="background-image: url(<?php echo base_url("assets/icons/logo_invers.png"); ?>);"></div>
			</div>
		</a>
		<div class="header-menu-container">
			<a href="<?php echo base_url(); ?>" class="header-menu">HOME</a>
			<a href="<?php echo base_url("catalog"); ?>" class="header-menu">CATALOG</a>
			<a href="<?php echo base_url("custom"); ?>" class="header-menu">CUSTOM</a>
			<a href="<?php echo base_url("contact"); ?>" class="header-menu">CONTACT</a>
		</div>
	</div>
	<div class="bags-container">
		<div class="bags-container-inner">
			<div class="bags-image bags-image-white" style="background-image: url(<?php echo base_url("assets/icons/bag.png?v=1"); ?>);"></div>
			<div class="bags-image bags-image-black" style="background-image: url(<?php echo base_url("assets/icons/bag_invers.png?v=1"); ?>);"></div>
			<div class="bags-ctr">1</div>
		</div>
	</div>
	<div class="header-login-or-signup">
		<span class="header-btn-login">Login</span> or <a href="<?php echo base_url("sign-up"); ?>">Sign Up Yours</a>
	</div>
</div>
<div class="modal modal-login">
	<div class="modal-box">
		<div class="modal-header">
			<div class="modal-close-button" style="background-image: url(<?php echo base_url("assets/icons/close.png"); ?>);"></div>
			<div class="modal-header-text">Login</div>
		</div>
		<div class="modal-body">
			<div class="form-item form-item-email">
				<div class="form-label">Email</div>
				<input type="email" class="form-input form-input-email" />
			</div>
			<div class="form-item">
				<div class="form-label">Password</div>
				<input type="password" class="form-input" />
			</div>
		</div>
		<div class="modal-footer">
			<div class="modal-btn modal-btn-login">Login</div>
		</div>
	</div>
</div>
<div class="modal modal-bags">
	<div class="modal-box">
		<div class="modal-header">
			<div class="modal-close-button" style="background-image: url(<?php echo base_url("assets/icons/close.png"); ?>);"></div>
			<div class="modal-bags-header">
				<div class="modal-bags-header-left">Bag <span>(0 items)</span></div>
				<div class="modal-bags-header-right"><span>Total : </span>IDR 0</div>
			</div>
		</div>
		<div class="modal-body">
			<table class="modal-bags-table">
				<thead>
					<tr>
						<td data-col="name">Name</td>
						<td data-col="size">Size</td>
						<td data-col="price">Price</td>
						<td data-col="qty">Qty</td>
						<td data-col="subtotal">Subtotal</td>
						<td data-col="action"></td>
					</tr>
				</thead>
				<tbody>
				<?php for ($i = 0; $i < 10; $i++) { ?>
					<tr>
						<td data-col="name">
							<div class="bags-td-name-image" style="background-image: url(<?php echo base_url("assets/images/products/INFT0001_1.jpg"); ?>);"></div>
							<div class="bags-td-name-text">God With Us White</div>
						</td>
						<td data-col="size">
							<select>
								<option value="xxl">XXL</option>
								<option value="xl">XL</option>
								<option value="l">L</option>
								<option value="m">M</option>
								<option value="s">S</option>
								<option value="xs">XS</option>
							</select>
						</td>
						<td data-col="price">IDR 100.000</td>
						<td data-col="qty">
							<input type="number" min="1" max="999" value="2" />
						</td>
						<td data-col="subtotal">IDR 2.000.000</td>
						<td data-col="action"></td>
					</tr>
				<?php } ?>
					
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<div class="modal-btn modal-btn-checkout">Checkout</div>
		</div>
	</div>
</div>
<script>
var isMobile = false, isTablet = false;
var vw = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
var vh = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
if (vw < 1025) {
	isMobile = true;
	if (vw >= 768) {
		isTablet = true;
	}
}

var lastScrollTop = 0;
</script>
<div class="container" tabindex="1">