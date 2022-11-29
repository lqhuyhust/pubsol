<!-- <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <div align="center" class=" navbar-brand">
            <img class="img-fluid" src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50">
        </div>
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ">
                <li class="nav-item ">
                    <a href="<?php echo $this->url ?>" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_home_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                        <img class="img-fluid" name="facts_button_home" src="<?php echo  $this->url ?>media/images/facts_button_home.jpg" width="110" height="56" border="0" alt="">
                        <button type="button" name="facts_button_home" class="btn btn-danger fs-5">Home</button>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?php echo  $this->url ?>about_us" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_about','<?php echo  $this->url ?>media/images/facts_button_about_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_about','<?php echo  $this->url ?>media/images/facts_button_about_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_about_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                        <img class="img-fluid" name="facts_button_about" src="<?php echo  $this->url ?>media/images/facts_button_about.jpg" width="110" height="56" border="0" alt="">
                        <button type="button" name="facts_button_about" class="btn btn-white fs-5">About Us</button>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?php echo $this->url ?>terms" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_terms','<?php echo  $this->url ?>media/images/facts_button_terms_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_terms','<?php echo  $this->url ?>media/images/facts_button_terms_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_terms_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                        <img class="img-fluid" name="facts_button_terms" src="<?php echo  $this->url ?>media/images/facts_button_terms.jpg" width="110" height="56" border="0" alt="">
                        <button type="button" name="facts_button_terms" class="btn btn-success fs-5">Term</button>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?php echo  $this->url ?>contact" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_contact','<?php echo  $this->url ?>media/images/facts_button_contact_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_contact','<?php echo  $this->url ?>media/images/facts_button_contact_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_contact_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                        <img class="img-fluid" name="facts_button_contact" src="<?php echo  $this->url ?>media/images/facts_button_contact.jpg" width="110" height="56" border="0" alt="">
                        <button type="button" name="facts_button_contact" class="btn btn-white fs-5">Contact</button>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="<?php echo  $this->url ?>tell_friend" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_tell','<?php echo  $this->url ?>media/images/facts_button_tell_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_tell','<?php echo  $this->url ?>media/images/facts_button_tell_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_tell_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                        <img class="img-fluid" name="facts_button_tell" src="<?php echo  $this->url ?>media/images/facts_button_tell.jpg" width="110" height="56" border="0" alt="">
                        <button type="button" name="facts_button_tell" class="btn btn-white fs-5">Tell A Friend</button>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a href="<?php echo  $this->url ?>visitor" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_visitor','<?php echo  $this->url ?>media/images/facts_button_visitor_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_visitor','<?php echo  $this->url ?>media/images/facts_button_visitor_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_visitor_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                    <img class="img-fluid" name="facts_button_visitor" src="<?php echo  $this->url ?>media/images/facts_button_visitor.jpg" width="110" height="56" alt=""></a><a href="javascript:;" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_visitor','<?php echo  $this->url ?>media/images/facts_button_visitor_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_visitor','<?php echo  $this->url ?>media/images/facts_button_visitor_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_visitor_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                    <button type="button" name="facts_button_visitor" class="btn btn-white fs-5">Visitor</button>
                    </a>
                    <a class="nav-link dropdown-toggle fs-5 text-dark" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Visitor
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Visitor</a></li>
                        <li><a class="dropdown-item" href="#">Subscribe</a></li>
                        <li><a class="dropdown-item" href="#">Renew</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> -->
<div class="row ">
    <div class="col py-2 ">
        <div align="center">
            <a href="<?php echo $this->url ?>" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_home_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                <img class="img-fluid" name="facts_button_home" src="<?php echo  $this->url ?>media/images/facts_button_home.jpg" width="110" height="56" border="0" alt="">
            </a>
        </div>
    </div>
    <div class="col py-2">
        <div align="center">
            <a href="<?php echo  $this->url ?>about_us" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_about','<?php echo  $this->url ?>media/images/facts_button_about_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_about','<?php echo  $this->url ?>media/images/facts_button_about_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_about_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                <img class="img-fluid" name="facts_button_about" src="<?php echo  $this->url ?>media/images/facts_button_about.jpg" width="110" height="56" border="0" alt="">
            </a>
        </div>
    </div>

    <div class="col py-2">
        <div align="center">
            <a href="<?php echo $this->url ?>terms" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_terms','<?php echo  $this->url ?>media/images/facts_button_terms_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_terms','<?php echo  $this->url ?>media/images/facts_button_terms_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_terms_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                <img class="img-fluid" name="facts_button_terms" src="<?php echo  $this->url ?>media/images/facts_button_terms.jpg" width="110" height="56" border="0" alt="">
            </a>
        </div>
    </div>
    <div class="col py-2">
        <div align="center">
            <a href="<?php echo  $this->url ?>contact" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_contact','<?php echo  $this->url ?>media/images/facts_button_contact_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_contact','<?php echo  $this->url ?>media/images/facts_button_contact_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_contact_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                <img class="img-fluid" name="facts_button_contact" src="<?php echo  $this->url ?>media/images/facts_button_contact.jpg" width="110" height="56" border="0" alt="">
            </a>
        </div>
    </div>
    <div class="col py-2 px-0">
        <div align="center">
            <a href="<?php echo  $this->url ?>tell_friend" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_tell','<?php echo  $this->url ?>media/images/facts_button_tell_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_tell','<?php echo  $this->url ?>media/images/facts_button_tell_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_tell_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                <img class="img-fluid" name="facts_button_tell" src="<?php echo  $this->url ?>media/images/facts_button_tell.jpg" width="110" height="56" border="0" alt="">
            </a>
        </div>
    </div>
</div>