<a name="top"></a>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<?php
if ($this->uid == "visitor")
{
?>
    <tr>
        <td width="60%" height="50" valign="middle" bgcolor="#FFFFFF" align="center">
            <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="40%" align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="33%" align="center">
                                    <a href="<?php echo $this->url?>" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_home','<?php echo $this->url?>media/images/facts_button_home_f3.jpg',1);" 
                                    onMouseOver="MM_nbGroup('over','facts_button_home','<?php echo $this->url?>media/images/facts_button_home_f2.jpg','<?php echo $this->url?>media/images/facts_button_home_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_home" src="<?php echo $this->url?>media/images/facts_button_home.jpg" width="110" height="36" border="0" alt=""></a>
                                </td>
                                <td width="33%" align="center">
                                    <a href="<?php echo  $this->url?>about_us" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_about','<?php echo $this->url?>media/images/facts_button_about_f3.jpg',1);"
                                    onMouseOver="MM_nbGroup('over','facts_button_about','<?php echo $this->url?>media/images/facts_button_about_f2.jpg','<?php echo $this->url?>media/images/facts_button_about_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_about" src="<?php echo $this->url?>media/images/facts_button_about.jpg" width="110" height="36" border="0" alt=""></a>
                                </td>
                                <td width="33%" align="center"><a href="<?php echo  $this->url?>visitor" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_sub2','<?php echo $this->url?>media/images/facts_button_sub2_f3.jpg',1);" 
                                onMouseOver="MM_nbGroup('over','facts_button_sub2','<?php echo $this->url?>media/images/facts_button_sub2_f2.jpg','<?php echo $this->url?>media/images/facts_button_sub2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_sub2" src="<?php echo $this->url?>media/images/facts_button_sub2.jpg" width="110" height="36" border="0" alt=""></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="60%" valign="middle" align="center">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td valign="middle" align="center">
                                <form name="search1" action="<?php echo $this->url?>topics" method="post">
                                <span class="fieldtitle">search</span> <input type="text" name="s_term" length="20" maxlength="40">
                                <input type="submit" value="go" name="submit"></form>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
<?php
}
else
{
    if ($this->u_type == "view")
    {               // regular signed user
    ?>
    <tr>
        <td width="60%" height="50" valign="middle" bgcolor="#FFFFFF" align="center">
            <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="40%" align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="50%" align="center"><a href="<?php echo $this->url?>topics" onClick="MM_nbGroup('down','navbar1','facts_button_home','<?php echo $this->url?>media/images/facts_button_home_f3.jpg',1);" 
                                onMouseOver="MM_nbGroup('over','facts_button_home','<?php echo $this->url?>media/images/facts_button_home_f2.jpg','<?php echo $this->url?>media/images/facts_button_home_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_home" src="<?php echo $this->url?>/media/images/facts_button_home.jpg" width="110" height="36" border="0" alt=""></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="60%" align="center">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr valign="middle">
                                <td valign="middle" align="center">
                                    <form name="search1" action="<?php echo $this->url?>topics" method="post">
                                    <span class="fieldtitle">search</span> <input type="text" name="s_term" length="20" maxlength="40">
                                    <input type="submit" value="go" name="submit"></form>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <?php
    }
    else
    {         //   admin or update user
    ?>
    <tr>
        <td width="60%" height="50" valign="middle" bgcolor="#FFFFFF" align="center">
            <table width="100%" height="50" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="40%" align="center">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="50%" align="center"><a href="<?php echo $this->url?>topics" onClick="MM_nbGroup('down','navbar1','facts_button_home','<?php echo $this->url?>media/images/facts_button_home_f3.jpg',1);" 
                                    onMouseOver="MM_nbGroup('over','facts_button_home','<?php echo $this->url?>media/images/facts_button_home_f2.jpg','<?php echo $this->url?>media/images/facts_button_home_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_home" src="<?php echo $this->url?>media/images/facts_button_home.jpg" width="110" height="36" border="0" alt=""></a>
                                </td>
                                <td width="50%" align="center"><a href="<?php echo  $this->url?>about_us" target="_top" onClick="MM_nbGroup('down','navbar1','facts_button_about','<?php echo $this->url?>media/images/facts_button_about_f3.jpg',1);"
                                    onMouseOver="MM_nbGroup('over','facts_button_about','<?php echo $this->url?>media/images/facts_button_about_f2.jpg','<?php echo $this->url?>media/images/facts_button_about_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
                                    <img name="facts_button_about" src="<?php echo $this->url?>media/images/facts_button_about.jpg" width="110" height="36" border="0" alt=""></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="60%" align="center">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr valign="middle">
                                <td valign="middle" align="center">
                                    <form name="search1" action="<?php echo $this->url?>topics" method="post">
                                    <span class="fieldtitle">search</span> <input type="text" name="s_term" length="20" maxlength="40">
                        <!--            <input type="IMAGE" value="go1" name="submit" src="<?php echo $this->url?>media/images/facts_button_go.jpg" border=0></form>  -->
                                    <input type="submit" value="go" name="submit"></form>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <?php
    }
}
echo "<tr><td height='10'>&nbsp;</td></tr>\n";
$file_name = PUBLIC_PATH. "media/images1/topic_" . $this->topic_id . "_text.jpg";
if (file_exists($file_name))
{
    echo '<tr><td align="center"><img src="'.$this->url.'media/images1/topic_' . $this->topic_id .'_text.jpg" alt="topic name text image" border="0"></td></tr>' . "\n";
    echo "<tr><td height='10'>&nbsp;</td></tr>\n";
}

echo "<tr><td valign=top align=center>\n";

$sub_list = array();

if ($this->s_term != "none")
{        
    // display search results
    if  (strlen($this->s_term) < 2)
    {
        echo "<h3 class=hdrmain align=center>Search value (". $this->s_term.") is not valid.</h3>\n";
        $this->s_term = 'none';
    }
    else
    {
		if ($this->sub_ct == 0)
        {
			if ($this->sub_ct == 0)
            {
                echo "<h3 class=hdrmain align=center>No subjects found for requested search (".$this->s_term .").</h3>\n";
                $this->sub_ct = -1;
            }
        }
    }
}
elseif ($this->topic_id > "0")
{       
    // echo "<br>query: *$sql*\n";

    if (!$this->sub_list)
    {
        echo "<h3 class=hdrmain align=center>No subjects found for requested topic.</h3>\n";
    }
}
else
{        // display initial topic page no data
    $this->sub_ct = 0;
}

// first time page load or parms specified
if ($this->sub_ct == 0)
{
    echo '<tr><td align="center"><img src="'. $this->url.'media/images/Dog_final_3.gif">';
?>
        <hr width="85%" noshade>
        </td>
      </tr>
    <tr>
      <td valign="top">
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td align="right" valign="middle"><img src="<?php echo  $this->url ?>media/images/arrow.gif" border="0"></td>
          <td align="left" valign="middle" align="center">
             <form name="search2" action="<?php echo $this->url?>topics" method="post">
             <span class="fieldtitle">or search</span> <input type="text" name="s_term" length="20" maxlength="40">
             <input type="submit" value="go" name="submit"></form></td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
<?php 
}
else
{
    // **********************************************************
    if ($this->sub_ct > 0)
    {
        $cell_width = "25%";
        # print "<table border='0' width='95%' align=center>\n";
        $line_ct = 4;
        $row_ct = 0;
        $d_ct = 1;
        foreach ($this->sub_list as $row)
        {
            $sub_active = $row['sub_active'];
            if ($this->u_type == "admin" | $this->u_type == "update")
            {
                $sub_active = "Y";
            }

            if ($sub_active == "Y")
            {
                if ($line_ct >= 4)
                {
                    if ($row_ct > 0)
                    {
                        echo "</tr>  <!-- 1 end current Row $row_ct  -->\n";
                        echo "<tr>  <!-- filler row --> <td>&nbsp; </td> <td>&nbsp; </td> <td>&nbsp; </td> </tr>\n";
                        echo "</table>\n";
                    }
                    $row_ct++;
                    $line_ct = 0;
                    echo "<table border='0' width='95%' align=center>\n";
                    echo "<tr>  <!-- Row $row_ct  -->\n";
                }
                $line_ct++;
                if ($row_ct > $old_row_ct)
                {
                    if ($old_last_row_ct == 0)
                    {
                        $cell_width = "25%";
                    }
                    elseif ($old_last_row_ct == 1)
                    {
                    $cell_width = "100%";
                    }
                    elseif ($old_last_row_ct == 2)
                    {
                    $cell_width = "50%";
                    }
                    elseif ($old_last_row_ct == 3)
                    {
                    $cell_width = "33%";
                    }
                }
                $name = $row['sub_name'];
                $img_name = $row['sub_img'];
                $sub_id = $row['sub_id'];
                $file_name = PUBLIC_PATH. "media/images1/$img_name";
                if (!file_exists($file_name))
                {
                    $img_name = "default_100.jpg";
                }
                echo "<!-- Row $row_ct  item $line_ct img file $file_name  -->\n";

                //  make ONLY first row work if visitor
                $topic_link = "N";
                $name1 = $name;
                foreach ($this->topic_list as $temp2)
                {
                    $temp = explode('~', $temp2);

                    if (strtoupper($temp[0]) == strtoupper($name1) )
                    {
                        $topic_link = "Y";
                        $topic_num = $temp[1];
                    }
                }


                if ($this->uid == "visitor")
                {
                    if ($d_ct < 3 && $this->s_term == "none")
                    {
                        if ($topic_link == "Y")
                        {
                            echo '<td valign="top" align="center" width="' . $cell_width . '"><a href="'. $this->url.'topics?t=' . $topic_num . '" target="_self"><IMG SRC="'.$this->url.'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0></a>' . "\n";
                            echo '<br><a href="'. $this->url .'topics?t=' . $topic_num . '" target="_self">' . "\n";
                        }
                        else
                        {
                            echo '<td valign="top" align="center" width="' . $cell_width . '"><a href="'. $this->url. 'disp_subject?s_id=' . $sub_id . '" target="_top"><IMG SRC="'.$this->url.'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0></a>' . "\n";
                            echo '<br><a href="'. $this->url .'disp_subject?s_id=' . $sub_id . '" target="_top">' . "\n";
                        }
                        echo '<span class="thumblable">' . $name . '</span></a>' . "\n";
                        $d_ct++;
                    }
                    else
                    {
                        echo '<td valign="top" align="center" width="' . $cell_width . '"><IMG SRC="'.$this->url.'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0>' . "\n";
                        echo '<br><span class="thumblable">' . $name . '</span>' ."\n";
                    }
                }
                else
                {
                    if ($topic_link == "N")
                    {
                        echo '<td valign="top" align="center" width="' . $cell_width . '"><a href="'. $this->url. 'disp_subject?s_id=' . $sub_id . '" target="_top"><IMG SRC="'.$this->url.'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0></a>' . "\n";
                        echo '<br><a href="'. $this->url. 'disp_subject?s_id=' . $sub_id . '" target="_top">' . "\n";
                    }   
                    else
                    {
                        echo '<td valign="top" align="center" width="' . $cell_width . '"><a href="'. $this->url.'topics?t=' . $topic_num . '" target="_self"><IMG SRC="'.$this->url.'media/images1/' . $img_name . '" ALT="' . $name . '" BORDER=0></a>' . "\n";
                        echo '<br><a href="'. $this->url.'topics?t=' . $topic_num . '" target="_self">' . "\n";
                    }
                    echo '<span class="thumblable">' . $name . '</span></a>' . "\n";
                }
                echo '</td>' . "\n";
            }
        }     // end of foreach loop
        echo "</tr>  <!-- end last Row $row_ct  --></table> \n";
    }
}

?>
        <p>&nbsp;</p>
        <table width="100%" border="0" cellspacing="0" cellpadding="10">
          <tr>
            <td align="center">
                <p class="copy2">
<?php
if ($this->s_term != "none")
  {
  echo 'Display of subjects based on search for "' . $this->s_term . '"';
  }
else
  {
  if ($this->topic_id > 0)
    {
    echo 'Display of subjects in the "' . $this->topic_name . '" topic';
    }
  }
?>
              </p>
            </td>
          </tr>
        </table>
        <p>&nbsp;</p>

        <table width="100%" border="0" cellspacing="0" cellpadding="10">
          <tr>
            <td align="center">
                <p class="links2">
<?php
if ($this->uid == "visitor")
  {
  echo '<a href="'.$this->url.'" target="_top">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
  }
else
  {
	echo "Your subscription (".$this->uid. ") will expire on " . $this->expire_date. "<br>	";
    echo '<a href="'.$this->url.'topics">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
  }
echo '<a href="#top">&nbsp;Back To Top</a>';
if ($this->u_type == "admin" | $this->u_type == "update")
  {
  echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'. $this->url.'maint" target="_blank">Update Information</a>' . "\n";
  }
if ($this->uid != 'visitor')
{
    echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'. $this->url.'logout" target="_blank">Log Off</a>' . "\n";
}
?>
                </p>
                <?php echo $this->render('widgets.copy_right');?>
              
            </td>
          </tr>
        </table>
<?php
echo "</td></tr></table>\n";
      // **********************************************************
?>