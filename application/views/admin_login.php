<div class="content">
    <div class="center">
        <form class="form" method="post" action="<?php echo base_url("login/do_login"); ?>">
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