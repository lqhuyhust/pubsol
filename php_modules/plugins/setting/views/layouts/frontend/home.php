<?php
$cur_year = date('Y');
?>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="200" valign="top" bgcolor="#339933">
            <?php  echo $this->render('widgets.topics'); ?>
        </td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <div align="center">
                <img src="<?php echo $this->url?>media/images/Dog_final_3.gif">
                <hr width="85%" noshade>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center">
                <table width="530" border="0" cellpadding="10" cellspacing="0">
                    <tr>
                        <td width="25%" valign="top">
                            <div align="center">
                                <p class="capt">
                                    <a href="<?php echo $this->url?>visitor" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_visitor','<?php echo $this->url?>media/images/facts_button_visitor_f3.jpg',1);" 
                                    onMouseOver="MM_nbGroup('over','facts_button_visitor','<?php echo $this->url?>media/images/facts_button_visitor_f2.jpg','<?php echo $this->url?>media/images/facts_button_visitor_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        <img name="facts_button_visitor" src="<?php echo $this->url?>media/images/facts_button_visitor.jpg" width="110" height="36" border="0" alt=""></a><a href="javascript:;" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_visitor','<?php echo $this->url?>media/images/facts_button_visitor_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_visitor','<?php echo $this->url?>media/images/facts_button_visitor_f2.jpg','<?php echo $this->url?>media/images/facts_button_visitor_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        <br>
                                    </a>
                                    <span class="capt">Click for a preview &amp; <br>
                                        for subscription
                                        information
                                    </span>
                                </p>
                            </div>
                        </td>
                        <td width="25%" valign="top">
                            <div align="center">
                                <p class="capt">
                                    <a href="<?php echo $this->url?>visitor#sub" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_sub1a','<?php echo $this->url?>media/images/facts_button_sub1_f3.jpg',1);" 
                                    onMouseOver="MM_nbGroup('over','facts_button_sub1a','<?php echo $this->url?>media/images/facts_button_sub1_f2.jpg','<?php echo $this->url?>media/images/facts_button_sub1_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        <img name="facts_button_sub1a" src="<?php echo $this->url?>media/images/facts_button_sub1.jpg" width="110" height="36" border="0" alt="">
                                    </a>
                                    <span class="capt"><br>Click to subscribe</span>
                                </p>
                            </div>
                        </td>
                        <td width="25%" valign="top">
                            <div align="center">
                                <p class="capt">
                                    <a href="<?php echo $this->url?>visitor#renew" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_renew1a','<?php echo $this->url?>media/images/facts_button_renew2_f3.jpg',1);" 
                                    onMouseOver="MM_nbGroup('over','facts_button_renew1a','<?php echo $this->url?>media/images/facts_button_renew2_f2.jpg','<?php echo $this->url?>media/images/facts_button_renew2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        <img name="facts_button_renew1a" src="<?php echo $this->url?>media/images/facts_button_renew2.jpg" width="110" height="36" border="0" alt="">
                                    </a>
                                    <span class="capt">Click to renew your <br>current subscription</span>
                                </p>
                            </div>
                        </td>
                        <td width="25%" valign="top">
                            <div align="center">
                                <p class="capt">
                                    <a href="<?php echo  $this->url. 'login' ?>" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_login','<?php echo $this->url?>media/images/facts_button_login_f3.jpg',1);" 
                                    onMouseOver="MM_nbGroup('over','facts_button_login','<?php echo $this->url?>media/images/facts_button_login_f2.jpg','<?php echo $this->url?>media/images/facts_button_login_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        <img name="facts_button_login" src="<?php echo $this->url?>media/images/facts_button_login.jpg" width="110" height="36" border="0" alt="">
                                    </a>
                                    <br>
                                    Click here to access <br>
                                    your existing account
                                </p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center">
                <table width="520" border="0" cellpadding="20" cellspacing="0">
                    <tr>
                        <td valign="top" class="copy1">
                            <div align="center">
                            <p>Facts4Me is an online reference tool for primary
                            readers of
                            English. <br>
                            This site is written by teachers and is committed to
                            offering high-quality, <br>
                            educationally-sound information in an
                            ad-free, child-safe environment.</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
                <tr>
                    <td>
                        <div align="center" class="links2">
                            <p>
                                <a href="<?php echo $this->url?>visitor">Visitor</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo  $this->url. 'login'?>">Log-In</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo $this->url?>about_us">About Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo $this->url ?>contact">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo $this->url ?>tell_friend">Tell A Friend</a>
                            </p>
                            <?php  echo $this->render('widgets.copy_right'); ?>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table></td>
</tr>
</table>