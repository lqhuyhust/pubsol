<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="200" valign="top" bgcolor="#339933">
            <?php echo $this->render('widgets.topics'); ?>
        </td>
        <td valign="top">
            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="60%" height="50" valign="middle" bgcolor="#FFFFFF">
                        <div align="center">
                            <?php echo $this->render('widgets.header_menu'); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table width="90%" border="0" cellspacing="0" cellpadding="10">
                            <tr>
                                <td colspan="2">
                                    <div align="center" class="fieldtitle">
                                        <img src="<?php echo  $this->url ?>media/images/facts_welcome_hdr.jpg" width="300" height="100">
                                    </div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <h1 align=center class="hdrmain">Tell a Friend about Facts 4 Me</h1>
                                    <hr size="2" noshade>
                                    <p>&nbsp;</p>
                                    <?php if (!$this->after_submit) { ?>
                                        <form name="email1" method="POST" action="<?php echo $this->url?>tell_friend">
                                            <table align="center" cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td width="42%" align="right" valign="top" class=subbld>Your Email address</td>
                                                    <td width="2%">&nbsp;</td>
                                                    <td width="56%" valign="top">
                                                        <input name="from_email" type="text" size="40" maxlength="50" border="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="42%" align="right" valign="top" class=subbld>Your Name</td>
                                                    <td width="2%">&nbsp;</td>
                                                    <td width="56%" valign="top">
                                                        <input name="from_name" type="text" size="40" maxlength="40" border="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="42%" align="right" valign="top" class=subbld>
                                                        <p>Send Email To</p>
                                                        <p>&nbsp;</p>
                                                    </td>
                                                    <td width="2%">&nbsp;</td>
                                                    <td width="56%" valign="top">
                                                        <input name="to_email" type="text" size="40" maxlength="40" border="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="42%" align="right" valign="top" class=subbld>Enter comment
                                                        <br>
                                                        to send
                                                    </td>
                                                    <td width="2%">&nbsp;</td>
                                                    <td width="56%" valign="top">
                                                        <textarea name="cont_notes" rows="8" cols="40">
I found this great site! www.facts4me.com

Wonderful resource for kids! Thought you would be interested in it, too.
                                                </textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                            <p align="center" class="MsoNormal" style="margin-bottom: 12.0pt">
                                                <input type="hidden" value="<?php echo $this->token?>" name="token">
                                                <input type="submit" value="Send to friend" name="B1">
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="reset" value="Reset" name="B2">
                                            </p>
                                            <p> <br>
                                        </form>
                                        <?php } else {
                                        if ($this->err_flg == "ERROR") {
                                            echo '<div align="center"><p class="capt3"><font color="#cc0000">' . $this->err_msg . '</font></p>' . "\n";
                                        ?>
                                            <p class="links2" align="center"><a href="javascript:history.go(-1)" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                                    <img name="facts_button_back1" src="<?php echo  $this->url ?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt=""></a></p>
                                            <?php
                                        } else {
                                            echo '<div align="center">';
                                            if (!$this->send_mail) {
                                                echo '<p align="center"><b>The information send to ' . $this->to_email . ' at ' . $this->to_email . " FAILED .</b></p>\n";
                                                echo "Mailer error: " . $this->mail_error;
                                            } else {
                                            ?>
                                                <p>&nbsp;</p>
                                                <p class=copy2>Your email to <?php echo $this->to_email; ?> telling them about Facts 4 Me has been processed.</p>
                                                <p class=copy2>A copy of the email has been sent to you at <?php echo $this->from_email ?>.</p>
                                                <p class=copy2>Thank you for you telling a friend about Facts 4 Me.</p>
                                                <p>&nbsp;</p>
                                            <?php
                                            }
                                            ?>
                                            <p class="links2" align="center"><a href="javascript:history.go(-1)" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                                    <img name="facts_button_back1" src="<?php echo  $this->url ?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt=""></a></p>
                                            </div>
                                    <?php }
                                    } ?>
                            </tr>
                        </table>
                        <?php echo $this->render('widgets.copy_right'); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>