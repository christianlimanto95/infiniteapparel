<html>
<head>
	<title><?php echo $title; ?></title>	
	<link rel="stylesheet" href="<?php echo base_url("assets/css/admin_login.css"); ?>" />	
</head>
<body>
    <div class="content">
        <div class="center">
            <form class="form" method="post" action="<?php echo base_url("admin/do_admin_login"); ?>">
                <div class="error"><?php echo $this->session->flashdata("error_message"); ?></div>
                <div class="form-item">
                    <div class="form-label">Username</div>
                    <input type="text" name="username" class="username" maxlength="50" autofocus="autofocus" />
                </div>
                <div class="form-item">
                    <div class="form-label">Password</div>
                    <input type="password" name="password" class="password" maxlength="50" />
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
<script src="<?php echo base_url("assets/js/common/jquery_velocity.js"); ?>" defer></script>
<script src="<?php echo base_url("assets/js/admin_login.js"); ?>" defer></script>
</body>
</html>