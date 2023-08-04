<form action="<?php echo $this->link_submit ?>" method="post">
    <h4 for="">Contact Us</h4>
    <h5><?php echo $this->message ?></h5>
    <div class="row">
        <label>Full name *
            <input type="text" placeholder="Full name" name="full-name">
        </label>
    </div>
    <div class="row">
        <label>Email *
            <input type="email" placeholder="Email address" name="email">
        </label>
    </div>
    <div class="row">
        <label>Message *
            <textarea placeholder="Describe your needs" rows="3" name="message"></textarea>
        </label>
    </div>
    <div class="contact-panel-actions">
        <input type="submit" class="button submit-button" value="Submit">
    </div>
</form>