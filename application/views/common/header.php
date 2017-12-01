<html>
<head>
	<title><?php echo $title; ?></title>
	<style>
		@font-face {
			font-family: champagne;
			src: url(<?php echo base_url("assets/fonts/champagne.ttf"); ?>);
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
	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/common/default.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/" . $page_name . ".css"); ?>" />
	
	<?php echo $additional_files; ?>
</head>
<body>
<div class="header">
	<div class="header-inner">
		<a href="#" class="logo" >
			<div class="logo-inner-container">
				<div class="logo-image logo-image-white" style="background-image: url(assets/icons/logo.png);"></div>
				<div class="logo-image logo-image-black" style="background-image: url(assets/icons/logo_invers.png);"></div>
			</div>
		</a>
		<div class="header-menu-container">
			<a href="#" class="header-menu">HOME</a>
			<a href="#" class="header-menu">CATALOG</a>
			<a href="#" class="header-menu">CONTACT</a>
		</div>
	</div>
	<div class="bags-container">
		<div class="bags-container-inner">
			<div class="bags-image bags-image-white" style="background-image: url(assets/icons/bag.png);"></div>
			<div class="bags-image bags-image-black" style="background-image: url(assets/icons/bag_invers.png);"></div>
			<div class="bags-ctr">1</div>
		</div>
	</div>
	<div class="header-login-or-signup">
		<span>Login</span> or <span>Sign Up Yours</span>
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