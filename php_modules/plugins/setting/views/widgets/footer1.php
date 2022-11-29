<?php 
    echo "<!-- start of ftr1 -->\n";
    if ($this->flag == "form")
    {
        echo '<table><tr><td bgcolor="' . $this->ftr_bgcolor . '">' . "\n";
    }
    else
    {
        echo '<tr><td colspan=2  bgcolor="' . $this->ftr_bgcolor . '">' . "\n";
    }

    echo '<div align=center><hr width="700"></div>' . "\n";
    echo '<div align=center><span class="links2">' . "\n";
    echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="#f4m_top">Return to top of Page</a>' . "\n";
    echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$this->url.'">Return to Home Page</a>' . "\n";
    echo '&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1)">Return to previous page</a>' . "\n";
    echo '&nbsp;&nbsp;&nbsp;<a href="'. $this->url.'about_us">About Us</a>' . "\n";
    if ($this->u_type == "admin" | $this->u_type == "update")
    {
        echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.$this->url.'/admin">Update Information</a>' . "\n";
        if ($this->u_id > 1)
        {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'. $this->url.'logout">Log out</a>' . "\n";
        }
        else
        {
            echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="'. $this->url.'login">Log in</a>' . "\n";
        }
    }
    echo '<br>&nbsp;</div>' . "\n";
    echo '</td></tr></table>' . "\n";