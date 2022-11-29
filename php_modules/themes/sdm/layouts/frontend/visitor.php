<?php echo $this->render('widgets.topics'); ?>
<div class="w-100">
    <div class="row">
        <div class="col-xl-7 col-sm-12">
            <div class="bg-white">
                <?php echo $this->render('widgets.header_menu'); ?>
            </div>
            <div class="container-fluid m-0 p-4">
                <div class="fieldtitle py-5 text-center">
                    <img class="img-fluid" src="<?php echo  $this->url ?>media/images/facts_welcome_hdr.jpg">
                </div>
                <div class="copy1 text-start">
                    <div class="lh-base">
                        Welcome! The <b>topics</b> we have developed so far are listed at the left.
                        Each topic has between 8 and 50 <b>subjects</b>. More topics and subjects will be added as
                        we continue to expand this site. We welcome your suggestions for additional topics and subjects.
                        <p class="p-0"><br></p>
                        
                        <b>Take a tour!</b> As a visitor, you may view the contents of the first two subjects of each topic.
                        You will see the other subject titles,
                        but you will not have access to their content until you subscribe.
                    </div>
                </div>
                <div class="py-5" align="center">
                    <div class="">
                        <div class="row justify-content-md-center w-75">
                            <div class="col">
                                <div class="text-center">
                                    <a href="<?php echo  $this->url ?>facts_users" target="_top" onClick="MM_nbGroup('down','facts_button_sample','<?php echo  $this->url ?>media/images/facts_button_sample_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_sample','<?php echo  $this->url ?>media/images/facts_button_sample_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_sample_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        <img class="img-fluid" name="facts_button_sample" src="<?php echo  $this->url ?>media/images/facts_button_sample.jpg" width="110" height="56" border="0" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-center">
                                    <a href="#sub" target="_top" onClick="MM_nbGroup('down','facts_button_sub0','<?php echo  $this->url ?>media/images/facts_button_sub1_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_sub0','<?php echo  $this->url ?>media/images/facts_button_sub1_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_sub1_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        <img class="img-fluid" name="facts_button_sub0" src="<?php echo  $this->url ?>media/images/facts_button_sub1.jpg" width="110" height="56" border="0" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-center">
                                    <a href="#renew" target="_top" onClick="MM_nbGroup('down','facts_button_renew1a','<?php echo  $this->url ?>media/images/facts_button_renew2_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_renew1a','<?php echo  $this->url ?>media/images/facts_button_renew2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_renew2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        <img class="img-fluid" name="facts_button_renew1a" src="<?php echo  $this->url ?>media/images/facts_button_renew2.jpg" width="110" height="56" border="0" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-5">
                    <div class="bg-red">
                        <div>
                            <a name="sub"></a>
                            <div class="text-light fw-bold p-2 fs-5 text-center">New Subscription Options</div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-sm-3 text-start">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Basic School Hours Subscription</p>
                                    <p class="fs-7 fw-bold">$50 a year<br>
                                        <span class="fw-normal f-11">US Dollars</span>
                                    </p>
                                    <p class="links2 ml-7">
                                        <a href="<?php echo  $this->url ?>subscription?s_type=school" target="_top" onClick="MM_nbGroup('down','facts_button_sub1b','<?php echo  $this->url ?>media/images/facts_button_sub1_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_sub1b','<?php echo  $this->url ?>media/images/facts_button_sub1_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_sub1_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                            <img class="img-fluid" name="facts_button_sub1b" src="<?php echo  $this->url ?>media/images/facts_button_sub1.jpg" width="110" height="56" alt="">
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                                <p> A Basic School Hours Subscription provides access for <strong>all students and staff in one school building</strong> during a limited time. The activation time is <strong>8:00 a.m. to 5:00 p.m.</strong>, your local time, <strong>Monday through Friday, for 12 months.</strong> The Username and Password may be shared with students and staff. If requested, the activation time may be adjusted to meet the needs of your school.</p>
                                <p><strong>Subscribe online (MasterCard, Visa)</strong>: Click on the subscribe button and complete the requested information. You will need to enter a preferred Username and preferred Password. A minimum of 3 letters or a combination of 3 letters/numbers is required for each. An email will be sent to you confirming your Username and Password. If, at any time, you wish to change your Username and/or Password, you will need to contact Facts4Me by phone or email. </p>
                                <p><strong>Subscribe offline (Purchase Order, MasterCard, Visa, Check)</strong>: Download the following pdf: <a href="/info/School_Subscription_Form.pdf" class="color-red fw-bold">School Subscription Form</a>.&nbsp;
                                    Fill in all the requested information including the method of payment. Return the completed form via fax, email, or mail. Fax number is 630-515-0054; Email address is <a href="mailto:smorgan@facts4me.com" class="color-red">smorgan@facts4me.com</a>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="row">
                            <div class="col-sm-3 text-start">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Extended School Hours Subscription</p>
                                    <p class="fs-7 fw-bold">$150 a year<br>
                                        <span class="fw-normal f-11">US Dollars</span>
                                    </p>
                                    <p class="links2 ml-7">
                                        <a href="<?php echo  $this->url ?>subscription?s_type=extended_school" target="_top" onClick="MM_nbGroup('down','facts_button_sub1a','<?php echo  $this->url ?>media/images/facts_button_sub1_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_sub1a','<?php echo  $this->url ?>media/images/facts_button_sub2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_sub2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                            <img class="img-fluid" name="facts_button_sub1a" src="<?php echo  $this->url ?>media/images/facts_button_sub2.jpg" width="110" height="56" alt="">
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                            <p>The Extended School Hours Subscription provides all students and staff from one school building unlimited access to Facts4Me. That means <strong>all students and staff have 24/7 access</strong> to Facts4Me while in school AND while off campus. The Extended School Hours Subscription provides staff from your school unlimited access including evenings, weekends and vacation times to Facts4Me for planning and research purposes. The Extended School Hours Subscription provides students from your school unlimited access to a safe and secure site to use at home.</p>
                            <p><strong>Subscribe online (MasterCard, Visa)</strong>: Click on the subscribe button and complete the requested information. You will need to enter a preferred Username and preferred Password. A minimum of 3 letters or a combination of 3 letters/numbers is required for each. An email will be sent to you confirming your Username and Password. If, at any time, you wish to change your Username and/or Password, you will need to contact Facts4Me by phone or email</p>
                            <p><strong>Subscribe offline (Purchase Order, MasterCard, Visa, Check)</strong>: Download the following pdf: <a href="/info/School_Subscription_Form.pdf" class="color-red fw-bold">School Subscription Form</a>.&nbsp;
                                    Fill in all the requested information including the method of payment. Return the completed form via fax, email, or mail. Fax number is 630-515-0054; Email address is <a href="mailto:smorgan@facts4me.com" class="color-red">smorgan@facts4me.com</a>.</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-sm-3 text-start">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Individual Teacher Subscription</p>
                                    <p class="fs-7 fw-bold">$20 a year<br>
                                        <span class="fw-normal f-11">US Dollars</span>
                                    </p>
                                    <p class="links2 ml-7">
                                        <a href="<?php echo  $this->url ?>subscription?s_type=teacher" target="_top" onClick="MM_nbGroup('down','facts_button_teach1a','<?php echo  $this->url ?>media/images/facts_button_sub1_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_teach1a','<?php echo  $this->url ?>media/images/facts_button_sub1_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_sub1_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                            <img class="img-fluid" name="facts_button_teach1a" src="<?php echo  $this->url ?>media/images/facts_button_sub1.jpg" width="110" height="56" alt="">
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                                <p>An Individual Teacher Subscription provides access (classroom and/or computer lab) for <strong>one</strong> teacher and <strong>one</strong> class in <strong>one</strong> school during normal school hours. The activation time is <strong>8:00 a.m. to 5:00 p.m</strong>., your local time, <strong>Monday through Friday,</strong> for 12 months. The Username and Password may be shared with <u>one class of students</u>.&nbsp;If requested, the activation time may be adjusted to meet the needs of your classroom. </p>
                                <p><strong>Subscribe online (MasterCard, Visa)</strong>: Click on the subscribe button and complete the requested information. You will need to enter a preferred Username and a preferred Password.&nbsp;A minimum of 3 letters or a combination of 3 letters/numbers is required for each.&nbsp;An email will be sent to you confirming your Username and Password. If, at any time, you wish to change your Username and/or Password, you will need to contact Facts4Me by phone or email. </p>
                                <p><strong>Subscribe offline (Purchase Order, MasterCard, Visa, Check)</strong>: Download the following pdf: <a href="/info/Individual_Teacher_Subscription_Form.pdf" class="color-red fw-bold">Individual Teacher Subscription Form</a>.&nbsp;
                                    Fill in all the requested information including the method of payment. Return the completed form via fax, email, or mail. Fax number is 630-515-0054; Email address is <a href="mailto:smorgan@facts4me.com" class="color-red">smorgan@facts4me.com</a>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="row">
                            <div class="col-sm-3 text-start">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Home/Family Subscription</p>
                                    <p class="fs-7 fw-bold">$20 a year<br>
                                        <span class="fw-normal f-11">US Dollars</span>
                                    </p>
                                    <p class="links2 ml-7">
                                        <a href="<?php echo  $this->url ?>subscription?s_type=home" target="_top" onClick="MM_nbGroup('down','Image44','facts_button_sub2c','<?php echo  $this->url ?>media/images/facts_button_sub2_f3.jpg',1);" onMouseOver="MM_nbGroup('over','Image44','<?php echo  $this->url ?>media/images/facts_button_sub2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_sub2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');"><img class="img-fluid" name="Image44" src="<?php echo  $this->url ?>media/images/facts_button_sub2.jpg" width="110" height="56" alt=""></a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                                <p>A Home/Family Subscription provides&nbsp;<strong>one</strong>&nbsp;family unlimited access for their family members. The web site is active&nbsp;<strong>24/7</strong>. The Username and Password are not to be shared outside the immediate family. Access to Facts4Me is for <strong>family members only</strong>.&nbsp;&nbsp;<u>Accessing the site at school is not permitted</u>.</p>
                                <p><strong>Subscribe (MasterCard or Visa required)</strong>: Click on the subscribe button and complete the requested information. You will need to enter a preferred Username and a preferred Password. A minimum of 3 letters or a combination of 3 letters/numbers is required for a valid Username.&nbsp; An email will be sent to you confirming your Username and Password. If, at any time, you wish to change your Username and/or Password, you will need to contact Facts4Me by phone or email. </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-sm-3 text-start">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Gift Subscription</p>
                                    <form name="userupd0" action="<?php echo $this->url . 'subscription'; ?>" method="post">
                                        <input type="hidden" name="s_gift" value="Yes">
                                        <select name="s_type" class="h30-w100 mb-3">
                                            <option class="fs-7" value="ERROR">Select Type</option>
                                            <option class="fs-7" value="teacher">Teacher $20.00</option>
                                            <option class="fs-7" value="home">Home $20.00</option>
                                        </select>
                                        <div class="ml-7">
                                            <input class="img-fluid" class="img-fluid" type="IMAGE" src="<?php echo  $this->url ?>media/images/facts_button_sub1.jpg" name="Image41" width="110" height="56" id="Image41" onClick="MM_nbGroup('down','Image41','facts_button_sub1b','<?php echo  $this->url ?>media/images/facts_button_sub1_f3.jpg',1);" onMouseOver="MM_nbGroup('over','Image41','<?php echo  $this->url ?>media/images/facts_button_sub1_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_sub1_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                                <p>A Gift Subscription is a wonderful way to support a student, a teacher or a school.</p>
                                <p><strong>For Individual Teacher Subscription</strong>: Select Type: Teacher. Click on the subscribe button and fill in the requested information. You will need to enter a preferred Username and a preferred Password. A minimum of 3 letters or a combination of 3 letters/numbers is required for each. The Username and Password will be sent to the recipient in an email message. The recipient may change the Username and Password by contacting Facts4Me by phone or email.</p>
                                <p><strong>For Home/Family Subscription</strong>: Select Type: Home. Click on the subscribe button and fill in the requested information. You will need to enter a preferred Username and a preferred Password. A minimum of 3 letters or a combination of 3 letters/numbers is required for each. The Username and Password will be sent to the recipient in an email message. The recipient may change the Username and Password by contacting Facts4Me by phone or email.</p>
                                <p><strong>For School Gift Subscriptions</strong>: </strong>Please donate directly to the school. Ask to have a school contact person fill in the needed subscription information as indicated in the Subscribe section above.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-5">
                    <div class="bg-orange">
                        <div>
                            <a name="renew"></a>
                            <div class="text-light fw-bold p-2 fs-5 text-center">Renewal Subscription Options</div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-sm-3 text-start">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Renew Basic School Hours Subscription</p>
                                    <p class="fs-7 fw-bold">$50 a year<br>
                                        <span class="fw-normal f-11">US Dollars</span>
                                    </p>
                                    <form name="userupd51" action="<?php echo $this->url; ?>renew" method="post">
                                        <span class="fw-normal f-11">Enter current login username:</span>
                                        <input class="h30-w100" name="renew_id" type="text" value="<? echo $this->c_userid; ?>">
                                        <input name="s_type" type="hidden" value="school">
                                        <input name="renew" type="hidden" value="renew">
                                        <div class="pt-3 ml-7">
                                            <input class="img-fluid" type="IMAGE" src="<?php echo  $this->url ?>media/images/facts_button_renew2.jpg" name="Image51" width="110" height="56" id="Image51" onClick="MM_nbGroup('down','navbar1','Image51','<?php echo  $this->url ?>media/images/facts_button_renew2_f3.jpg',1);" onMouseOver="MM_nbGroup('over','Image51','<?php echo  $this->url ?>media/images/facts_button_renew2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_renew2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                                <p>A Basic School Hours Subscription provides access for&nbsp;<strong>all students and staff in one school building</strong>&nbsp;during a limited time. The activation time is&nbsp;<strong>8:00 a.m. to 5:00 p.m</strong>., your local time,&nbsp;<strong>Monday through Friday,</strong>&nbsp;for <strong>12 months</strong>. The Username and Password may be shared with students and staff. If requested, the activation time may be adjusted to meet the needs of your school.</p>
                                <p><strong>Renew online (MasterCard, Visa)</strong>: &nbsp;If your subscription is still active or has recently expired (within the last six months), click on the renew button and complete the required information.&nbsp;Upon completion of your subscription, a confirmation email will be sent to the Contact Person. You will continue using your original Username and Password. If, at any time, you wish to change your Username and/or Password, you will need to contact Facts4Me by phone or email.</p>
                                <p><strong></strong><strong>Renew offline (Purchase Order, MasterCard, Visa, Check)</strong><strong>:</strong> Download the following pdf:&nbsp;<a href="/info/School_Subscription_Form.pdf" class="color-red fw-bold">School Subscription Form</a>.&nbsp;Fill in all the requested information including the method of payment. Return the completed form via fax, email, or mail. Fax number is 630-515-0054; Email address is <a href="mailto:smorgan@facts4me.com" class="color-red">smorgan@facts4me.com</a>. Mail address is Facts4Me, 720 Vandustrial Drive, Westmont, IL&nbsp; 60559.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white">
                        <div class="row">
                            <div class="col-sm-3 text-start ">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Renew Extended School Hours Subscription</p>
                                    <p class="fs-7 fw-bold">$150 a year<br>
                                        <span class="fw-normal f-11">US Dollars</span>
                                    </p>
                                    <form name="userupd51" action="<?php echo $this->url; ?>renew" method="post">
                                        <span class="fw-normal f-11">Enter current login username:</span>
                                        <input class="h30-w100" name="renew_id" type="text" value="<? echo $this->c_userid; ?>">
                                        <input name="s_type" type="hidden" value="extended_school">
                                        <input name="renew" type="hidden" value="renew">
                                        <div class="pt-3 ml-7">
                                            <input class="img-fluid" type="IMAGE" src="<?php echo  $this->url ?>media/images/facts_button_renew.jpg" name="Image51a" width="110" height="56" id="Image51a" onClick="MM_nbGroup('down','navbar1','Image51a','<?php echo  $this->url ?>media/images/facts_button_renew_f3.jpg',1);" onMouseOver="MM_nbGroup('over','Image51a','<?php echo  $this->url ?>media/images/facts_button_renew_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_renew_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                                <p>The Extended School Hours Subscription&nbsp;provides&nbsp;all students and staff&nbsp;from&nbsp;one&nbsp;school&nbsp;unlimited&nbsp;access to&nbsp;Facts4Me. That means <strong>all students and staff have&nbsp;24/7&nbsp;access</strong> to Facts4Me while in school AND while off campus. The&nbsp;Extended School Hours Subscription&nbsp;provides staff from your school unlimited access including evenings, weekends and vacation times to Facts4Me for planning and research purposes. The&nbsp;Extended School Hours Subscription&nbsp;provides students from your school unlimited access to a safe and secure site to use at home.</p>
                                <p><strong>Renew online (MasterCard, Visa)</strong>: If your subscription is still active or has recently expired (within the last six months), click on the renew button and complete the required information.&nbsp;Upon completion of your subscription, a confirmation email will be sent to the Contact Person. You will continue using your original Username and Password. If, at any time, you wish to change your Username and/or Password, you will need to contact Facts4Me by phone or email.</p>
                                <p><strong></strong><strong>Renew offline (Purchase Order, MasterCard, Visa, Check)</strong>: Download the following pdf:&nbsp;<a href="/info/School_Subscription_Form.pdf" class="color-red fw-bold">School Subscription Form</a>.&nbsp;Fill in all the requested information including the method of payment. Return the completed form via fax, email, or mail. Fax number is 630-515-0054; Email address is <a href="mailto:smorgan@facts4me.com" class="color-red">smorgan@facts4me.com</a>. Mail address is Facts4Me, 720 Vandustrial Drive, Westmont, IL&nbsp; 60559.</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="row">
                            <div class="col-sm-3 text-start">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Renew Individual Teacher Subscription</p>
                                    <p class="fs-7 fw-bold">$20 a year<br>
                                        <span class="fw-normal f-11">US Dollars</span>
                                    </p>
                                    <form name="userupd52" action="<?php echo $this->url; ?>renew" method="post">
                                        <span class="fw-normal f-11">Enter current login username:</span>
                                        <input class="h30-w100" name="renew_id" type="text" value="<? echo $this->c_userid; ?>">
                                        <input name="s_type" type="hidden" value="teacher">
                                        <input name="renew" type="hidden" value="renew">
                                        <div class="pt-3 ml-7">
                                            <input class="img-fluid" type="IMAGE" src="<?php echo  $this->url ?>media/images/facts_button_renew2.jpg" name="Image52" width="110" height="56" id="Image52" onClick="MM_nbGroup('down','navbar1','Image52','<?php echo  $this->url ?>media/images/facts_button_renew2_f3.jpg',1);" onMouseOver="MM_nbGroup('over','Image52','<?php echo  $this->url ?>media/images/facts_button_renew2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_renew2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                                <p>An Individual Teacher Subscription provides access (classroom and/or computer lab) for&nbsp;<strong>one</strong>&nbsp;teacher and <strong>one</strong>&nbsp;class in&nbsp;<strong>one</strong>&nbsp;school building during normal school hours. The activation time is&nbsp;<strong>8:00 a.m. to 5:00 p.m</strong>., your local time,&nbsp;<strong>Monday through Friday,</strong>&nbsp;for <strong>12 months</strong>. The Username and Password may be shared with <u>one class of students</u>.&nbsp;If requested, the activation time may be adjusted to meet the needs of your classroom.</p>
                                <p><strong>Renew online (MasterCard, Visa)</strong>: If your subscription is still active or has recently expired (within the last six months), click on the renew button and complete the required information.&nbsp;Upon completion of your subscription, a confirmation email will be sent you. You will continue using your original Username and Password. If, at any time, you wish to change your Username and/or Password, you will need to contact Facts4Me by phone or email.</p>
                                <p><strong>Subscribe offline (Purchase Order, MasterCard, Visa, Check)</strong>: Download the following pdf:&nbsp;<a href="/info/Individual_Teacher_Subscription_Form.pdf" class="color-red fw-bold">Individual Teacher Subscription Form</a>.&nbsp;Fill in all the requested information including the method of payment. Return the completed form via fax, email, or mail. Fax number is 630-515-0054; Email address is <a href="mailto:smorgan@facts4me.com" class="color-red">smorgan@facts4me.com</a>. Mail address is Facts4Me, 720 Vandustrial Drive, Westmont, IL&nbsp; 60559. </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="row">
                            <div class="col-sm-3 text-start ">
                                <div class="container-fluid p-2">
                                    <p class="test fs-6 fw-bold font">Renew Home/Family Subscription</p>
                                    <p class="fs-7 fw-bold">$20 a year<br>
                                        <span class="fw-normal f-11">US Dollars</span>
                                    </p>
                                    <form name="userupd53" action="<?php echo $this->url; ?>renew" method="post">
                                        <span class="fw-normal f-11">Enter current login username:</span>
                                        <input class="h30-w100" name="renew_id" type="text" value="<? echo $this->c_userid; ?>">
                                        <input name="s_type" type="hidden" value="home">
                                        <input name="renew" type="hidden" value="renew">
                                        <div class="pt-3 ml-7">
                                            <input class="img-fluid" type="IMAGE" src="<?php echo  $this->url ?>media/images/facts_button_renew.jpg" name="Image53" width="110" height="56" id="Image53" onClick="MM_nbGroup('down','navbar1','Image53','<?php echo  $this->url ?>media/images/facts_button_renew_f3.jpg',1);" onMouseOver="MM_nbGroup('over','Image53','<?php echo  $this->url ?>media/images/facts_button_renew_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_renew_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-9 text-start fs-7 lh-base p-2">
                                <p>A Home/Family Subscription provides&nbsp;<strong>one</strong>&nbsp;family unlimited access for their family members. The web site is active&nbsp;<strong>24/7</strong>. The Username and Password are not to be shared outside the immediate family. Access to Facts4Me is for <strong>family members only</strong>.&nbsp;&nbsp;<u>Accessing the site at school is not permitted</u>.</p>
                                <p><strong>Renew online (MasterCard or Visa required):</strong> &nbsp;If your subscription is still active or has recently expired (within the last six months), click on the renew button and complete the required information.&nbsp;Upon completion of your subscription, a confirmation email will be sent. You will continue using your original Username and Password. If, at any time, you wish to change your Username and/or Password, you will need to contact Facts4Me by phone or email.</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div align="center" class="links2 ml-7 pt-5">
                            <div>
                                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>visitor">Visitor</a>
                                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>login">Log-In</a>
                                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>about_us">About Us</a>
                                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>contact">Contact Us</a>
                                <a class="mx-3 fw-bold text-danger" href="<?php echo  $this->url ?>tell_friend">Tell A Friend</a>
                            </div>
                            <div class="py-4">
                                <?php echo $this->render('widgets.copy_right'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>