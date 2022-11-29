<table width="90%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="f7f7c6">
    <tr>
        <td valign="top">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="50" valign="top" bgcolor="#FFFFFF">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="185" valign="top"><img src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50"></td>
                                <td valign="top">
                                    <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="40%">
                                                <div align="center">
                                                </div>
                                            </td>
                                            <td width="60%" valign="bottom">
                                                <div align="center">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="top">
                                    <div align=center>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="20">
                                            <tr>
                                                <td>
                                                    <div align="center" class="hdrmain">
                                                        <p>Facts 4 Me Subscription</p>
                                                        <hr noshade>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>

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

                                            echo "<div align=center class=subbld>Description: " . $this->x_Description . "  <br>\n";
                                            echo "For " . $this->u_f_name . " " . $this->u_l_name . " <br>\n";
                                            echo "Total Amount: $" . $this->x_Amount . "<br></div>\n";
                                        } else {
                                            $x_cust_id = $this->nuserid;
                                            $cust_id = $this->nu_id;
                                            echo "<div align=center class=subbld>Description: " . $this->x_Description . "  <br>\n";
                                            echo "For " . $this->u_f_name . " " . $this->u_l_name . " <br>\n";
                                            echo "Total Amount: $" . $this->x_Amount . "<br></div>\n";
                                        }
                                    ?>
                                            <?php
                                            ?>
                                            <div align=center class=subbld>&nbsp;<br>
                                                <input id="button_submit_payment" type="IMAGE" value="submit" name="submit" src="<?php echo  $this->url ?>media/images/payment_button.jpg" border=0>
                                                <div class="spinner hidden" id="spinner"></div>
                                            </div>
                                            <?php
                                            // $temp = explode("-", $this->expire_date);
                                            // $t_yr = $temp[0] + 1;
                                            // $this->expire_date = $t_yr . "-" . $temp[1] . "-" . $temp[2];
                                            ?>

                                        </FORM>
                                    <?php
                                        echo "</td></tr>";
                                        echo $this->render('widgets.footer1');
                                        echo $this->render('stripe.script');
                                    }
                                    ?>