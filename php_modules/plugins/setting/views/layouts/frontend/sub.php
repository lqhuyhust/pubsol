<table width="90%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="f7f7c6">
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
                                                </div>
                                            </td>
                                            <td width="60%" valign="bottom">
                                                <div align="center">
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
                    <td align=center>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="top">
                                    <div align=center>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="20">
                                            <tr>
                                                <td>
                                                    <div align="center" class="hdrmain">
                                                        <p>Facts 4 Me Subscription</p>
                                                        <hr noshade>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <br>

<?php

if ($this->err_flg != "OK")
{
    echo $this->render('widgets.err_msg');
}
else
{
    echo '<form name="userupd1" action="'.$this->url.'payment" method="post">';
    echo "<table width='75%' border='0' align='center'>";
    
    echo '<input type="hidden" name="start_time" value="' . $this->start_time . '">';
    echo '<input type="hidden" name="end_time" value="' . $this->end_time . '">';

    echo "<tr valign=top><td colspan=3 align=center class='fieldtitle' height='70'>\n";
    echo '<table width="100%" border="0" cellpadding="10" cellspacing="0" bgcolor="004d91">';
    echo '<tr><td class="fieldtitle"><div align="center">';
    echo '<p class="titlerev">Subscription form for ' . $this->s_type1 . '</p>';
    echo "</div></td></tr></table>\n";
    echo "<td></tr>\n";

    if ($this->s_gift == "Yes")
    {
        echo "<tr><td width='49%' align='right' class='subbld' height='50'><b>Gift subscription given by: &nbsp; </b></td><td>&nbsp;</td>\n";
        echo '<td width="49%" align="left" height="50"><input type="text" name="gift_name" value="" size="40" maxlength="50"></td></tr>';
        echo "<tr><td width='49%' align='right' class='subbld' height='50'><b>Email of gift subscription giver: &nbsp; </b></td><td>&nbsp;</td>\n";
        echo '<td width="49%" align="left" height="50"><input type="text" name="gift_email" value="" size="40" maxlength="50"></td></tr>';
    }
    else
    {
        echo '<input type="hidden" name="gift_name" value="None">';
        echo '<input type="hidden" name="gift_email" value="None">';
    }

    echo "<tr valign=top><td colspan=3 align=center class='fieldtitle' height='70'>\n";
    echo '<table width="100%" border="0" cellpadding="10" cellspacing="0" bgcolor="004d91">';
    echo '<tr><td class="fieldtitle"><div align="center">';
    echo '<p class="titlerev">User information</p>';
    echo "</div></td></tr></table>\n";
    echo "<td></tr>\n";

    if ($this->s_type == "home")
    {
        echo "<tr><td width='49%' align='right' class='subbld' height='50'><b>Email Address of New User: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    elseif ($this->s_type == "teacher")
    {
        echo "<tr><td width='49%' align='right' class='subbld' height='50'><b>Teacher's Email Address: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td width='49%' align='right' class='subbld' height='50'><b>Contact Person's Email address: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td width="49%" align="left" height="50"><input type="text" name="nu_email" value="" size="40" maxlength="50"></td></tr>';
    echo "<tr><td align='right'><span  class='subbld'><b>Preferred Log-in Username: &nbsp; </b></span><br><span  class='capt2'>If your preferred username is not &nbsp; &nbsp; &nbsp;<br> available, your email address &nbsp; &nbsp; &nbsp;<br>will be assigned as your username. &nbsp; &nbsp; &nbsp;<br> &nbsp;</span></td><td>&nbsp;</td>\n";
    echo '<td align="left"><input type="text" name="nuserid" value="' . $this->data['nuserid'] . '" size="40" maxlength="50"></td></tr>' . "\n";
    echo "<tr><td align='right'><span  class='subbld'><b>Preferred User Password: &nbsp; </b></span><br><span  class='capt2'>A default random password  has &nbsp; &nbsp; &nbsp;<br>been created. You can change your &nbsp; &nbsp; &nbsp;<br>login password at this time if you like. &nbsp; &nbsp; &nbsp;</span></td><td>&nbsp;</td>\n";
    echo '<td align="left"><input type="text" name="u_psw" value="' . $this->psw . '" ></td></tr>' . "\n";

    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50' ><b>Parent's First Name: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    elseif ($this->s_type == "teacher")
    {
        echo "<tr><td align='right' class='subbld' height='50' ><b>Teacher's First Name: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50' ><b>Contact Person's First Name: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50" ><input type="text" name="u_f_name" value="' . $this->data['u_f_name'] . '" size="30" maxlength="50"></td></tr>' . "\n";


    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Parent's Last Name: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    elseif ($this->s_type == "teacher")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Teacher's Last Name: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Contact Person's Last Name: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50"><input type="text" name="u_l_name" value="' . $this->data['u_l_name'] . '" size="30" maxlength="50"></td></tr>' . "\n";

    if ($this->s_type == "home")
    {
        echo '<input type="hidden" name="school_name" value="Family or Home School">';
    }
    else
    {
        echo "<tr><td  align='right' class='subbld' height='50'><b>Name of School: &nbsp; </b></td><td>&nbsp;</td>\n";
        echo '<td align="left" height="50"><input type="text" name="school_name" value="' . $this->data['school_name'] . '" size="40" maxlength="50"></td></tr>' . "\n";
    }
    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Home Address: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>School Address: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50"><input type="text" name="addr1" value="' . $this->data['addr1'] . '" size="30" maxlength="50"></td></tr>' . "\n";
    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Home Address: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>School Address: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50"><input type="text" name="addr2" value="' . $this->data['addr2'] . '" size="30" maxlength="50"></td></tr>' . "\n";
    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>City: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>School City: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50"><input type="text" name="city" value="' . $this->data['city'] . '" size="30" maxlength="50"></td></tr>' . "\n";


    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>State: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>School State: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50"><input type="text" name="state" value="' . $this->data['state'] . '" size="20" maxlength="30"></td></tr>' . "\n";


    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Zip/Postal code: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>School Zip/Postal code: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50"><input type="text" name="zip" value="' . $this->data['zip'] . '" size="20" maxlength="20"></td></tr>' . "\n";


    echo "<tr><td align='right'><span class=subbld>Time Zone: &nbsp; </span></td><td>&nbsp;</td>\n";
    echo '<td align="left"><select name="t_zone">' . "\n";
    foreach ($this->tz_list as $temp1)
    {
        $temp = explode('~', $temp1);
        $tz_code = $temp[0];
        $tz_name = $temp[1];
        if ($t_zone == $temp[0])
        {
            echo '<option value="' . $temp[0] . '" SELECTED>' . $temp[1] . '</option>' . "\n";
        }
        else
        {
            echo '<option value="' . $temp[0] . '">' . $temp[1] . '</option>' . "\n";
        }
    }
    echo '</select></td></tr>' . "\n";


    echo "<tr><td align='right' class='subbld' height='50'><b>Country: &nbsp; </b></td><td>&nbsp;</td>\n";
    echo '<td align="left" height="50"><input type="text" name="country" value="' . $this->data['country'] . '" size="30" maxlength="50"></td></tr>' . "\n";


    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Home Phone number: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>School Phone number: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50"><input type="text" name="phone" value="' . $this->data['phone'] . '" size="15" maxlength="25"></td></tr>' . "\n";


    if ($this->s_type == "home")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Grade Levels of Children: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    elseif ($this->s_type == "teacher")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Grade Levels/Specialty: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    else
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Grade Levels: &nbsp; </b></td><td>&nbsp;</td>\n";
    }
    echo '<td align="left" height="50"><input type="text" name="grade_level" value="" size="20" maxlength="25"></td></tr>' . "\n";

    if ($this->s_type == "school" || $this->s_type == "extended_school")
    {
        echo "<tr><td align='right' class='subbld' height='50'><b>Number of Teachers covered: &nbsp; </b></td><td>&nbsp;</td>\n";
        echo '<td align="left"><input type="text" name="t_count" value="' . $this->data['t_count'] . '" size="4" maxlength="5"></td></tr>' . "\n";
    }
    else
    {
        echo '<input type="hidden" name="t_count" value="1">';
    }

    echo '<tr><td colspan="3" align="center" class="subbld" height="50"><input type="checkbox" name="terms"> &nbsp; I have read the <a href="'. $this->url.'terms" target="_blank">terms</a> and accept them.</td></tr>';

    echo "<tr><td colspan='3'><p>\n";
    echo '<input type="hidden" name="s_type" value="' . $this->s_type . '">';
    $t_date = $this->data['start_date'];
    echo '<input type="hidden" name="start_date" value="' . $t_date . '">'. "\n";


    echo '<input type="hidden" name="payment_date" value="' . $this->data['payment_date'] . '">';


    echo '<input type="hidden" name="expire_date" value="' . $this->data['expire_date'] . '">'. "\n";

    echo '<input type="hidden" name="nu_type" value="view">'. "\n";
    echo '<input type="hidden" name="nu_id" value="' . $this->data['nu_id'] . '">';
    echo '<input type="hidden" name="nu_id1" value="' . $this->data['nu_id1'] . '">';
    echo '<input type="hidden" name="s_type" value="' . $this->s_type . '">'. "\n";
?>

   <p class="links2" align="center"><a href="javascript:history.back()" onClick="MM_nbGroup('down','navbar1','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2.jpg',1);" 
    onMouseOver="MM_nbGroup('over','facts_button_back1','<?php echo  $this->url ?>media/images/facts_button_back2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_back2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">
    <img name="facts_button_back1" src="<?php echo  $this->url ?>media/images/facts_button_back2.jpg" width="110" height="36" border="0" alt=""></a>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;

<input type="IMAGE" src="<?php echo  $this->url ?>media/images/facts_button_continue2.jpg" name="Image41" width="110" height="36" border="0" id="Image41"
     onClick="MM_nbGroup('down','navbar1','Image41','<?php echo  $this->url ?>media/images/facts_button_continue2_f3.jpg',1);"
     onMouseOver="MM_nbGroup('over','Image41','<?php echo  $this->url ?>media/images/facts_button_continue2_f2.jpg','<?php echo  $this->url ?>media/images/facts_button_continue2_f4.jpg',1);" onMouseOut="MM_nbGroup('out');">

<?php

    echo "</p></td></tr></table>\n";
    echo "</form><br>\n";

    echo "</td></tr>";
    echo $this->render('widgets.footer1');
}
?>
</td></tr></table>