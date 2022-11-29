<div class="row mh-100">
    <div class="col-05"></div>
    <div class="col-11">
        <div class="bg-white">
            <img src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50">
        </div>
        <div class="bg-yellow ">
            <div class="p-4">
                <p class="fs-2 fw-bold color-red text-center py-3">Facts 4 Me Subscription</p>
                <hr class="border-black-2">
            </div>
            <div class="h-100">
                <?php
                if ($this->err_flg != "OK") {
                    echo $this->render('widgets.err_msg');
                } else { ?>
                    <form name="userupd1" action="<?php echo  $this->url ?>payment" method="post">
                        <div>
                            <div class="container">
                                <input type="hidden" name="start_time" value="<?php echo  $this->start_time ?>">
                                <input type="hidden" name="end_time" value="<?php echo  $this->end_time ?>">

                                <div class=" text-center bg-blue mb-5">
                                    <p class="text-white fw-bold fs-5 py-2 mb-0">Subscription form for <?php echo $this->s_type1 ?> </p>
                                </div>

                                <input type="hidden" name="gift_name" value="None">
                                <input type="hidden" name="gift_email" value="None">

                                <div class=" text-center bg-blue">
                                    <p class="text-white fw-bold fs-5 py-2">User information</p>
                                </div>

                                <div class="row g-3 align-items-center py-3">
                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Email Address of User:</label>
                                        </div>
                                    <?php } elseif ($this->data['s_type'] == "teacher") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Teacher's Email Address:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Contact Person's Email Address:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="nu_email" value="<?php echo  $this->data['u_email'] ?>" maxlength="50">
                                    </div>

                                    <div class="col-xl-5 col-sm-5 text-end">
                                        <label class="col-form-label fw-bold p-0">Current Log-in Username:</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <label class="col-form-label p-0"><?php echo  $this->data['userid'] ?></label><input class="form-control rounded-0 border border-1" type="hidden" name="nuserid" value="<?php $this->data['userid'] ?> " maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Parent's First Name:</label>
                                        </div>
                                    <?php } elseif ($this->data['s_type'] == "teacher") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Teacher's First Name:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Contact Person's First Name:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="u_f_name" value="<?php echo  $this->data['u_f_name'] ?>" maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Parent's Last Name:</label>
                                        </div>
                                    <?php } elseif ($this->data['s_type'] == "teacher") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Teacher's Last Name:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Contact Person's Last Name:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="u_l_name" value="<?php echo  $this->data['u_l_name'] ?>" maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end"></div>
                                        <div class="col-xl-3 col-sm-7 text-start ">
                                            <input class="form-control rounded-0 border border-1" type="hidden" name="school_name" value="Family or Home School">
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Name of School:</label>
                                        </div>
                                        <div class="col-xl-3 col-sm-7 text-start ">
                                            <input class="form-control rounded-0 border border-1" type="text" name="school_name" value="<?php echo  $this->data['school_name'] ?>" maxlength="50">
                                        </div>
                                    <?php } ?>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Home Address:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">School Address:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="addr1" value="<?php echo  $this->data['addr1'] ?>" maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Home Address:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">School Address:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="addr2" value="<?php echo  $this->data['addr2'] ?>" maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">City:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">School City:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="city" value="<?php echo  $this->data['city'] ?>" maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">State:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">School State:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="state" value="<?php echo  $this->data['state'] ?>" maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Zip/Postal code:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">School Zip/Postal code:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="zip" value="<?php echo  $this->data['zip'] ?>" maxlength="50">
                                    </div>

                                    <div class="col-xl-5 col-sm-5 text-end">
                                        <label class="col-form-label fw-bold">Time Zone:</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-7 text-start">
                                        <select name="t_zone" class="w-100">
                                            <?php foreach ($this->tz_list as $temp1) {
                                                $temp = explode('~', $temp1);
                                                $tz_code = $temp[0];
                                                $tz_name = $temp[1];
                                                if ($this->data['time_zone'] == $temp[0]) { ?>
                                                    <option value="<?php echo  $temp[0] ?>" SELECTED><?php echo  $temp[1] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo  $temp[0] ?>"><?php echo  $temp[1] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>

                                    <div class="col-xl-5 col-sm-5 text-end">
                                        <label class="col-form-label fw-bold">Country:</label>
                                    </div>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="country" value="<?php echo  $this->data['country'] ?>" maxlength="50">
                                    </div>


                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Home Phone number:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">School Phone number:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="phone" value="<?php echo  $this->data['phone'] ?>" maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "home") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Grade Levels of Children:</label>
                                        </div>
                                    <?php } elseif ($this->data['s_type'] == "teacher") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Grade Levels/Specialty:</label>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Grade Levels:</label>
                                        </div>
                                    <?php } ?>
                                    <div class="col-xl-3 col-sm-7 text-start ">
                                        <input class="form-control rounded-0 border border-1" type="text" name="grade_level" value="<?php echo  $this->data['grade_level'] ?>" maxlength="50">
                                    </div>

                                    <?php if ($this->data['s_type'] == "school" || $this->data['s_type'] == "extended_school") { ?>
                                        <div class="col-xl-5 col-sm-5 text-end">
                                            <label class="col-form-label fw-bold">Number of Teachers covered:</label>
                                        </div>
                                        <div class="col-xl-3 col-sm-7 text-start ">
                                            <input class="form-control rounded-0 border border-1" type="text" name="t_count" value="<?php echo  $this->data['t_count'] ?>" maxlength="5">
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-xl-5 col-sm-5 text-end"></div>
                                        <div class="col-xl-3 col-sm-7 text-start ">
                                            <input type="hidden" name="t_count" value="1">
                                        </div>
                                    <?php } ?>

                                    <div class="col-xl-5 col-sm-5 text-end pt-3">
                                        <input type="checkbox" name="terms"></input>
                                    </div>
                                    <div class="col-xl-3 col-sm-7 text-start pt-3">
                                        <label class="fw-bold">I have read the <a href="<?php echo  $this->url ?>terms" target="_blank" class="color-red">terms</a> and accept them.
                                    </div>

                                    <div>
                                        <div>
                                            <p>
                                                <input type="hidden" name=s_type value="<?php echo  $this->data['s_type'] ?>">
                                                <input type="hidden" name="start_date" value="<?php echo  $this->data['start_date'] ?>">
                                                <input type="hidden" name="payment_date" value="<?php echo  $this->data['payment_date'] ?>">
                                                <input type="hidden" name="expire_date" value="<?php echo  $this->data['expire_date'] ?>">
                                                <input type="hidden" name="u_psw" value="<?php echo  $this->data['psw'] ?>">
                                                <input type="hidden" name="nu_type" value="view">
                                                <input type="hidden" name="nu_id" value="<?php echo  $this->data['u_id'] ?>">
                                                <input type="hidden" name="nu_id1" value="<?php echo  $this->data['u_id'] ?>">
                                                <input type="hidden" name="nuserid" value="<?php echo  $this->data['userid'] ?>">
                                                <input type="hidden" name="renew" value="Y">
                                                <input type="hidden" name="s_type" value="<?php echo  $this->data['s_type'] ?>">
                                            </p>
                                            <div class="text-center">
                                                <div class="links2 row justify-content-evenly">
                                                    <div class="col-1">
                                                        <a href="javascript:history.back()" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                                            <img name="facts_button_back1" src="<?php echo  $this->url ?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="col-1">
                                                        <input type="IMAGE" src="<?php echo  $this->url ?>media/images/facts_button_continue2.jpg" name="Image41" width="110" height="36" border="0" id="Image41" onClick="MM_nbGroup('down','navbar1','Image41','<?php echo  $this->url ?>media/images/facts_button_continue2_f3.jpg',1);" onMouseOver="MM_nbGroup('over','Image41','<?php echo  $this->url ?>media/images/facts_button_continue2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_continue2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo $this->render('widgets.footer1'); ?>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-05"></div>
</div>