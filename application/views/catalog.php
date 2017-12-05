<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">CATALOG</div>
            <div class="section-title-line"></div>
        </div>
        <div class="product-container">
        <?php for ($i = 0; $i < sizeof($catalog); $i++) { ?>
            <a href="<?php echo base_url("product/" . $catalog[$i]->item_id . "/" . str_replace(" ", "-", $catalog[$i]->item_name)); ?>" class="product">
                <div class="product-image-container">
                    <div class="product-image" style="background-image: url(<?php echo base_url("assets/images/catalog/" . $catalog[$i]->item_id . "_1.png"); ?>);"></div>
                    <div class="product-image-wrapper">
                        <div class="btn-wrapper">
                            <div class="btn btn-buy-now">BUY NOW</div>
                            <div class="btn btn-add-to-bag">ADD TO BAG</div>
                        </div>
                    </div>
                </div>
                <div class="product-name"><?php echo $catalog[$i]->item_name; ?></div>
                <div class="product-price">IDR <?php echo number_format($catalog[$i]->item_price, 0, ",", "."); ?></div>
            </a>
        <?php } ?>
        </div>
    </div>
</div>