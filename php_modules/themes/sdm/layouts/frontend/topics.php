<a name="top"></a>
<?php
if ($this->uid == "visitor") {
?>
    <div class="bg-white">
        <div class="row">
            <div class="col-xl-2 col-sm-2 col-4 py-2">
                <div align="center">
                    <a href="<?php echo  $this->url ?>" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_home_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                        <img name="facts_button_home" src="<?php echo  $this->url ?>media/images/facts_button_home.jpg" width="110" height="36" alt="">
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-sm-2 col-4 py-2 ">
                <div align="center">
                    <a href="<?php echo  $this->url ?>about_us" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_about','<?php echo  $this->url ?>media/images/facts_button_about_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_about','<?php echo  $this->url ?>media/images/facts_button_about_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_about_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                        <img name="facts_button_about" src="<?php echo  $this->url ?>media/images/facts_button_about.jpg" width="110" height="36" alt="">
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-sm-2 col-4  py-2 ">
                <div align="center">
                    <a href="<?php echo  $this->url ?>visitor" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_sub2','<?php echo  $this->url ?>media/images/facts_button_sub2_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_sub2','<?php echo  $this->url ?>media/images/facts_button_sub2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_sub2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                        <img name="facts_button_sub2" src="<?php echo  $this->url ?>media/images/facts_button_sub2.jpg" width="110" height="36" alt="">
                    </a>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6 col-12 py-2">
                <div align="right" class="pe-4">
                    <form name="search1" action="<?php echo  $this->url ?>topics" method="post">
                        <span class="fieldtitle">Search</span>
                        <input class="rounded-0 border border-1 h-40" type="text" name="s_term" length="20" maxlength="40">
                        <input class=" border h-40" type="submit" value="Go" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    if ($this->u_type == "view") {               // regular signed user
    ?>
        <div class="bg-white">
            <div class="row">
                <div class="col-xl-4 col-sm-4 col-2 py-2">
                    <div align="center">
                        <a href="<?php echo  $this->url ?>topics" onClick="MM_nbGroup('down','navbar1','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_home_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                            <img name="facts_button_home" src="<?php echo  $this->url ?>/media/images/facts_button_home.jpg" width="110" height="36" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-8 col-sm-8 col-12 py-2">
                    <div align="right" class="pe-4">
                        <form name="search1" action="<?php echo  $this->url ?>topics" method="post">
                            <span class="fieldtitle">Search</span>
                            <input class="rounded-0 border border-1 h-40" type="text" name="s_term" length="20" maxlength="40">
                            <input class=" border h-40" type="submit" value="Go" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {         //   admin or update user
    ?>
        <div class="bg-white">
            <div class="row">
                <div class="col-xl-2 col-sm-2 col-6 py-2">
                    <div align="center">
                        <a href="<?php echo  $this->url ?>topics" onClick="MM_nbGroup('down','navbar1','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_home','<?php echo  $this->url ?>media/images/facts_button_home_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_home_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                            <img class="" name="facts_button_home" src="<?php echo  $this->url ?>media/images/facts_button_home.jpg" width="110" height="36" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2 col-6 py-2 ">
                    <div align="center">
                        <a href="<?php echo  $this->url ?>about_us" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_about','<?php echo  $this->url ?>media/images/facts_button_about_f3.jpg',1);" onMouseOver="MM_nbGroup('over','facts_button_about','<?php echo  $this->url ?>media/images/facts_button_about_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_about_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                            <img class="" name="facts_button_about" src="<?php echo  $this->url ?>media/images/facts_button_about.jpg" width="110" height="36" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-8 col-sm-8 col-12 py-2">
                    <div align="right" class="pe-4">
                        <form name="search1" action="<?php echo  $this->url ?>topics" method="post">
                            <span class="fieldtitle">Search</span>
                            <input class="rounded-0 border border-1 h-40" type="text" name="s_term" length="20" maxlength="40">
                            <!--            <input type="IMAGE" value="go1" name="submit" src="<?php echo  $this->url ?>media/images/facts_button_go.jpg" border=0></form>  -->
                            <input type="submit" class=" border h-40" value="Go" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}

$file_name = PUBLIC_PATH . "media/images1/topic_" . $this->topic_id . "_text.jpg";
if (file_exists($file_name)) { ?>
    <div class="text-center pt-3">
        <img src="<?php $this->url ?>media/images1/topic_<?php echo  $this->topic_id ?>_text.jpg" alt="topic name text image">
    </div>
<?php } ?>

<div class="py-4">
    <div valign=top align=center class="row container-fluid mx-auto justify-content-center">
        <?php
        $sub_list = array();

        if ($this->s_term != "none") {
            // display search results
            if (strlen($this->s_term) < 2) {
                echo "<h3 class=hdrmain align=center>Search value (" . $this->s_term . ") is not valid.</h3>\n";
                $this->s_term = 'none';
            } else {
                if ($this->sub_ct == 0) {
                    if ($this->sub_ct == 0) {
                        echo "<h3 class=hdrmain align=center>No subjects found for requested search (" . $this->s_term . ").</h3>\n";
                        $this->sub_ct = -1;
                    }
                }
            }
        } elseif ($this->topic_id > "0") {
            // echo "<br>query: *$sql*\n";

            if (!$this->sub_list) {
                echo "<h3 class=hdrmain align=center>No subjects found for requested topic.</h3>\n";
            }
        } else {        // display initial topic page no data
            $this->sub_ct = 0;
        }

        // first time page load or parms specified
        if ($this->sub_ct == 0) {
            echo '<div><div align="center"><img src="' . $this->url . 'media/images/Dog_final_3.gif">';
        ?>
            <hr width="85%" class="border-black-2">
    </div>
</div>
<div class="row g-3 align-items-center">
    <div class="col-5 text-end">
        <label class="col-form-label fw-bold"><img class="img-fluid" src="<?php echo  $this->url ?>media/images/arrow.gif"></label>
    </div>
    <div class="col-7 text-start ">
        <label class="col-form-label fw-bold">
            <form name="search2" action="<?php echo  $this->url ?>topics" method="post">
                <span class="fieldtitle">Or search</span>
                <input class="rounded-0 border border-1 h-40" type="text" name="s_term" length="20" maxlength="40">
                <input class=" border h-40" type="submit" value="Go" name="submit">
            </form>
        </label>
    </div>
</div>
<?php
        } else {
            // **********************************************************
            if ($this->sub_ct > 0) {
                # print "<div border='0' width='95%' align=center>\n";
                $line_ct = 4;
                $row_ct = 0;
                $d_ct = 1;
                foreach ($this->sub_list as $row) {
                    $sub_active = $row['sub_active'];
                    if ($this->u_type == "admin" | $this->u_type == "update") {
                        $sub_active = "Y";
                    }
                    $line_ct++;
                    $name = $row['sub_name'];
                    $img_name = $row['sub_img'];
                    $sub_id = $row['sub_id'];
                    $file_name = PUBLIC_PATH . "media/images1/$img_name";
                    if (!file_exists($file_name)) {
                        $img_name = "default_100.jpg";
                    }
                    echo "<!-- Row $row_ct  item $line_ct img file $file_name  -->\n";

                    //  make ONLY first row work if visitor
                    $topic_link = "N";
                    $name1 = $name;
                    foreach ($this->topic_list as $temp2) {

                        if (strtoupper($temp2['topic_name']) == strtoupper($name1)) {
                            $topic_link = "Y";
                            $topic_num = $temp2['topic_id'];
                        }
                    }


                    if ($this->uid == "visitor") {
                        if ($d_ct < 3 && $this->s_term == "none") {
                            if ($topic_link == "Y") {
                                echo '<div valign="top" align="center"  class="col-3 py-2 "><a href="' . $this->url . 'topics?t=' . $topic_num . '" target="_self"><IMG SRC="' . $this->url . 'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0></a>' . "\n";
                                echo '<br><a href="' . $this->url . 'topics?t=' . $topic_num . '" target="_self">' . "\n";
                            } else {
                                echo '<div valign="top" align="center"  class="col-3 py-2 "><a href="' . $this->url . 'disp_subject?s_id=' . $sub_id . '" target="_top"><IMG SRC="' . $this->url . 'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0></a>' . "\n";
                                echo '<br><a href="' . $this->url . 'disp_subject?s_id=' . $sub_id . '" target="_top">' . "\n";
                            }
                            echo '<span class="thumblable">' . $name . '</span></a>' . "\n";
                            $d_ct++;
                        } else {
                            echo '<div valign="top" align="center"  class="col-3 py-2 "><IMG SRC="' . $this->url . 'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0>' . "\n";
                            echo '<br><span class="thumblable">' . $name . '</span>' . "\n";
                        }
                    } else {
                        if ($topic_link == "N") {
                            echo '<div valign="top" align="center" class="col-3 py-2 "><a href="' . $this->url . 'disp_subject?s_id=' . $sub_id . '" target="_top"><IMG SRC="' . $this->url . 'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0></a>' . "\n";
                            echo '<br><a href="' . $this->url . 'disp_subject?s_id=' . $sub_id . '" target="_top">' . "\n";
                        } else {
                            echo '<div valign="top" align="center"  class="col-3 py-2 "><a href="' . $this->url . 'topics?t=' . $topic_num . '" target="_self"><IMG SRC="' . $this->url . 'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0></a>' . "\n";
                            echo '<br><a href="' . $this->url . 'topics?t=' . $topic_num . '" target="_self">' . "\n";
                        }
                        echo '<span class="thumblable">' . $name . '</span></a>' . "\n";
                    }
                    echo '</div>' . "\n";
                }
            }     // end of foreach loop
        }
        // }

?>
<div class="fs-6 text-center py-4">
    <?php
    if ($this->s_term != "none") {
        echo 'Display of subjects based on search for "' . $this->s_term . '"';
    } else {
        if ($this->topic_id > 0) {
            echo 'Display of subjects in the "' . $this->topic_name . '" topic';
        }
    }
    ?>
</div>

<div>
    <div>
        <div align="center">
            <p class="links2">
                <?php
                if ($this->uid == "visitor") {
                    echo '<a class="mx-3 f-12 text-danger fw-bold " href="' . $this->url . '" target="_top">Home</a>';
                } else {
                    echo '<p class="mx-3 f-12 text-danger fw-bold"> Your subscription (' . $this->uid . ') will expire on ' . $this->expire_date . '</p>	';
                    echo '<a class="mx-3 f-12 text-danger fw-bold" href="' . $this->url . 'topics">Home</a>';
                }
                echo '<a class="mx-3 f-12 text-danger fw-bold" href="#top">Back To Top</a>';
                if ($this->u_type == "admin" | $this->u_type == "update") {
                    echo '<a class="mx-3 f-12 text-danger fw-bold" href="' . $this->url . 'admin" target="_blank">Update Information</a>' . "\n";
                }
                if ($this->uid != 'visitor') {
                    echo '<a class="mx-3 f-12 text-danger fw-bold" href="' . $this->url . 'logout" target="_blank">Log Off</a>' . "\n";
                }
                ?>
            </p>
            <?php echo $this->render('widgets.copy_right'); ?>
        </div>
    </div>
</div>
<?php
echo "</div></div></div>\n";
// **********************************************************
?>