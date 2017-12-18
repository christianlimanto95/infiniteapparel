<div class="modal modal-order-detail">
	<div class="modal-box">
		<div class="modal-header">
			<div class="modal-close-button" style="background-image: url(<?php echo base_url("assets/icons/close.png"); ?>);"></div>
			<div class="modal-header-text">
				Details for Order No. <span class="modal-order-detail-header-normal"></span>
			</div>
		</div>
		<div class="modal-body">
			<table class="modal-order-detail-table">
				<thead>
					<tr>
						<td data-col="name">Item</td>
						<td data-col="size">Size</td>
						<td data-col="price">Price</td>
						<td data-col="qty">Qty</td>
						<td data-col="subtotal">Subtotal</td>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<div class="modal-order-detail-footer">
                <div class="modal-order-detail-footer-item">
                    <div class="modal-order-detail-footer-label">Subtotal : IDR </div>
                    <div class="modal-order-detail-footer-value order-detail-subtotal">0</div>
                </div>
                <div class="modal-order-detail-footer-item">
                    <div class="modal-order-detail-footer-label">Shipping Cost : IDR </div>
                    <div class="modal-order-detail-footer-value order-detail-shipping-cost">0</div>
                </div>
                <div class="modal-order-detail-footer-item">
                    <div class="modal-order-detail-footer-label">Discount : IDR </div>
                    <div class="modal-order-detail-footer-value order-detail-discount">0</div>
                </div>
                <div class="modal-order-detail-footer-item">
                    <div class="modal-order-detail-footer-label">Total : IDR </div>
                    <div class="modal-order-detail-footer-value order-detail-total">0</div>
                </div>
            </div>
		</div>
	</div>
</div>

<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">ORDER LIST</div>
            <div class="section-title-line"></div>
        </div>
        <div class="section-1-inner">
            <div class="custom-loader-container show">
                <div class="custom-loader"></div>
            </div>
        </div>
    </div>
</div>
<script>
var get_order_url = "<?php echo base_url("order_list/get_order"); ?>";
var get_order_detail_url = "<?php echo base_url("order_list/get_order_detail"); ?>";
var confirm_payment_url = "<?php echo base_url("confirm_payment"); ?>";
</script>