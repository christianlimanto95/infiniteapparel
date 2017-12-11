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
	<link rel="stylesheet" href="<?php echo base_url("assets/css/common/default.css?v=2"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/" . $page_name . ".css?v=2"); ?>" />
	
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
			<div class="bags-ctr">0</div>
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
				<div class="modal-bags-header-left">Cart <span class="modal-bags-header-normal">(0 items)</span></div>
				<div class="modal-bags-header-right"><span class="modal-bags-header-normal">Total : </span><span class="modal-bags-total">IDR 0</span></div>
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
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<div class="modal-btn modal-btn-checkout">Checkout</div>
		</div>
	</div>
</div>
<div class="modal modal-size-qty">
	<div class="modal-box">
		<div class="modal-header">
			<div class="modal-close-button" style="background-image: url(<?php echo base_url("assets/icons/close.png"); ?>);"></div>
			<div class="modal-header-text">Size and Quantity</div>
		</div>
		<div class="modal-body">
			<div class="form-item-inline">
				<div class="form-label">Size</div>
				<select class="form-input form-input-size" data-auto-clear="false">
					<option value="xxl">XXL</option>
					<option value="xl">XL</option>
					<option value="l">L</option>
					<option value="m">M</option>
					<option value="s">S</option>
					<option value="xs">XS</option>
				</select>
			</div>
			<div class="form-item-inline">
				<div class="form-label">Qty</div>
				<input type="number" class="form-input form-input-qty" data-auto-clear="false" min="1" max="999" value="1" />
			</div>
		</div>
		<div class="modal-footer">
			<div class="modal-btn modal-btn-confirm-size-qty">Confirm</div>
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
var add_to_cart_cookie_url = "<?php echo base_url("add-to-cart-cookie"); ?>";
var get_cart_url = "<?php echo base_url("get-cart"); ?>";
var remove_from_cart_url = "<?php echo base_url("remove-from-cart"); ?>";
var cart_change_qty_url = "<?php echo base_url("cart-change-qty"); ?>";
var product_url = "<?php echo base_url("assets/images/catalog"); ?>";
var bags_add_item_url = "<?php echo base_url("assets/icons/add_cart.svg"); ?>";
var bags_remove_item_url = "<?php echo base_url("assets/icons/remove_cart.svg"); ?>";
</script>
<div class="container" tabindex="1">