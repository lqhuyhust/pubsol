<table width="200" border="0" cellpadding="0" cellspacing="0" bgcolor="#339933">
    <tr height="50">
        <td align="center" valign="top" bgcolor="#FFFFFF">
        <p>
            <img src="<?php echo $this->url?>media/images/facts_corner_hdr.jpg" width="185" height="50" align="top">
        </td>
    </tr>
    <tr>
        <td valign="top"> 
            <table width="200" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="200" border="0" cellspacing="0" class="linkshdr">
                            <tr>
                                <td class="linkshdr">Our Topics:</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="200" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="25">&nbsp;
                                </td>
                                <td class="links">
                                <?php
                                echo '<span class="links_topic">';
                                foreach($this->topic as $item)
                                {
                                    if ($item['topic_active'] == 'Y')
                                    {
                                        if ($this->user_type == 'admin')
                                        {
                                            echo '<a href="'. $this->url. 'topics?t=' . $item['topic_id'] . '" target="mainFrame">' . $item['topic_name'] . "</a> <font size='+1' color='red'><b>*</b></font><br>\n";
                                        }
                                        else
                                        {
                                             echo '<a style="color: white;" href="'. $this->url. 'topics?t=' . $item['topic_id'] . '" target="mainFrame">' . $item['topic_name'] . "</a><br>\n";
                                        }
                                    }
                                }
                                ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>      
            <p>&nbsp;</p>
            <p class="links">&nbsp;</p>      
        </td>
    </tr>
</table>