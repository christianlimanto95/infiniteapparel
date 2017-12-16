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
                </div>
                <div class="total">
                    <div class="total-item">
                        <span class="total-item-label">Subtotal : IDR</span>
                        <span class="total-item-value total-item-value-subtotal">0</span>
                    </div>
                    <div class="total-item">
                        <span class="total-item-label">Shipping Cost : IDR</span>
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
                    <div class="form-label custom-form-label">First Name <span class="error error-first-name"></span></div>
                    <input type="text" class="form-input custom-form-input form-input-first-name" maxlength="50" />
                </div>
                <div class="form-item-inline custom-form-item-inline">
                    <div class="form-label custom-form-label">Last Name</div>
                    <input type="text" class="form-input custom-form-input form-input-last-name" maxlength="50" />
                </div>
                <div class="form-item custom-form-item">
                    <div class="form-label custom-form-label">City</div>
                    <select class="form-input custom-form-input form-input-city"></select>
                </div>
                <div class="form-item custom-form-item">
                    <div class="form-label custom-form-label">Address <span class="error error-address"></span></div>
                    <textarea class="form-input custom-form-input form-input-address" maxlength="100"></textarea>
                </div>
                <div class="form-item custom-form-item">
                    <div class="form-label custom-form-label">Phone Number <span class="error error-phone"></span></div>
                    <input type="phone" class="form-input custom-form-input form-input-phone" data-input-type="number" maxlength="15" />
                </div>
                <div class="form-item-inline custom-form-item-inline form-item-shipping">
                    <div class="form-label custom-form-label">Shipping</div>
                    <select class="form-input custom-form-input form-input-shipping"></select>
                </div>
                <div class="form-item-inline custom-form-item-inline">
                    <div class="form-label custom-form-label">Service <span class="error error-service"></span></div>
                    <select class="form-input custom-form-input form-input-service"></select>
                </div>
                <div class="btn btn-submit-checkout">Submit</div>
            </div>
        </div>
    </div>
</div>
<script>
var get_city_url = "<?php echo base_url("checkout/get_city"); ?>";
var get_shipping_cost_url = "<?php echo base_url("checkout/get_cost"); ?>";
var do_checkout_url = "<?php echo base_url("checkout/do_checkout"); ?>";
var order_list_url = "<?php echo base_url("order-list"); ?>";
</script>