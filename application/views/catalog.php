<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">CATALOG</div>
            <div class="section-title-line"></div>
        </div>
        <div class="product-container">
        <?php for ($i = 0; $i < 10; $i++) { ?>
            <a href="<?php echo base_url("product/1/180-degree"); ?>" class="product">
                <div class="product-image-container">
                    <div class="product-image" style="background-image: url(assets/images/available-now/1.jpg);"></div>
                    <div class="product-image-wrapper">
                        <div class="btn-wrapper">
                            <div class="btn btn-buy-now">BUY NOW</div>
                            <div class="btn btn-add-to-bag">ADD TO BAG</div>
                        </div>
                    </div>
                </div>
                <div class="product-name">180 Degree</div>
                <div class="product-price">IDR 100,000</div>
            </a>
        <?php } ?>
        </div>
    </div>
</div>