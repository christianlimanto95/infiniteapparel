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
                    <div class="design-image" style="background-image: url(<?php echo base_url("assets/images/custom/8.png"); ?>);"></div>
                </div>
            </div>
            <div class="section-1-right">
                <div class="form-item custom-form-item">
                    <div class="form-label custom-form-label">T-Shirt Color</div>
                    <div class="color-container shirts-color-container">
                        <?php
                            for ($i = 0; $i < sizeof($shirts); $i++) {
                                $selected = ($i == 0) ? " selected" : "";
                                echo "<div class='color" . $selected . "' style='background-color: #" . $shirts[$i]->custom_color_hex . ";' data-id='" . $shirts[$i]->custom_id . "' ></div>";
                            }
                        ?>
                    </div>
                </div>
                <div class="form-item custom-form-item">
                    <div class="form-label custom-form-label">Design: <select class="select-type"><?php 
                    for ($i = 0; $i < sizeof($types); $i++) {
                        echo "<option value='" . $types[$i]->custom_type_id . "'>" . $types[$i]->custom_type_name . "</option>";
                    }
                    ?></select></div>
                    <div class="color-container designs-color-container">
                    <?php
                        $firstFound = false;
                        for ($i = 0; $i < sizeof($designs); $i++) {
                            if ($designs[$i]->custom_type_id == $types[0]->custom_type_id) {
                                $selected = "";
                                if (!$firstFound) {
                                    $firstFound = true;
                                    $selected = " selected";
                                }
                                echo "<div class='color" . $selected . "' style='background-color: #" . $designs[$i]->custom_color_hex . ";' data-id='" . $designs[$i]->custom_id . "' ></div>";
                            }
                        }
                    ?>
                    </div>
                </div>
                <div class="form-item-inline custom-form-item custom-form-item-size">
                    <div class="form-label custom-form-label">Size</div>
                    <select class="custom-select-size">
                        <option value="xxl">XXL</option>
                        <option value="xl">XL</option>
                        <option value="l">L</option>
                        <option value="m">M</option>
                        <option value="s">S</option>
                        <option value="xs">XS</option>
                    </select>
                </div>
                <div class="form-item-inline custom-form-item">
                    <div class="form-label custom-form-label">Qty</div>
                    <input type="number" class="custom-input-qty" value="1" min="1" max="999" />
                </div>
                <div class="form-item custom-form-item">
                    <div class="form-label custom-form-label">Add Extra Notes</div>
                    <textarea class="custom-input-notes" rows="3"></textarea>
                </div>
                <div class="custom-price">IDR <?php echo number_format($types[0]->custom_type_price, 0, ",", "."); ?></div>
                <div class="custom-btn-container">
                    <div class="custom-btn btn-buy-now">BUY NOW</div>
                    <div class="custom-btn btn-add-to-bag">ADD TO CART</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var types = [<?php
    for ($i = 0; $i < sizeof($types); $i++) {
        if ($i > 0) {
            echo ", ";
        }
        echo "{custom_type_id: " . $types[$i]->custom_type_id . ", custom_type_price: " . $types[$i]->custom_type_price . "}";
    }
?>];

var shirts = [<?php
for ($i = 0; $i < sizeof($shirts); $i++) {
    if ($i > 0) {
        echo ", ";
    }
    echo "{custom_id: " . $shirts[$i]->custom_id . ", custom_type_id: " . $shirts[$i]->custom_type_id . ", custom_color_hex: '" . $shirts[$i]->custom_color_hex . "', image: '" . base_url("assets/images/custom/" . $shirts[$i]->custom_id . ".png") . "'}";
}    
?>];
var designs = [<?php
for ($i = 0; $i < sizeof($designs); $i++) {
    if ($i > 0) {
        echo ", ";
    }
    echo "{custom_id: " . $designs[$i]->custom_id . ", custom_type_id: " . $designs[$i]->custom_type_id . ", custom_color_hex: '" . $designs[$i]->custom_color_hex . "', image: '" . base_url("assets/images/custom/" . $designs[$i]->custom_id . ".png") . "'}";
}    
?>];
</script>