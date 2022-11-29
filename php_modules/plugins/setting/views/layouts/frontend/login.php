<?php
$cur_year = date('Y');
?>
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
                                <td width="200">
                                    <div align="center" class="fieldtitle">
                                        <img src="<?php echo  $this->url?>media/images/facts_welcome_hdr.jpg" width="300" height="100">
                                    </div>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <div align="left" class="copy1">
                                    <?php
                                        if ($this->err_flg == "ERROR")
                                        {
                                            echo '<div align="center"><p class="capt3"><font color="#cc0000">' . $this->err_msg . '</font></p></div>' . "\n";
                                            // echo "sys_script:*$sys_script*  p_name1:*$p_name1*\n";

                                        }
                                        echo '<p align="center" class="copy2">Please log-in to access information</p>' . "\n";
                                        echo '<form name="login" id="login" action="' . $sys_script . '" method="post">' . "\n";

                                        echo '<input type="hidden" name="srv_time1" value="' . time() . '">' . "\n";
                                    ?>
                                            <p align="center">
                                                <span class="fieldtitle">username:</span>
                                                <input type="text" name="username" maxlength="40" class="copy2" value="">
                                            </p>
                                            <p align="center">
                                                <span class="fieldtitle">password:</span>
                                                <input type="password" name="pass" maxlength="40" class="copy2"  value="">
                                            </p>
                                            <input type="hidden" name="submit" value="login"> 
                                            <p align="center">
                                                <input type="IMAGE" value="Login1" name="submit" src="<?php echo  $this->url?>media/images/facts_button_go2.jpg" border=0 onClick="javascript:submitLogin()">
                                            </p>
                                            <p align="center">
                                                Click on "go" to complete login<br>
                                                <input type="IMAGE" value="Login1" name="submit" src="<?php echo  $this->url?>media/images/facts_button_go2.jpg" border="0" onclick="javascript:submitLogin()">
                                            </p>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="10">
                            <tr>
                                <td>
                                    <div align="center" class="links2">
                                        <p class="links2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo $this->url?>" target="_top">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo $this->url?>visitor" target="_top">Visitor</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <!--    <a href="/info/lostpsw.php">Forgot Password?</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   -->
                                        <a href="<?php echo $this->url?>contact" target="_top">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo $this->url?>tell_friend" target="_top">Tell A Friend</a></p>
                                        <?php  echo $this->render('widgets.copy_right'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>