<div class="content">
    <div class="section section-1">
        <div class="section-title">
            <div class="section-title-line"></div>
            <div class="section-title-text">VERIFY EMAIL</div>
            <div class="section-title-line"></div>
        </div>
        <?php
            if ($result->status == "error") {
                echo "<div class='error'>This link has expired.</div>";
            } else {
                echo "<div class='success'>Thank you, " . $result->user_first_name . ". Your email has been verified. You can login now.</div>";
            }
        ?>
    </div>
</div>