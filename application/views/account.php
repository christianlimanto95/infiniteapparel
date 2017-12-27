<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">ACCOUNT SETTINGS</div>
            <div class="section-title-line"></div>
        </div>
        <div class="section-1-inner">
            <?php if ($this->session->flashdata("message") != null) {
                echo "<div class='flash-message'>" . $this->session->flashdata("message") . "</div>";
            } else if ($this->session->flashdata("error_message") != null) {
                echo "<div class='flash-message custom-error'>" . $this->session->flashdata("error_message") . "</div>";
            } ?>
            <div class="form-item custom-form-item">
                <div class="form-label">Email</div>
                <div class="form-input custom-form-input show"><?php echo $data->user_email; ?></div>
            </div>
            <div class="form-item custom-form-item">
                <div class="form-label">Name<span class="error error-name"></span></div>
                <div class="form-input custom-form-input show"><?php echo $data->user_first_name . " " . $data->user_last_name; ?><div class="btn-edit">Change Name</div></div>
                <form class="form-edit" data-form-edit="name" method="post" action="<?php echo base_url("account/change_name"); ?>">
                    <input type="text" name="user_first_name" class="form-input form-input-first-name" value="<?php echo $data->user_first_name; ?>" maxlength="50" />
                    <input type="text" name="user_last_name" class="form-input form-input-last-name" value="<?php echo $data->user_last_name; ?>" maxlength="50" />
                    <button class="btn-save">Save</button>
                    <div class="btn-cancel">Cancel</div>
                </form>
            </div>
            <div class="form-item custom-form-item">
                <div class="form-label">City</div>
                <div class="form-input custom-form-input show"><?php
                    echo $data->city_name;
                    if ($data->city_name == "") {
                        echo "<div class='btn-edit'>Add City</div>";
                    } else {
                        echo "<div class='btn-edit'>Change City</div>";
                    }
                ?></div>
                <form class="form-edit" data-form-edit="city" method="post" action="<?php echo base_url("account/change_city"); ?>">
                    <select class="form-input" name="city_id"><?php
                        $iLength = sizeof($city);
                        $element = "";
                        for ($i = 0; $i < $iLength; $i++) {
                            $selected = "";
                            if ($city[$i]->city_name == $data->city_name) {
                                $selected = " selected";
                            }
                            $element .= "<option value='" . $city[$i]->city_id . "'" . $selected . ">" . $city[$i]->city_name . "</option>";
                        }
                        echo $element;
                    ?></select>
                    <button class="btn-save">Save</button>
                    <div class="btn-cancel">Cancel</div>
                </form>
            </div>
            <div class="form-item custom-form-item form-item-address">
                <div class="form-label">Address<span class="error error-address"></span></div>
                <div class="form-input custom-form-input show"><?php
                    echo $data->user_address;
                    if ($data->user_address == "") {
                        echo "<div class='btn-edit'>Add Address</div>";
                    } else {
                        echo "<div class='btn-edit'>Change Address</div>";
                    }
                ?></div>
                <form class="form-edit" data-form-edit="address" method="post" action="<?php echo base_url("account/change_address"); ?>">
                    <textarea type="text" name="user_address" class="form-input"><?php echo $data->user_address; ?></textarea>
                    <button class="btn-save">Save</button>
                    <div class="btn-cancel">Cancel</div>
                </form>
            </div>
            <div class="form-item custom-form-item">
                <div class="form-label">Phone Number<span class="error error-phone"></span></div>
                <div class="form-input custom-form-input show"><?php
                    echo $data->user_handphone;
                    if ($data->user_handphone == "") {
                        echo "<div class='btn-edit'>Add Phone Number</div>";
                    } else {
                        echo "<div class='btn-edit'>Change Phone Number</div>";
                    }
                ?></div>
                <form class="form-edit" data-form-edit="handphone" method="post" action="<?php echo base_url("account/change_phone"); ?>">
                    <input type="number" name="user_handphone" class="form-input form-input-phone" value="<?php echo $data->user_handphone; ?>" />
                    <button class="btn-save">Save</button>
                    <div class="btn-cancel">Cancel</div>
                </form>
            </div>
            <div class="form-item custom-form-item">
                <div class="form-label">Password</div>
                <div class="form-input custom-form-input show">*****<div class="btn-edit">Change Password</div></div>
                <form class="form-edit" data-form-edit="password" method="post" action="<?php echo base_url("account/change_password"); ?>">
                    <div class="form-item">
                        <div class="form-label">Current Password<span class="error error-current-password"></span></div>
                        <input type="password" name="current_password" class="form-input form-input-current-password" value="" maxlength="40" />
                    </div>
                    <div class="form-item">
                        <div class="form-label">New Password<span class="error error-new-password"></span></div>
                        <input type="password" name="new_password" class="form-input form-input-new-password" value="" maxlength="40" />
                    </div>
                    <div class="form-item">
                        <div class="form-label">Confirm New Password<span class="error error-confirm-new-password"></span></div>
                        <input type="password" class="form-input form-input-confirm-password" value="" maxlength="40" />
                    </div>
                    <button class="btn-save">Save</button>
                    <div class="btn-cancel">Cancel</div>
                </form>
            </div>
        </div>
    </div>
</div>