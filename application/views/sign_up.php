<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">SIGN UP</div>
            <div class="section-title-line"></div>
        </div>
        <?php if($this->session->flashdata("message") != null) {
            echo "<div class='flash-message'>" . $this->session->flashdata("message") . "</div>";
        } ?>
        <form method="post" action="<?php echo base_url("sign_up/do_sign_up"); ?>" class="center">
            <div class="form-item">
                <div class="form-label">Name <span class="error error-user_first_name"></span></div>
                <input type="text" name="user_first_name" class="form-input" placeholder="First Name" value="<?php echo $input["user_first_name"]; ?>" maxlength="50" />
                <input type="text" name="user_last_name" class="form-input" placeholder="Last Name" value="<?php echo $input["user_last_name"]; ?>" maxlength="50" />
            </div>
            <div class="form-item form-item-email">
                <div class="form-label">Email <span class="error error-user_email"><?php echo $error["user_email"]; ?></span></div>
                <input type="email" name="user_email" class="form-input" maxlength="50" value="<?php echo $input["user_email"]; ?>" />
            </div>
            <div class="form-item form-item-password">
                <div class="form-label">Password <span class="error error-user_password"></span></div>
                <input type="password" name="user_password" class="form-input" maxlength="40" value="<?php echo $input["user_password"]; ?>" />
            </div>
            <div class="form-item form-item-confirm-password">
                <div class="form-label">Confirm Password <span class="error error-user_confirm_password"></span></div>
                <input type="password" name="user_confirm_password" class="form-input" maxlength="40" value="<?php echo $input["user_confirm_password"]; ?>" />
            </div>
            <button type="submit" class="btn-sign-up">SIGN UP</button>
        </form>
    </div>
</div>