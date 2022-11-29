<?php
$cur_year = date('Y');
?>
<?php echo $this->render('widgets.topics'); ?>
<div class="w-100 mx-3">
    <div align="center">
        <img src="<?php echo  $this->url ?>media/images/Dog_final_3.gif">
        <hr width="85%" class="border-black-2">
    </div>
    <div align="center" class="container">
        <div class="w-100">
            <div class="d-flex justify-content-center flex-row">
                <div class="mx-2">
                        <div class="capt">
                            <a href="<?php echo  $this->url ?>visitor" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_visitor','<?php echo  $this->url ?>media/images/facts_button_visitor_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_visitor','<?php echo  $this->url ?>media/images/facts_button_visitor_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_visitor_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                <img style="min-width:110px;" class="img-fluid" name="facts_button_visitor" src="<?php echo  $this->url ?>media/images/facts_button_visitor.jpg" width="110" height="56" alt=""></a><a href="javascript:;" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_visitor','<?php echo  $this->url ?>media/images/facts_button_visitor_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_visitor','<?php echo  $this->url ?>media/images/facts_button_visitor_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_visitor_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                            </a>
                        </div>
                        <div class="capt">Click for a preview &amp; <br>
                            for subscription
                            information
                        </div>
                </div>
                <div class="mx-2">
                    <div align="center">
                        <div class="capt">
                            <a href="<?php echo  $this->url ?>visitor#sub" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_sub1a','<?php echo  $this->url ?>/media/images/facts_button_sub1_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_sub1a','<?php echo  $this->url ?>/media/images/facts_button_sub1_f2.jpg','<?php echo  $this->url ?>/media/images/facts_button_sub1_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                <img style="min-width:110px" class="img-fluid" name="facts_button_sub1a" src="<?php echo  $this->url ?>/media/images/facts_button_sub1.jpg" width="110" height="56" alt="">
                            </a>
                        </div>
                        <div  class="capt">Click to subscribe</div>
                    </div>
                </div>
                <div class="mx-2">
                    <div align="center">
                        <div class="capt">
                            <a href="<?php echo  $this->url ?>visitor#renew" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_renew1a','<?php echo  $this->url ?>/media/images/facts_button_renew2_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_renew1a','<?php echo  $this->url ?>/media/images/facts_button_renew2_f2.jpg','<?php echo  $this->url ?>/media/images/facts_button_renew2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                <img style="min-width:110px" class="img-fluid" name="facts_button_renew1a" src="<?php echo  $this->url ?>/media/images/facts_button_renew2.jpg" width="110" height="56" alt="">
                            </a>
                        </div>
                        <div class="capt">Click to renew your <br>current subscription</div>
                    </div>
                </div>
                <div class="mx-2">
                    <div align="center">
                        <div class="capt">
                            <a href="<?php echo  $this->url . 'login' ?>" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_login','<?php echo  $this->url ?>media/images/facts_button_login_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_login','<?php echo  $this->url ?>media/images/facts_button_login_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_login_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                <img style="min-width:110px" class="img-fluid" name="facts_button_login" src="<?php echo  $this->url ?>media/images/facts_button_login.jpg" width="110" height="56" alt="">
                            </a>
                        </div>
                        <div class="capt">Click here to access <br>your existing account</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-3">
            <div class="copy1 ">
                <div align="center" class="fs-6 py-3 text-nowrap">
                    Facts4Me is an online reference tool for primary readers of English. <br>
                    This site is written by teachers and is committed to offering high-quality, <br>
                    educationally-sound information in an ad-free, child-safe environment.
                </div>
            </div>
        </div>
        <div class="w-100">
            <div align="center" class="links2 pt-3">
                <div>
                    <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>visitor">Visitor</a>
                    <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url . 'login' ?>">Log-In</a>
                    <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>about_us">About Us</a>
                    <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>contact">Contact Us</a>
                    <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>tell_friend">Tell A Friend</a>
                </div>
                <div class="pt-4">
                    <?php echo $this->render('widgets.copy_right'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>