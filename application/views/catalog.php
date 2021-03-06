<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">PRODUCT</div>
            <div class="section-title-line"></div>
        </div>
        <div class="product-container">
        <?php for ($i = 0; $i < sizeof($catalog); $i++) { ?>
            <a href="<?php echo base_url("product/" . $catalog[$i]->item_id . "/" . rawurlencode($catalog[$i]->item_name)); ?>" class="product">
                <div class="product-image-container">
                    <div class="product-image" style="background-image: url(<?php echo base_url("assets/images/catalog/" . $catalog[$i]->item_id . "_1.png?d=" . strtotime($catalog[$i]->modified_date)); ?>);"></div>
                    <div class="product-image-wrapper">
                        <div class="btn-wrapper">
                            <div class="btn btn-buy-now" data-category-id="<?php echo $catalog[$i]->category_id; ?>" data-id="<?php echo $catalog[$i]->item_id ?>">BUY NOW</div>
                            <div class="btn btn-add-to-bag" data-category-id="<?php echo $catalog[$i]->category_id; ?>" data-id="<?php echo $catalog[$i]->item_id ?>">ADD TO CART</div>
                        </div>
                    </div>
                </div>
                <div class="product-name"><?php echo $catalog[$i]->item_name; ?></div>
                <div class="product-price">IDR <?php echo number_format($catalog[$i]->item_price, 0, ",", "."); ?></div>
            </a>
        <?php } ?>
        </div>
        <div class="paging-container">
            <div class="paging">
                <?php
                    if ($page == 1) {
                        echo "<a class='page page-prev disabled'>Prev</a>";
                    } else {
                        echo "<a href='" . base_url("catalog?page=" . ($page - 1)) . "' class='page page-prev'>Prev</a>";
                    }

                    $page_count = $count / 16;
                    $int  = intval($page_count);
                    if ($page_count > $int) {
                        $page_count = $int + 1;
                    }
                    
                    for ($i = 1; $i <= $page_count; $i++) {
                        $active = ($i == $page) ? " active" : "";
                        echo "<a href='" . base_url("catalog?page=" . $i) . "' class='page" . $active . "'>" . $i . "</a>";
                    }
                    
                    if ($page == $page_count) {
                        echo "<a class='page page-next disabled'>Next</a>";
                    } else {
                        echo "<a href='" . base_url("catalog?page=" . ($page + 1)) . "' class='page page-next'>Next</a>";
                    }
                    
                ?>
            </div>
        </div>
    </div>
</div>