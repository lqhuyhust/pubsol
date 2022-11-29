<table width="200" border="0" cellpadding="0" cellspacing="0" bgcolor="#339933">
    <tr>
        <td height="50" valign="top" bgcolor="#FFFFFF">
            <div align="center">
                <img src="<?php echo  $this->url ?>media/images/facts_corner_hdr.jpg" width="185" height="50">
            </div>
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
                                <td width="25">&nbsp;</td>
                                <td class="links">
                                <?php
                                echo '<span class="links_topic">';
                                foreach($this->topic as $item)
                                {
                                    if ($item['topic_active'] == 'Y')
                                    {
                                    echo $item['topic_name']. "<br>\n";
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