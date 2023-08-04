<?php echo $this->renderWidget('core::notification');?>
<div class="container-fluid p-0 align-items-center row justify-content-center mx-auto">
    <form action="<?php echo $this->link_form . '/'  . $this->id?>" method="post" id="form_template">
        <div class="row g-3 align-items-center">
            <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                <div class="row px-0">
                    <div class="col-md-6 col-12 pt-2">
                        <?php $this->ui->field('title'); ?>
                    </div>
                    <div class="col-md-6 col-12 pt-2">
                        <?php $this->ui->field('slug'); ?>
                    </div>
                    <div class="col-12 pt-2">
                        <?php $this->ui->field('template_id'); ?>
                    </div>
                    <div class="col-12 pt-2">
                        <?php $this->ui->field('data'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3 align-items-center m-0">
            <div class="modal-footer">
                <?php $this->ui->field('token'); ?>
                <input id="_method" type="hidden" name="_method" value="<?php echo $this->id ? 'PUT' : 'POST';?>">
                <div class="row">
                    <div class="col-6 text-end pe-0">
                        <a href="<?php echo $this->link_list;?>" type="button" class="btn btn-outline-secondary fs-4">Cancel</a>
                    </div>
                    <div class="col-6 text-end pe-0 ">
                        <button type="submit" class="btn btn-outline-success fs-4">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>