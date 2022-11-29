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
                <p class="fs-2 fw-bold color-red text-center">Contact Us</p>
                <hr class="border-black-2">
                <?php
                if ($this->err_flg == "ERROR" && $this->after_submit) { ?>
                        <div align="center">
                            <p class="capt3">
                            <div class="fs-6 color-red fw-bold"><?php echo $this->err_msg ?></div>
                            </p>
                            <?php /*
                            <div class="links2 text-center py-4">
                                <a href="javascript:history.go(-1)" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo $this->url ?>media/images/facts_button_back2.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo $this->url ?>media/images/facts_button_back2_f2.jpg','<?php echo $this->url ?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_back1" src="<?php echo $this->url ?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt="">
                                </a>
                            </div> */ ?>
                        </div>
                    <?php
                    } elseif ($this->after_submit) { ?>
                        <div align="center pt-4">
                            <?php if (!$this->send_mail) { ?>
                                <p class="text-center fw-bold fs-6">The information send to <?php echo $this->to_name . ' at ' . $this->to_addr ?> FAILED . </p>
                                <p class="text-center fw-normal fs-6"> Mailer error: <?php echo $this->mail_error ?> </p>
                            <?php } else {
                            ?>
                                <p class="text-center fw-normal fs-6">Your request for information about Facts 4 Me has been processed.</p>
                                <p class="text-center fw-normal fs-6">A copy of the information request has been sent to you at <?php echo $this->c_email; ?>.</p>
                                <p class="text-center fw-normal fs-6">Thank you for you interest in Facts 4 Me.</p>
                            <?php
                            }
                            ?>
                            <?php /*
                            <p class="links2" align="center"><a href="javascript:history.go(-2)" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo $this->url ?>media/images/facts_button_back2.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo $this->url ?>media/images/facts_button_back2_f2.jpg','<?php echo $this->url ?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_back1" src="<?php echo $this->url ?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt=""></a></p>
                            */ ?>
                        </div>
                <?php } ?>
                <div class="py-4">
                    <div class="row justify-content-md-center bg-blue text-white p-2 fw-bold">
                        <div class="col">Phone</div>
                        <div class="col">Mail</div>
                        <div class="col">Fax</div>
                    </div>
                    <div class="row justify-content-md-center fw-bold">
                        <div class="col py-0 bg-white d-flex align-items-center justify-content-center">630-515-0928</div>
                        <div class="col bg-transparent py-0">
                            <p class="mb-0">Facts4Me, Inc.</p>
                            <p class="fw-normal mb-0">P.O. Box 245 <br>
                                Westmont, IL 60559</p>
                        </div>
                        <div class="col py-0 bg-white d-flex align-items-center justify-content-center">630-515-0054</div>
                    </div>
                </div>
                <div class="fs-6 w-100 py-4">
                    <p class="p-0 m-0 text-start">
                        We take our commitment to provide accurate information very seriously.
                        If you would like to submit a correction, a change or an addition,
                        please email us and we will give it our immediate attention.</p>
                </div>
                <form class="py-3" name="email1" method="POST" action="<?php echo $this->url ?>contact">
                    <div class="row g-3 align-items-center">
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">Email *</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="email" type="text" value="<?php echo $this->email ?>" maxlength="50">
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">Name *</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="name" type="text" value="<?php echo $this->name ?>" maxlength="50">
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">School</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="school_name" type="text" value="<?php echo $this->school_name ?>" maxlength="100">
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">Address</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="addr1" type="text" value="<?php echo $this->addr1 ?>" maxlength="50">
                        </div>

                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold"></label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="addr2" type="text" value="<?php echo $this->addr2 ?>" maxlength="50">
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">City</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="city" type="text" value="<?php echo $this->city ?>" maxlength="50">
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">State/Province</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="state" type="text" value="<?php echo $this->state ?>" maxlength="50">
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">Postal Code</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="zip" type="text" value="<?php echo $this->zip ?>" maxlength="50">
                        </div>

                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">How did you <br>
                                find our site?</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input class="form-control rounded-0 border border-1" name="howfound" type="text" value="<?php echo $this->howfound ?>" maxlength="50">
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">Enter questionor<br>
                                message to send </label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <textarea class="form-control rounded-0 border border-1" name="cont_notes" type="text"><?php echo $this->cont_notes ?></textarea>
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">Key value</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <div><? echo $this->key_num; ?>
                            </div>
                        </div>
                        <div class="col-xl-5 col-sm-3 text-end">
                            <label class="col-form-label fw-bold">Enter value above *</label>
                        </div>
                        <div class="col-xl-3 col-sm-8 text-start ">
                            <input type="hidden" name=token value="<? echo $this->token; ?>">
                            <input type="hidden" name=ck_num value="<? echo $this->key_num; ?>">
                            <input required class="form-control rounded-0 border border-1" name="my_num" type="text" size="10" maxlength="10">
                        </div>
                        <p class="fs-6 text-center py-3">* required information</p>
                        <p class="text-center mb-5">
                            <input type="submit" value="Submit email or question" name="B1">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="reset" value="Reset" name="B2">
                        </p>

                        <p>
                    </div>
                </form>
                <?php echo $this->render('widgets.copy_right'); ?>
            </div>
        </div>
    </div>
</div>
</div>