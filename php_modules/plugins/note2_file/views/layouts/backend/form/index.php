
<?php echo $this->renderWidget('core::notification'); ?>
<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <form enctype="multipart/form-data" action="<?php echo $this->link_form . '/' . $this->id ?>" method="post" id="form_submit">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-12">
                <input id="input_title" type="hidden" class="d-none" name="title" required>
                <div>
                    <?php $this->ui->field('file'); ?>
                </div>
                <div class="mt-3">
                    <?php $this->ui->field('notice'); ?>
                </div>
            </div>
        </div>
    </form>
</div>
<?php echo $this->render('backend.form.javascript'); ?>

