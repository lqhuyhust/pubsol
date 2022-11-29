<?php echo $this->render('widgets.topics'); ?>
<div class="w-100">
    <div class="bg-white">
        <?php echo $this->render('widgets.header_menu'); ?>
    </div>
    <div class="container text-center">
        <div colspan="2">
            <div class="fieldtitle py-5 text-center">
                <img class="img-fluid" src="<?php echo  $this->url ?>media/images/facts_welcome_hdr.jpg" width="300" height="100">
            </div>
            <div>
                <p class="fs-2 fw-bold color-red text-center">Tell a Friend about Facts 4 Me</p>
                <hr class="border-black-2">
                <?php if (!$this->after_submit) { ?>
                    <form name="email1" class="py-3" method="POST" action="<?php echo $this->url ?>tell_friend">
                        <div class="row g-3 align-items-center">
                            <div class="col-xl-5 col-sm-3 text-end">
                                <label class="col-form-label fw-bold">Your Email address</label>
                            </div>
                            <div class="col-xl-3 col-sm-8 text-start ">
                                <input class="form-control rounded-0 border border-1" name="from_email" type="text" maxlength="50">
                            </div>
                            <div class="col-xl-5 col-sm-3 text-end">
                                <label class="col-form-label fw-bold">Your Name</label>
                            </div>
                            <div class="col-xl-3 col-sm-8 text-start ">
                                <input class="form-control rounded-0 border border-1" name="from_name" type="text" maxlength="50">
                            </div>
                            <div class="col-xl-5 col-sm-3 text-end">
                                <label class="col-form-label fw-bold">Send Email To</label>
                            </div>
                            <div class="col-xl-3 col-sm-8 text-start ">
                                <input class="form-control rounded-0 border border-1" name="to_email" type="text" maxlength="50">
                            </div>

                            <div class="col-xl-5 col-sm-3 text-end">
                                <label class="col-form-label fw-bold">Enter comment <br>
                                    to send</label>
                            </div>
                            <div class="col-xl-3 col-sm-8 text-start ">
                                <textarea class="form-control rounded-0 border border-1" name="cont_notes" type="text" style="height: 200px;">I found this great site! www.facts4me.com 

Wonderful resource for kids! Thought you would be interested in it, too.
                        </textarea>
                            </div>
                            <p align="center" class="MsoNormal" style="margin-bottom: 12.0pt">
                                <input type="hidden" value="<?php echo $this->token ?>" name="token">
                                <input type="submit" value="Send to friend" name="B1">
                                <input type="reset" value="Reset" name="B2">
                            </p>

                            <p>
                        </div>
                    </form>
                    <?php } else {
                    if ($this->err_flg == "ERROR") { ?>
                        <div align="center">
                            <p class="capt3">
                                <div class="fs-6 color-red fw-bold"><?php echo $this->err_msg ?></div>
                            </p>

                            <p class="links2 text-center py-4">
                                <a href="javascript:history.go(-1)" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_back1" src="<?php echo  $this->url ?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt="">
                                </a>
                            </p>
                            <?php
                        } else { ?>
                            <div align="center">
                            <?php if (!$this->send_mail) { ?>
                                <p class="text-center fw-bold fs-6">The information send to <?php echo $this->to_email . ' at ' . $this->to_email ?> FAILED .</b></p>
                                <p class="text-center fw-normal fs-6"> Mailer error: <?php echo $this->mail_error ?> </p>
                            <?php } else { ?>
                                <p class="text-center fw-normal fs-6" >Your email to <?php echo $this->to_email; ?> telling them about Facts 4 Me has been processed.</p>
                                <p class="text-center fw-normal fs-6" >A copy of the email has been sent to you at <?php echo $this->from_email ?>.</p>
                                <p class="text-center fw-normal fs-6" >Thank you for you telling a friend about Facts 4 Me.</p>                            <?php
                            } ?>
                            <p class="links2" align="center">
                                <a href="javascript:history.go(-1)" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_back1" src="<?php echo  $this->url ?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt="">
                                </a>
                            </p>
                        </div>
                <?php }
                    } ?>
                <?php echo $this->render('widgets.copy_right'); ?>
            </div>
        </div>
    </div>
</div>
</div>