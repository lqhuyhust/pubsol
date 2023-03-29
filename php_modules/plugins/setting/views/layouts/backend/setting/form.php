<?php echo $this->render('notification', []); ?>
<div class="container-fluid align-items-center row justify-content-center mx-auto ">
    <?php
    ?>
    <form enctype='multipart/form-data' action="<?php echo  $this->link_form ?>" method="POST">
        <?php foreach ($this->legends as $index => $legend) { ?>
            <?php echo $index == 0 ? '' : '<hr class="mb-4 mt-4">';?>
            <h3 class="h3 mb-2 fw-bolder"><?php echo $legend['label']; ?></h3>
            <?php foreach($legend['fields'] as $value) { ?>
                <div class="mb-3 col-lg-12 col-sm-12 mx-auto label-bold">
                    <?php $this->field($value); ?>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="row align-items-center">
            <div class="col-xl-12 col-sm-12 text-center ">
                <a href="<?php echo $this->link_form; ?>" class="btn btn-outline-secondary">Cancel</a>
                <a id="test_mail" class="btn btn-outline-secondary" type="button">Test SMTP Mail</a>
                <button type="submit" class="btn btn-outline-success">Save</button>
            </div>
        </div>
    </form>
    <?php
    //  } 
    ?>
</div>
<form id="form_mail_test" action="<?php echo $this->link_mail_test ?>" method="POST">
</form>
<script>
    $(document).ready(function() {
        $('#test_mail').click(function(){
            $("#form_mail_test").submit();
        });
        
    });
</script>