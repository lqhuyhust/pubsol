<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="200" valign="top" bgcolor="#339933">
            <?php  echo $this->render('widgets.topics'); ?>
        </td>
        <td valign="top">
            <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="60%" height="50" valign="middle" bgcolor="#FFFFFF">
                        <div align="center">
                            <?php  echo $this->render('widgets.header_menu'); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top">
                        <table width="90%" border="0" cellspacing="0" cellpadding="10">
                            <tr>
                                <td colspan="2">
                                    <div align="center" class="fieldtitle">
                                        <img src="<?php echo $this->url?>media/images/facts_welcome_hdr.jpg" width="300" height="100">
                                    </div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td class="hdrmain"> 
                                    <p align="center">Contact Us</p>
                                    <hr noshade>
                                    <br>
                                    <?php if (!$this->after_submit){ ?>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="10">
                                        <tr class="fieldtitle">
                                            <td width="33%" bgcolor="004d91">
                                                <div align="center">
                                                    <p class="titlerev">phone</p>
                                                </div>
                                            </td>
                                            <td width="33%" bgcolor="004d91">
                                                <div align="center">
                                                    <p class="titlerev">mail</p>
                                                </div>
                                            </td>
                                            <td width="33%" bgcolor="004d91">
                                                <div align="center" class="titlerev">fax

                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="copy2">
                                            <td width="33%" bgcolor="#FFFFFF">
                                                <div align="center">
                                                    <p class="subbld">630-515-0928</p>
                                                </div>
                                            </td>
                                            <td width="33%">
                                                <div align="center">
                                                    <span class="subbld">Facts4Me,
                                                Inc.</span>
                                                    <br>
                                                    P.O. Box 245
                                                    <br>
                                                    Westmont, IL 60559
                                                </div>
                                            </td>
                                            <td width="33%" bgcolor="#FFFFFF">
                                                <div align="center" class="subbld"> 
                                                    <p>630-515-0054</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div align=center>
                                        <table width="80% align="center">
                                            <tr>
                                                <td class="copy2">
                                                    &nbsp;<br>We take our commitment to provide accurate information very seriously.
                                                    If you would like to submit a correction, a change or an addition,
                                                    please email us and we will give it our immediate attention. <br>&nbsp;
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <form name="email1" method="POST" action="<?php echo $this->url?>contact">
                                        <table border="0" align="center" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td width="42%" align="right" class=subbld>Email *</td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input name="email" type="text" size="40" maxlength="50" border="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld>Name *</td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input name="name" type="text" size="40" maxlength="40" border="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld>Address</td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input name="addr1" type="text" size="40" maxlength="40" border="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld> </td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input name="addr2" type="text" size="40" maxlength="40" border="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld>City</td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input type="text" size="40" name="city" border="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld>State/Province</td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input name="state" type="text" size="40" maxlength="40" border="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld>Postal Code</td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input type="text" size="40" name="zip" border="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld><p>How did you <br>
                                                    find
                                                our site?</p>
                                                <p>&nbsp;</p></td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input name="howfound" type="text" size="40" maxlength="40" border="0">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" valign="top" class=subbld>Enter question
                                                or<br>
                                                message to send </td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <textarea name="cont_notes" rows="8" cols="40"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld><p>Key value</p>
                                                </td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top"><? echo $this->key_num;?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="42%" align="right" class=subbld><p>Enter value above *</p>
                                                </td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="56%" valign="top">
                                                    <input type="hidden" name=token value="<? echo $this->token;?>">
                                                    <input type="hidden" name=ck_num value="<? echo $this->key_num;?>">
                                                    <input name="my_num" type="text" required size="10" maxlength="10" border="0">
                                                </td>
                                            </tr>
                                        </table>
                                        <p align="center" class="copy1">* required information</p>
                                        <p align="center" style="margin-bottom: 12.0pt">
                                            <input type="submit" value="Submit email or question" name="B1">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="reset" value="Reset" name="B2">
                                        </p>
                                        <p> <br>
                                    </form>
                                    <?php }else  {
                                        if ($this->err_flg == "ERROR")
                                        {
                                            echo '<div align="center"><p class="capt3"><font color="#cc0000">' . $this->err_msg . '</font></p>' . "\n";
                                        ?>
                                            <p class="links2" align="center"><a href="javascript:history.go(-1)" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo $this->url?>media/images/facts_button_back2.jpg',1);" 
                                                onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo $this->url?>media/images/facts_button_back2_f2.jpg','<?php echo $this->url?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                                <img name="facts_button_back1" src="<?php echo $this->url?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt=""></a></p>
                                        <?php
                                        }
                                        else
                                        {
                                            echo '<div align="center">';
                                            if(!$this->send_mail)
                                            {
                                                echo '<p align="center"><b>The information send to ' . $this->to_name . ' at ' . $this->to_addr . " FAILED .</b></p>\n";
                                                echo "Mailer error: " . $this->mail_error;
                                            }
                                            else
                                            {
                                                ?>
                                                <p>&nbsp;</p>
                                                <p class=copy2>Your request for information about Facts 4 Me has been processed.</p>
                                                <p class=copy2>A copy of the information request has been sent to you at <?php echo $this->c_email; ?>.</p>
                                                <?php
                                            }
                                        ?>
                                        <p class=copy2>Thank you for you interest in Facts 4 Me.</p>
                                        <p>&nbsp;</p>
                                        <p class="links2" align="center"><a href="javascript:history.go(-2)" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo $this->url?>media/images/facts_button_back2.jpg',1);" 
                                            onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo $this->url?>media/images/facts_button_back2_f2.jpg','<?php echo $this->url?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                            <img name="facts_button_back1" src="<?php echo $this->url?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt=""></a></p></div>
                                    <?php } }?>
                                </td>
                            </tr>
                        </table>
                        <?php  echo $this->render('widgets.copy_right'); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>