<script language="JavaScript" type="text/JavaScript">
  function playSound( mysound )
    { 
        thisSound = document.getElementById(mysound);
        thisSound.Play();
    }
</script>
<div class="row h-100">
  <div class="col-05"></div>
  <div class="col-11">
    <div class="bg-white">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-4 col-md-4">
          <img class="img-fluid" src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50">
        </div>
        <div class="col-xl-8 col-lg-7 col-sm-7 col-md-7 py-2">
          <a href="javascript:history.go(-1)" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_back','<?php echo  $this->url ?>media/images/facts_button_back_f3.jpg',1);MM_callJS('history.go(-1)')" onMouseOver="MM_nbGroup('over','facts_button_back','<?php echo  $this->url ?>media/images/facts_button_back_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_back_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
            <img src="<?php echo  $this->url ?>media/images/facts_button_back.jpg" alt="" name="facts_button_back" width="110" height="36" border="0">
          </a>
        </div>
      </div>
    </div>
    <div class="bg-yellow ">
      <div class="h-100">
        <div class="row">
          <div class=" col" style="-ms-flex: 0 0 325px !important; flex: 0 0 325px !important;">
            <?php
            if ($this->sub_ct > 0) {
              $image_ct = 0;
              foreach ($this->sub_images as $row) {
                $image_ct++;
                $temp = "media/images2/" . $row['info_image'];
                $temp1 = "media/sound/" . $row['info_sound'];
                $sound_file = PUBLIC_PATH . $temp1;
                if (is_file($sound_file)) {
            ?>
                  <embed src="<? echo $this->url . "media/sound/" . $row['info_sound']; ?>" autostart=false width="0" height="0" id="sound_<? echo $image_ct; ?>" name="sound_<? echo $image_ct; ?>" enablejavascript="true"></embed>
                <?php
                }
                ?>
                <div class="text-center pt-4">
                  <div class="container-fluid pe-0">
                    <?php
                    ?>
                    <img name="subject_image_<? echo $image_ct; ?>" src="<? echo $this->url . $temp; ?>" alt="<? echo $row['info_text']; ?>" border="1" />
                  </div>
                  <div>
                    <?php
                    if (is_file($sound_file)) {
                    ?>
                      <div align="left" width="45" valign="top">
                        <a href="javascript:void(0);" onClick="playSound('sound_<? echo $image_ct; ?>');">
                          <img src="/common/sound_icon.gif" alt="sound" align="left" border="0" /></a>
                        <br>
                      </div>
                    <?php
                    } else {
                    ?>
                    <?php
                    }
                    ?>
                    <div class="capt3" valign="top">
                      <?php
                      if ($row['info_text'] != "None") {
                      ?>
                        <? echo $row['info_text']; ?><br>
                      <?php
                      } else {
                      ?>

                      <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
            <?php
              }
            }
            ?>
            <!--        </div></td></div>  -->
            <!--  end of images  -->
          </div>
          <div class="col px-2 mx-auto">
            <div>
              <div class="text-center py-2">
                <?php
                $temp = "/media/images1/" . $this->subject['sub_hdr_img'];
                $file_name = PUBLIC_PATH . $temp;
                if (file_exists($file_name)) {
                ?>
                  <img name="subject title image" src="<? echo $this->url . $temp; ?>" alt="<? echo $this->subject['sub_name']; ?>" />
                <?php
                } else {
                ?>
                  <strong>
                    <font size=+4><? echo $this->subject['sub_name']; ?></font>
                  </strong>
                <?php
                }
                ?>
              </div>
            </div>
            <?php
            if ($this->topics) {
            ?>
              <div>
                <div class="fw-bold container-fluid text-start px-3 py-3 lh-sm" style="font-size: 18px; font-family: Arial, Helvetica, sans-serif;">
                  Topic(s): &nbsp;
                  <?php
                  $t_ct = 0;
                  foreach ($this->topics as $row) {
                    if ($t_ct != 0) {
                      echo ", ";
                    }
                    $t_ct++;
                    echo $row['topic_name'];
                  }
                  ?>
                </div>
              </div>
            <?php
            }
            $t_color = "#F7F7C6";
            if ($this->sub_facts) {
            ?>
              <div class="container-fluid px-3">
                <div>
                  <div class="text-center">
                    <div class="pb-4">
                      <div class="bg-red">
                        <div>
                          <div class="titlerev fs-6 text-center py-2">Quick Facts</div>
                        </div>
                      </div>
                      <?php
                      foreach ($this->sub_facts as $row) {
                        //	echo "<br>&nbsp;<br>Line #: " .  __LINE__ . " - s_link_is: *" . $row['s_link_id'] . "*<br>\n";
                        if ($row['value']) {
                      ?>
                          <div style="line-height: 1.2; background-color:<? echo $t_color; ?>">
                            <div class="row">
                              <div class="fieldtitle col text-end py-2" style="-ms-flex: 0 0 130px !important; flex: 0 0 130px !important;"><? echo $row['name']; ?></div>
                              <?php
                              if ($row['s_link_id'] > 0) {
                              ?>
                                <div class="listcopy col text-start py-2 ps-4 d-flex align-items-center">
                                  <a href="<?php echo  $this->url ?>disp_subject?s_id=	<? echo $row['s_link_id']; ?>"><? echo $row['value']; ?></a>
                                </div>
                                <!-- </div> -->
                                <!-- </div> -->
                                <?php echo "</div></div>"; ?>
                              <?php
                              } else {
                              ?>
                                <div class="listcopy col text-start py-2 ps-4 d-flex align-items-center"><? echo $row['value']; ?></div>
                        <?php
                                echo "</div> </div>";
                              }
                              if ($t_color == "#F7F7C6") {
                                $t_color = "#FFFFFF";
                              } else {
                                $t_color = "#F7F7C6";
                              }
                            }
                          }
                        }
                        ?>


                        <div class="pt-4">
                          <style>
                            h3 {
                              font-family: 'Times New Roman', Times, serif;
                              font-size: 1.17em !important;
                              font-weight: bold;
                            }
                          </style>
                          <div class="text-start ">
                            <!--  start of text information  -->
                            <p class="copy3">
                              <?php
                              if (strpos($this->subject['sub_text'], "None") === false) {
                                $old_v = array("\n");
                                // $new_v = array("<br>");
                                $new_v = array("</p><p class=copy3>");
                                $render_sub_text = str_replace($old_v, $new_v, $this->subject['sub_text']);
                                echo   stripslashes($render_sub_text);
                              } else {
                                echo "&nbsp;";
                              }
                              ?>
                            </p>
                            <!--  end of text information  -->
                          </div>
                          <?php
                          if (strlen(trim($this->subject['sub_resource'])) > 4) {
                          ?>
                            <div class="text-start">
                              <span class="topic_lst">Resource information</span>
                              <!--  start of text information  -->
                              <p class="copy3">
                                <?php
                                $old_v = array("\n");
                                // $new_v = array("<br>");
                                $new_v = array("</p><p class=copy3>");
                                $render_sub_resource = str_replace($old_v, $new_v, $this->subject['sub_resource']);
                                echo stripslashes($render_sub_resource);
                                ?>
                                <!--  end of text information  -->
                              </p>
                            </div>
                          <?php
                          }
                          if (strlen(trim($this->subject['sub_citation'])) > 4) {
                          ?>
                            <div class="text-start">
                              <span class="topic_lst">Citation information</span>
                              <!--  start of Report citation information  -->
                              <p class="copy3">
                                <? echo   stripslashes($this->subject['sub_citation']); ?>
                                <!--  end of Report citation information  -->
                              </p>
                            </div>
                        </div>
                            </div>
                          </div>
                    </div>
                  <?php }
                  ?>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      <div class="col-05"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-05"></div>
    <div class="col-11 bg-yellow">
      <div class="links2 text-center py-4">
        <a class="mx-3 fs-7 text-danger fw-bold" href="javascript:history.go(-1)">Back To Previous</a>
        <a class="mx-3 fs-7 text-danger fw-bold" href="#top">Back To Top</a>
        <?php
        echo $this->render('widgets.copy_right')
        ?>
      </div>
    </div>
    <div class="col-05"></div>
  </div>