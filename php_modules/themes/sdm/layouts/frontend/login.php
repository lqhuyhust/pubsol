<?php
$cur_year = date('Y');
?>
<?php echo $this->render('widgets.topics'); ?>
<div class="w-100">
    <div class="bg-white">
        <?php echo $this->render('widgets.header_menu'); ?>
    </div>
    <div class="container">
        <div class="fieldtitle py-5 text-center">
            <img src="<?php echo  $this->url ?>media/images/facts_welcome_hdr.jpg">
        </div>
        <div>
            <div>
                <div align="left" class="copy1">
                    <?php
                    if ($this->err_flg == "ERROR") {
                        echo '<div align="center"><p class="capt3"><font color="#cc0000">' . $this->err_msg . '</font></p></div>' . "\n";
                        // echo "sys_script:*$sys_script*  p_name1:*$p_name1*\n";

                    }
                    echo '<div align="center" class="copy2 py-3 fs-7">Please log-in to access information</div>' . "\n";
                    echo '<form name="login" id="login" action="' . $this->url . 'login" method="post">' . "\n";
                    ?>
                    <?php if (!$this->ip_addr) { ?>
                        <div class="row g-3 align-items-center pt-3">
                            <div class="col-xl-3 col-sm-8 text-start mx-auto mt-2">
                                <label class="col-form-label fw-medium"><i class="fa-solid fa-user"></i> Username</label>
                                <input class="form-control rounded-0 border border-1" type="text" class="col-md-5 col-xl-3" name="username" maxlength="40" class="copy2" value="">
                            </div>
                        </div>
                        <div class="row g-3 align-items-center pt-4">
                            <div class="col-xl-3 col-sm-8 text-start mx-auto my-0">
                                <label class="col-form-label fw-medium"><i class="fa-solid fa-lock"></i> Password</label>
                                <input class="form-control rounded-0 border border-1" type="password" class="col-md-5 col-xl-3" name="pass" maxlength="40" class="copy2" value="">
                            </div>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="submit" value="login">
                    <div align="center" class="pt-3">
                        <?php if ($this->ip_addr) { ?>
                            <span class="fieldtitle col-md-2 col-lg-2">Click on "go" to complete login</span>
                            <br>
                            <input class="form-control rounded-0 border border-1" type="hidden" class="col-md-5 col-xl-3" name="ip_addr" maxlength="40" class="copy2" value="<?php echo $this->ip_addr; ?>">
                            <input class="form-control rounded-0 border border-1" type="hidden" class="col-md-5 col-xl-3" name="token" maxlength="40" class="copy2" value="<?php echo $this->token; ?>">
                        <?php } ?>
                    </div>
                    <div align="center" class="pt-3">
                        <input class="img-fluid" width="36" height="36" type="IMAGE" value="Login1" name="submit" src="<?php echo  $this->url ?>media/images/facts_button_go2.jpg" border=0 onClick="javascript:submitLogin()">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div width="100%">
        <div align="center" class="links2 py-3 pt-5">
            <div class="links2">
                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>" target="_top">Home</a>
                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>visitor" target="_top">Visitor</a>
                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>contact" target="_top">Contact Us</a>
                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>tell_friend" target="_top">Tell A Friend</a>
            </div>
            <div class="pt-4">
                <?php echo $this->render('widgets.copy_right'); ?>
            </div>
        </div>
    </div>
    </td>
    </tr>
    </table>
    </td>
    </tr>
    </table>