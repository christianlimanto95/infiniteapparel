<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">CONFIRM PAYMENT</div>
            <div class="section-title-line"></div>
        </div>
        <div class="section-1-inner">
            <div class="section-1-left">
                <div class="form-item form-item-upper">
                    <div class="form-label custom-form-label">Order Number : </div>
                    <div class="custom-form-input"><?php echo $data->hjual_id; ?></div>
                </div>
                <div class="form-item form-item-upper form-item-total-payment">
                    <div class="form-label custom-form-label">Total Payment : </div>
                    <div class="custom-form-input">IDR <?php echo number_format($data->hjual_grand_total_price, 0, ",", "."); ?></div>
                </div>
                <div class="form-item form-item-downer">
                    <div class="form-label custom-form-label">Name</div>
                    <span> : </span>
                    <div class="custom-form-input"><?php echo $data->pemesanan_first_name . " " . $data->pemesanan_last_name; ?></div>
                </div>
                <div class="form-item form-item-downer">
                    <div class="form-label custom-form-label">Address</div>
                    <span> : </span>
                    <div class="custom-form-input"><?php echo $data->pemesanan_address; ?></div>
                </div>
                <div class="form-item form-item-downer">
                    <div class="form-label custom-form-label">Phone</div>
                    <span> : </span>
                    <div class="custom-form-input"><?php echo $data->pemesanan_handphone; ?></div>
                </div>
            </div>
            <form class="section-1-right" method="post" action="<?php echo base_url("do_confirm_payment"); ?>" enctype="multipart/form-data">
                <input type="hidden" name="order_id" value="<?php echo $data->hjual_id; ?>" />
                <div class="section-1-right-title">Bank <span class="error bank-error"></span></div>
                <label class="label" for="bank-bca">
                    <input type="radio" name="bank" value="bca" id="bank-bca" class="input-bank bank-bca" />
                    <div class="bank-image" style="background-image: url(<?php echo base_url("assets/images/bca.jpg") ?>);"></div>
                </label>
                <label class="label" for="bank-mandiri">
                    <input type="radio" name="bank" value="mandiri" id="bank-mandiri" class="input-bank bank-mandiri" />
                    <div class="bank-image" style="background-image: url(<?php echo base_url("assets/images/mandiri.png") ?>);"></div>
                </label>
                <div class="section-1-blank-space"></div>
                <label class="label" for="bank-other">
                    <input type="radio" name="bank" value="other" id="bank-other" class="input-bank bank-other" />
                    <div class="other-label">Other</div>
                </label>
                <input type="text" class="input-other-bank form-input" />
                <div class="bank-information">
                    <div class="form-item">
                        <div class="form-label bank-information-label">Bank Account Number (Nomor Rekening) <span class="error bank-account-number-error"></span></div>
                        <input type="text" name="bank_account_number" class="form-input bank-information-input form-input-account-number" data-input-type="number" maxlength="16" />
                    </div>
                    <div class="form-item">
                        <div class="form-label bank-information-label">Bank Account Name (Atas Nama) <span class="error bank-account-name-error"></span></div>
                        <input type="text" name="bank_account_name" class="form-input bank-information-input form-input-account-name" maxlength="50" />
                    </div>
                    <div class="form-item">
                        <div class="form-label bank-information-label">Proof of Payment (Bukti Pembayaran) <span class="error proof-of-payment-error"></span></div>
                        <input type="file" name="input-image" class="form-input bank-information-input form-input-proof" />
                    </div>
                    <img class="proof-image" />
                    <button type="submit" class="btn-confirm-payment" >Confirm Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>