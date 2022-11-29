<script language="JavaScript" type="text/JavaScript"> 
    function playSound( mysound )
    { 
        thisSound = document.getElementById(mysound);
        thisSound.Play();
    }
</script>
<a name="top"> </a>
<table width="90%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#f7f7c6">
    <tr>
        <td valign="top">
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="50" valign="top" bgcolor="#FFFFFF">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="185" valign="top">
                                    <img src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50">
                                </td>
                                <td valign="top">
                                    <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="40%">
                                                <div align="center">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <div align="center"></div>                          
                                                                <div align="center">
                                                                    <a href="javascript:history.go(-1)" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_back','<?php echo  $this->url?>media/images/facts_button_back_f3.jpg',1);MM_callJS('history.go(-1)')" 
                                                                onMouseOver="MM_nbGroup('over','facts_button_back','<?php echo  $this->url?>media/images/facts_button_back_f2.jpg','<?php echo  $this->url?>media/images/facts_button_back_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                                                <img src="<?php echo  $this->url ?>media/images/facts_button_back.jpg" alt="" name="facts_button_back" width="110" height="36" border="0"></a></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                            <td width="60%">
                                                <div align="center">
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td valign="middle" class="fieldtitle" align="center">
                                                            &nbsp;
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="325" valign="top">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="10">
                                        <tr>
                                            <td valign="top align="center">
                                            <?php
		if ($this->sub_ct > 0)
        {
			$image_ct = 0;
            foreach ($this->sub_images as $row) 
            {
				$image_ct++;
				$temp = "media/images2/" . $row['info_image'];
				$temp1 = "media/sound/" . $row['info_sound'];
				$sound_file = PUBLIC_PATH. $temp1;
				if (is_file($sound_file))
					{
					?>
          <embed src="<? echo $this->url. "media/sound/" . $row['info_sound'];?>" autostart=false width="0" height="0" id="sound_<? echo $image_ct;?>" name="sound_<? echo $image_ct;?>" enablejavascript="true" ></embed>
          <?php
					}
				?>
        <table width="300" height="200" border="0" cellpadding="0" cellspacing="0">
        <tr><td align="center" colspan="2">
				<?php
				?>
				<img name="subject_image_<? echo $image_ct;?>" src="<? echo $this->url.$temp;?>" alt="<? echo $row['info_text'];?>" border="1" />
				</td>
        <tr>
				<?php
				if (is_file($sound_file))
					{
					?>
          <td align="left" width="45" valign="top">
 					<a href="javascript:void(0);" onClick="playSound('sound_<? echo $image_ct;?>');">
          <img src="/common/sound_icon.gif" alt="sound" align="left" border="0" /></a>
          <br>&nbsp;</td>
        <?php
					}
				else
					{
					?>
          &nbsp;
    	    <?php
					}
					?>
          <td align="center" class="capt3" valign="top">
        <?php
        if ($row['info_text'] != "None")
          {
					?>
          <? echo $row['info_text'];?><br>&nbsp;
  	      <?php
          }
        else
          {
					?>
          &nbsp;
	        <?php
          }
				?>	
        </td></tr>
				</table>
        <?php
				}
			}
        ?>
<!--        </table></td></tr>  -->
        <!--  end of images  -->
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="10">
              <tr>
        <!--  title name image  -->
                <td>
                <div align="center">
<?php
$temp = "/media/images1/" . $this->subject['sub_hdr_img'];
$file_name = PUBLIC_PATH . $temp;
if (file_exists($file_name))
  {
	?>
  <img name="subject title image" src="<? echo $this->url. $temp;?>" alt="<? echo $this->subject['sub_name'];?>" />
	<?php
  }
else
  {
	?>
  <strong><font size=+4><? echo $this->subject['sub_name'];?></font></strong>
	<?php
  }
?>

                  </div></td>
              </tr>

<?php
if ($this->topics)
{
?>
  <tr><td class="topic_lst">	
  Topic(s): &nbsp;
  <?php
  $t_ct = 0;
  foreach($this->topics as $row)
  {
    if ($t_ct != 0)	
      {
      echo ", ";
      }
    $t_ct++;
    echo $row['topic_name'];
  }
    ?>
  </td></tr>
<?php
}
$t_color = "#F7F7C6";
if ($this->sub_facts)
{
?>
              <tr>
                <td><div align="center">
                  <table width="100%" border="0" cellspacing="0" cellpadding="10">
                    <tr bgcolor="#CC0000">
                      <td colspan="2"><div align="center" class="titlerev">Quick Facts</div></td>
                      </tr>
<?php
  foreach( $this->sub_facts as $row)
  {
  //	echo "<br>&nbsp;<br>Line #: " .  __LINE__ . " - s_link_is: *" . $row['s_link_id'] . "*<br>\n";
  ?>
  <tr bgcolor="<? echo $t_color;?>">
  <td class="fieldtitle" align="right" width="110"><? echo $row['name'];?></td>
  <?php
  if ($row['s_link_id'] > 0)
    {
    ?>
    <td class="listcopy"><a href="<?php echo  $this->url?>disp_subject?s_id=	<? echo $row['s_link_id'];?>"><? echo $row['value'];?></a></td></tr>
    <?php
    }
  else
    {
    ?>
    <td class="listcopy"><? echo $row['value'];?></td></tr>
    <?php
    }
  if ($t_color == "#F7F7C6")
    {
    $t_color = "#FFFFFF";
    }
  else
    {
    $t_color = "#F7F7C6";
    }
  }
	?>
  </table></div></td></tr>
  <?php	
	}
?>
        <!--  end of  information table  -->
              <tr>
                <td><div align="left">
        <!--  start of text information  -->
                  <p class="copy3">
                  <?php
if ($this->subject['sub_text'] != "None")
	{
  $old_v = array("\n");
  // $new_v = array("<br>");
  $new_v = array("</p><p class=copy3>");
  $render_sub_text = str_replace($old_v, $new_v, $this->subject['sub_text']);
	echo 	stripslashes($render_sub_text);
	}
else
	{
	echo "&nbsp;";
	}
?>
</p>
        <!--  end of text information  -->
                </div></td>
              </tr>
             <?php
if (strlen(trim($this->subject['sub_resource'])) > 4 )
	{
	?>
  <tr>
    <td><div align="left">
    <span  class="topic_lst">Resource information</span>
<!--  start of text information  -->
      <p class="copy3">
      <?php
			$old_v = array("\n");
			// $new_v = array("<br>");
			$new_v = array("</p><p class=copy3>");
			$this->subject['sub_text'] = str_replace($old_v, $new_v, $this->subject['sub_resource']);
			echo 	stripslashes($this->subject['sub_resource']);
			?>
<!--  end of text information  -->
    </p></div></td>
  </tr>
	<?php
	}
if (strlen(trim($this->subject['sub_citation'])) > 4 )
	{
	?>
  <tr>
    <td><div align="left">
    <span  class="topic_lst">Citation information</span>
<!--  start of Report citation information  -->
      <p class="copy3">
      <?	echo 	stripslashes($this->subject['sub_citation']);?>
<!--  end of Report citation information  -->
    </p></div></td>
  </tr>
	<?php
	}
	?>
            </table></td>
          </tr>
        </table>
      </tr>
    </table>
    </td></tr>
<!--          <table width="100%" bgcolor="#f7f7c6" border="0" cellspacing="0" cellpadding="10">   -->
            <tr>
              <td><div align="center" class="links2">
         <a href="javascript:history.go(-1)">Back To Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <a href="#top">Back To Top</a>
               <?php
                echo $this->render('widgets.copy_right')
               ?>
                </div></td>
            </tr>
<!--          </table></td>   -->
  </tr>
</table>
