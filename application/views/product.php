<div class="content">
    <div class="section section-1" data-id="<?php echo $product->item_id; ?>">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text"><?php echo $product->category_name; ?></div>
            <div class="section-title-line"></div>
        </div>
        <div class="section-1-inner">
            <div class="section-1-left">
                <div class="product-image" style="background-image: url(<?php echo base_url("assets/images/catalog/" . $product->item_id . "_1.png?d=" . strtotime($product->modified_date)); ?>);"></div>
                <div class="product-image-thumbnail-container">
                    <div class="product-image-thumbnail" style="background-image: url(<?php echo base_url("assets/images/catalog/" . $product->item_id . "_1.png?d=" . strtotime($product->modified_date)); ?>);" data-image-index="1"></div>
                    <?php
                        $image_count = intval($product->item_image_count);
                        for ($i = 1; $i < $image_count; $i++) { ?>
                            <div class="product-image-thumbnail" style="background-image: url(<?php echo base_url("assets/images/catalog/" . $product->item_id . "_" . ($i + 1) . ".jpg?d=" . strtotime($product->modified_date)); ?>);" data-image-index="<?php echo ($i + 1); ?>"></div>
                    <?php
                        } ?>
                </div>
            </div>
            <div class="section-1-right">
                <div class="product-name"><?php echo $product->item_name; ?></div>
                <div class="product-price">IDR <?php echo number_format($product->item_price, 0, ",", "."); ?></div>
                <div class="size-quantity-container">
                    <div class="size-container">
                        <div class="label">Size</div>
                        <select class="select-size">
                            <option value="xxl">XXL</option>
                            <option value="xl">XL</option>
                            <option value="l">L</option>
                            <option value="m">M</option>
                            <option value="s">S</option>
                            <option value="xs">XS</option>
                        </select>
                    </div>
                    <div class="quantity-container">
                        <div class="label">Quantity</div>
                        <input class="input-qty" type="number" min="1" max="999" value="1" />
                    </div>
                </div>
                <div class="section-1-right-btn-container">
                    <div class="section-1-right-btn btn-buy-now">BUY NOW</div>
                    <div class="section-1-right-btn btn-add-to-bag">ADD TO CART</div>
                </div>
            </div>
        </div>
    </div>
</div>