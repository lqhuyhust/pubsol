
<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <form enctype="multipart/form-data" action="<?php echo $this->link_form . '/' . $this->id ?>" method="post" id="form_submit">
        <div class="row">
            <div id="col-8" class="col-lg-8 col-sm-12">
                <input id="input_title" type="hidden" class="d-none" name="title" required>
                <label class="form-label fw-bold pt-2">File:</label>
                <input name="file" type="file" id="file" class="form-control">
                <label class="form-label fw-bold">Notice:</label>
                <?php $this->ui->field('note'); ?>
            </div>
            <div id="col-4" class="col-lg-4 col-sm-12">
            </div>
        </div>
    </form>
</div>