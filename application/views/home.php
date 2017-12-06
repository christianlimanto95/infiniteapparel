<div class="preloader<?php if (!$this->session->userdata("browser_session")) {
        $this->session->set_userdata("browser_session", true);
    } else {
        echo " hidden";
    } ?>">
    <div class="preloader-left"></div>
    <div class="preloader-right"></div>
    <div class="preloader-image" style="background-image: url(assets/icons/loading.gif);"></div>
</div>
<div class="content">
    <div class="section section-1">
        <div class="section-1-image" style="background-image: url(assets/images/home.png?v=1);"></div>
        <div class="section-gradient"></div>
        <a href="<?php echo base_url("catalog"); ?>" class="explore-products-container">
            <div class="btn-explore-products" data-anim="show-up">EXPLORE PRODUCTS</div>
        </a>
    </div>
    <div class="section section-2">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">AVAILABLE NOW</div>
            <div class="section-title-line"></div>
        </div>
        <div class="product-container">
        <?php 
            for ($i = 0; $i < sizeof($available_now); $i++) { ?>
            <div class="product" data-anim="show-up">
                <a href="<?php echo base_url("product/" . $available_now[$i]->item_id . "/" . str_replace(" ", "-", $available_now[$i]->item_name)); ?>" class="product-image-container">
                    <div class="product-image" style="background-image: url(<?php echo base_url("assets/images/catalog/" . $available_now[$i]->item_id . "_1.png"); ?>);"></div>
                    <div class="product-image-wrapper">
                        <div class="btn-wrapper">
                            <div class="btn btn-buy-now">BUY NOW</div>
                            <div class="btn btn-add-to-bag">ADD TO BAG</div>
                        </div>
                    </div>
                </a>
                <div class="product-name"><?php echo $available_now[$i]->item_name; ?></div>
                <div class="product-price">IDR <?php echo number_format($available_now[$i]->item_price, 0, ".", ","); ?></div>
            </div>
        <?php 
            } ?>
        </div>
    </div>
    <div class="section section-3">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">RECENT CUSTOMERS</div>
            <div class="section-title-line"></div>
        </div>
        <div class="recent-customers">
            <div class="recent-customers-image" style="background-image: url(assets/images/recent-customers/1.jpg);" data-anim="show-up"></div>
            <div class="recent-customers-image" style="background-image: url(assets/images/recent-customers/2.jpg);" data-anim="show-up"></div>
            <div class="recent-customers-image" style="background-image: url(assets/images/recent-customers/3.jpg);" data-anim="show-up"></div>
        </div>
    </div>
</div>