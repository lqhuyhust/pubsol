<div class="row h-100">
    <div class="col-05"></div>
    <div class="col-11">
        <div class="bg-white">
            <img class="img-fluid" src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50">
        </div>
        <div class="bg-yellow ">
            <div class="p-4">
                <p class="fs-2 fw-bold color-red text-center py-3">Facts 4 Me Subscription</p>
                <hr class="border-black-2">
            </div>
            <div class="h-100">
                <div class="pb-4">
                    <?php
                    if ($this->err_flg != "OK") {
                        echo $this->render('widgets.err_msg');
                    } else {
                        if ($this->nu_id == "NEW") {

                            $row = $this->user;
                            $x_cust_id = $this->nuserid;
                            $cust_id = $row['u_id'];
                            $nu_id = $row['u_id'];
                            $this->nu_id = $row['u_id'];
                    ?>
                            <div class="fs-6 fw-bold text-center">Description: <?php echo  $this->x_Description ?> <br>
                                For <?php echo  $this->u_f_name . " " . $this->u_l_name ?> <br>
                                Total Amount: $<?php echo  $this->x_Amount ?><br></div>
                        <?php } else {
                            $x_cust_id = $this->nuserid;
                            $cust_id = $this->nu_id;
                        ?>
                            <div class="fs-6 fw-bold text-center">Description: <?php echo  $this->x_Description ?> <br>
                                For <?php echo  $this->u_f_name . " " . $this->u_l_name ?> <br>
                                Total Amount: $<?php echo  $this->x_Amount ?><br></div>
                        <?php } ?>
                </div>
                <div class="fs-6 fw-bold text-center">
                    <input class="img-fluid" id="button_submit_payment" type="IMAGE" value="submit" name="submit" src="<?php echo  $this->url ?>media/images/payment_button.jpg" border=0>
                    <div class="spinner hidden" id="spinner"></div>
                </div>
                <?php
                        // $temp = explode("-", $this->expire_date);
                        // $t_yr = $temp[0] + 1;
                        // $this->expire_date = $t_yr . "-" . $temp[1] . "-" . $temp[2];
                ?>

                </FORM>
            <?php
                echo $this->render('widgets.footer1');
                echo $this->render('stripe.script');
                        }
            ?>
            </div>
        </div>
    </div>
    <div class="col-05"></div>
</div>