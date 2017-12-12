<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">CUSTOM</div>
            <div class="section-title-line"></div>
        </div>
        <div class="section-1-inner">
            <div class="section-1-left">
                <div class="image-container">
                    <div class="shirt-image" style="background-image: url(<?php echo base_url("assets/images/custom/1.png"); ?>);"></div>
                    <div class="design-image" style="background-image: url(<?php echo base_url("assets/images/custom/9.png"); ?>);"></div>
                </div>
            </div>
            <div class="section-1-right">
                <div class="form-item">
                    <div class="form-label">T-Shirt Color</div>
                    <div class="color-container">
                        <?php
                            /*for ($i = 0; $i < sizeof($shirts); $i++) {
                                echo "<div class='color' style='background-color: #" . $shirts[$i]->custom_color_hex . ";'></div>";
                            }*/
                        ?>
                    </div>
                </div>
                <div class="form-item">
                <div class="form-label">Design: <select></select></div>
                    <div class="color-container">
                        <div class="color" style="background-color: #000000;"></div>
                        <div class="color" style="background-color: #000000;"></div>
                        <div class="color" style="background-color: #000000;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>