<?php echo $this->render('widgets.topics'); ?>
<div class="w-100">
    <div class="bg-white">
        <?php echo $this->render('widgets.header_menu'); ?>
    </div>
    <div class="container">
        <div class="fieldtitle py-5 text-center">
            <img class="img-fluid" src="<?php echo  $this->url ?>media/images/facts_welcome_hdr.jpg">
        </div>
        <div>
            <p class="fs-2 fw-bold color-red text-center">About Facts 4 Me</p>
            <hr class="border-black-2">
            <div class="fs-6 text-start pt-3 px-4">
                <?php echo $this->content ?> 
                <?php echo $this->render('widgets.copy_right'); ?>
            </div>
        </div>
    </div>
</div>
</div>