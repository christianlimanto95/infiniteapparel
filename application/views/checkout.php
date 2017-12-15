<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">CHECKOUT</div>
            <div class="section-title-line"></div>
        </div>
        <div class="section-1-inner">
            <div class="section-1-left">
                <div class="checkout-item-container">
                    <div class="custom-loader-container show">
                        <div class="custom-loader"></div>
                    </div>
                <?php for ($i = 0; $i < 0; $i++) { ?>
                    <div class="checkout-item">
                        <div class="checkout-item-number checkout-item-col">1.</div>
                        <div class="checkout-item-image checkout-item-col" style="background-image: url(<?php echo base_url("assets/images/catalog/1_1.png") ?>);"></div>
                        <div class="checkout-item-text checkout-item-col">
                            <div class="checkout-item-name">Hoody Jumper Immanuel</div>
                            <div class="checkout-item-size">Size: M</div>
                            <div class="checkout-item-qty">Qty: 5</div>
                        </div>
                        <div class="checkout-item-subtotal">IDR 720.000</div>
                    </div>
                <?php } ?>
                </div>
                <div class="total">
                    <div class="total-item">
                        <span class="total-item-label">Subtotal : IDR</span>
                        <span class="total-item-value total-item-value-subtotal">0</span>
                    </div>
                    <div class="total-item">
                        <span class="total-item-label">Shipping Tax : IDR</span>
                        <span class="total-item-value total-item-value-tax">0</span>
                    </div>
                    <div class="total-item">
                        <span class="total-item-label">Disc : IDR</span>
                        <span class="total-item-value total-item-value-disc">0</span>
                    </div>
                    <div class="total-item">
                        <span class="total-item-label total-item-label-total">Total : IDR</span>
                        <span class="total-item-value total-item-value-total">0</span>
                    </div>
                </div>
            </div>
            <div class="section-1-right">
                <div class="recipient-title">RECIPIENT INFORMATION</div>
                <div class="form-item-inline custom-form-item-inline">
                    <div class="form-label">First Name</div>
                    <input type="text" class="form-input" maxlength="50" />
                </div>
                <div class="form-item-inline custom-form-item-inline">
                    <div class="form-label">Last Name</div>
                    <input type="text" class="form-input" maxlength="50" />
                </div>
                <div class="form-item">
                    <div class="form-label">City</div>
                    <select class="form-input"></select>
                </div>
                <div class="form-item">
                    <div class="form-label">Address</div>
                    <input type="text" class="form-input" />
                </div>
                <div class="form-item">
                    <div class="form-label">Phone Number</div>
                    <input type="text" class="form-input" maxlength="15" />
                </div>
                <div class="form-item-inline custom-form-item-inline form-item-shipping">
                    <div class="form-label">Shipping</div>
                    <select class="form-input"></select>
                </div>
                <div class="form-item-inline custom-form-item-inline">
                    <div class="form-label">Service</div>
                    <select class="form-input"></select>
                </div>
                <div class="btn btn-submit-checkout">Submit</div>
            </div>
        </div>
    </div>
</div>