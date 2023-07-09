<div class="bg-white container-fluid p-0 align-items-center row justify-content-center mx-auto">
    <form action="<?php echo $this->link_form .'/'. $this->id ?>" method="post" id="form_model">
        <input type="hidden" value="<?php echo $this->id ? 'PUT' : 'POST'; ?>" name="_method">
        <?php if ($this->message) : ?>
        <div class="alert alert-success mb-0" role="alert">
            <?php echo $this->message; ?>
        </div>
        <?php endif ?>
        <div class="row g-3 align-items-center">
            <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                <div class="row px-0 mb-3">
                    <div class="col-12">
                        <?php $this->ui->field('title'); ?>
                    </div>
                    <div class="col-12 mt-2 d-flex align-items-center">
                        <h4>HTML</h4>
                    </div>
                    <div class="col-12">
                        <?php $this->ui->field('content'); ?>
                    </div>
                    <?php $this->ui->field('id'); ?>
                    <?php $this->ui->field('template_id'); ?>
                    <?php $this->ui->field('position'); ?>
                </div>
                
                <div class="col-6 text-end pe-0 ">
                    <button id="submit_button" type="submit" class="d-none btn btn-outline-success fs-4">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>