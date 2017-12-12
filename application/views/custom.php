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
                    <div class="color-container shirts-color-container">
                        <?php
                            for ($i = 0; $i < sizeof($shirts); $i++) {
                                $selected = ($i == 0) ? " selected" : "";
                                echo "<div class='color" . $selected . "' style='background-color: #" . $shirts[$i]->custom_color_hex . ";' data-id='" . $shirts[$i]->custom_id . "' ></div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="form-item">
                <div class="form-label">Design: <select class="select-type"><?php 
                for ($i = 0; $i < sizeof($types); $i++) {
                    echo "<option value='" . $types[$i]->custom_type_id . "'>" . $types[$i]->custom_type_name . "</option>";
                }
                ?></select></div>
                    <div class="color-container designs-color-container">
                    <?php
                        for ($i = 0; $i < sizeof($designs); $i++) {
                            if ($designs[$i]->custom_type_id == $types[0]->custom_type_id) {
                                echo "<div class='color' style='background-color: #" . $designs[$i]->custom_color_hex . ";' data-id='" . $designs[$i]->custom_id . "' ></div>";
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var shirts = [<?php
for ($i = 0; $i < sizeof($shirts); $i++) {
    if ($i > 0) {
        echo ", ";
    }
    echo "{custom_id: " . $shirts[$i]->custom_id . ", custom_type_id: " . $shirts[$i]->custom_type_id . ", custom_color_hex: '" . $shirts[$i]->custom_color_hex . "'}";
}    
?>
];
var designs = [<?php
for ($i = 0; $i < sizeof($designs); $i++) {
    if ($i > 0) {
        echo ", ";
    }
    echo "{custom_id: " . $designs[$i]->custom_id . ", custom_type_id: " . $designs[$i]->custom_type_id . ", custom_color_hex: '" . $designs[$i]->custom_color_hex . "'}";
}    
?>
];
</script>