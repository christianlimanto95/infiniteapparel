<html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110331342-3"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-110331342-3');
	</script>

	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
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
	<link rel="stylesheet" href="<?php echo base_url("assets/css/common/default.css?v=6"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/" . $page_name . ".css?v=7"); ?>" />	
</head>
<body>
<div class="loader-container">
	<div class="loader"></div>
</div>
<div class="header<?php echo $header_additional_class; ?>">
	<div class="header-inner">
		<a href="<?php echo base_url(); ?>" class="logo" >
			<div class="logo-inner-container">
				<div class="logo-image logo-image-white" style="background-image: url(<?php echo base_url("assets/icons/logo.png"); ?>);"></div>
				<div class="logo-image logo-image-black" style="background-image: url(<?php echo base_url("assets/icons/logo_invers.png"); ?>);"></div>
			</div>
		</a>
		<div class="header-menu-title" data-is-mobile="true">DIRECTORY</div>
		<div class="header-menu-container">
			<a href="<?php echo base_url(); ?>" class="header-menu">HOME</a>
			<a href="<?php echo base_url("product"); ?>" class="header-menu">PRODUCT</a>
			<a href="<?php echo base_url("custom"); ?>" class="header-menu">CUSTOM</a>
		</div>
		<div class="header-menu-title" data-is-mobile="true">PROFILE</div>
	</div>
	<?php if ($do_get_cart == "true") { ?>
		<div class="bags-container">
			<div class="bags-container-inner">
				<div class="bags-image bags-image-white" style="background-image: url(<?php echo base_url("assets/icons/bag.png?v=1"); ?>);"></div>
				<div class="bags-image bags-image-black" style="background-image: url(<?php echo base_url("assets/icons/bag_invers.png?v=1"); ?>);"></div>
				<div class="bags-ctr">0</div>
			</div>
		</div>
	<?php } ?>
	<?php if (!$is_logged_in) { ?>
		<div class="header-login-or-signup">
			<span class="header-btn-login">Login</span> or <a href="<?php echo base_url("sign-up"); ?>">Sign Up Yours</a>
		</div>
	<?php } else { ?>
		<div class="header-profile">
			<div class="header-profile-inner">
				<div class="header-profile-image header-profile-image-white" style="background-image: url(<?php echo base_url("assets/icons/account.png"); ?>);"></div>
				<div class="header-profile-image header-profile-image-black" style="background-image: url(<?php echo base_url("assets/icons/account_invert.png"); ?>);"></div>
				<div class="header-profile-menu header-profile-menu-1"><?php echo $user_first_name; ?></div>
				<a href="<?php echo base_url("order-list"); ?>" class="header-profile-menu header-profile-menu-2">Order List</a>
				<a href="<?php echo base_url("account-settings"); ?>" class="header-profile-menu header-profile-menu-3">Account Settings</a>
				<div class="header-profile-menu header-profile-menu-4 header-btn-logout">Logout</div>
			</div>
		</div>
	<?php } ?>
</div>
<div class="menu-icon" id="menu-icon">
	<div class="menu-icon-line menu-icon-line-1"></div>
	<div class="menu-icon-line menu-icon-line-2"></div>
	<div class="menu-icon-line menu-icon-line-3"></div>
</div>
<?php if ($do_get_cart == "true") { ?>
	<div class="bags-container" data-is-mobile="true">
		<div class="bags-container-inner">
			<div class="bags-image bags-image-white" style="background-image: url(<?php echo base_url("assets/icons/bag.png?v=1"); ?>);"></div>
			<div class="bags-image bags-image-black" style="background-image: url(<?php echo base_url("assets/icons/bag_invers.png?v=1"); ?>);"></div>
			<div class="bags-ctr">0</div>
		</div>
	</div>
<?php } ?>
<div class="bags-message">Added to cart</div>
<div class="bags-preview">
	<div class="bags-preview-center">
		<div class="bags-preview-image-container">
			<div class="bags-preview-image"></div>
			<div class="bags-preview-image-design"></div>
			<div class="bags-preview-image-wrapper"></div>
		</div>
	</div>
</div>
<?php if ($do_get_cart == "true") { ?>
	<div class="modal modal-login">
		<div class="modal-box">
			<div class="modal-header">
				<div class="modal-close-button" style="background-image: url(<?php echo base_url("assets/icons/close.png"); ?>);"></div>
				<div class="modal-header-text">Login</div>
			</div>
			<div class="modal-body">
				<div class="form-item form-item-email">
					<div class="form-label">Email <span class="error error-modal-input-email"></span></div>
					<input type="email" class="form-input modal-input-email" />
				</div>
				<div class="form-item">
					<div class="form-label">Password <span class="error error-modal-input-password"></span></div>
					<input type="password" class="form-input modal-input-password" />
				</div>
			</div>
			<div class="modal-footer">
				<div class="login-register-button">Don't have an account? <a href="<?php echo base_url("sign-up"); ?>">Sign up here</a></div>
				<div class="modal-btn modal-btn-login">Login</div>
			</div>
		</div>
	</div>
<?php } ?>
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
						<td data-col="name">Item</td>
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
			<div class="modal-btn modal-btn-checkout disabled">Checkout</div>
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
					<option value="xl" selected>XL</option>
					<option value="l">L</option>
					<option value="m">M</option>
					<option value="s">S</option>
					<option value="xs">XS</option>
				</select>
			</div>
			<div class="form-item-inline">
				<div class="form-label">Qty</div>
				<input type="number" data-input-type="number" class="form-input form-input-qty" data-auto-clear="false" min="1" max="999" value="1" />
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
var login_url = "<?php echo base_url("do-login"); ?>";
var logout_url = "<?php echo base_url("logout"); ?>";
var add_to_cart_url = "<?php echo base_url("add-to-cart"); ?>";
var get_cart_url = "<?php echo base_url("get-cart"); ?>";
var remove_from_cart_url = "<?php echo base_url("remove-from-cart"); ?>";
var cart_change_qty_url = "<?php echo base_url("cart-change-qty"); ?>";
var cart_change_size_url = "<?php echo base_url("cart-change-size"); ?>";
var product_url = "<?php echo base_url("assets/images/catalog"); ?>";
var product_custom_url = "<?php echo base_url("assets/images/custom"); ?>";
var bags_action_url = "<?php echo base_url("assets/icons/ic_more_vert_black_24px.svg"); ?>";
var bags_add_item_url = "<?php echo base_url("assets/icons/add_cart.svg"); ?>";
var bags_remove_item_url = "<?php echo base_url("assets/icons/remove_cart.svg"); ?>";
var checkout_url = "<?php echo base_url("checkout"); ?>";
var do_get_cart = <?php echo $do_get_cart; ?>;
</script>
<div class="container" tabindex="1">