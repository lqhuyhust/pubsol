<?php
echo "<!-- start of ftr1 -->\n";
if ($this->flag == "form") { ?>
    <div>
        <div bgcolor="<?php echo  $this->ftr_bgcolor ?>"> </div>
    </div>
<?php } else { ?>
    <div>
        <div bgcolor="<?php echo  $this->ftr_bgcolor ?>"> </div>
    <?php } ?>
    <div align=center>
        <hr width="700">
    </div>
    <div align=center><span class="links2">
            <a class="mx-3  fw-bold text-danger" href="#f4m_top">Return to top of Page</a>
            <a class="mx-3  fw-bold text-danger" href="<?php echo  $this->url ?>">Return to Home Page</a>
            <a class="mx-3  fw-bold text-danger" href="javascript:history.back(-1)">Return to previous page</a>
            <a class="mx-3  fw-bold text-danger" href="<?php echo  $this->url ?>about_us">About Us</a>
            <?php
            if ($this->u_type == "admin" | $this->u_type == "update") { ?>
                <a class="mx-3  fw-bold text-danger" href="<?php echo  $this->url ?>/admin">Update Information</a>
                <?php if ($this->u_id > 1) { ?>
                    <a class="mx-3  fw-bold text-danger" href="<?php echo  $this->url ?>logout">Log out</a>
                <?php } else { ?>
                    <a class="mx-3  fw-bold text-danger" href="<?php echo  $this->url ?>login">Log in</a>
            <?php }
            } ?>
    </div>