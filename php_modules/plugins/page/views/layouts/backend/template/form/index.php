<div class="container-fluid p-0 align-items-center row justify-content-center mx-auto">
    <form action="<?php echo $this->link_form . '/'  . $this->id?>" method="post" id="form_template">
        <div class="row g-3 align-items-center">
            <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                Image here
            </div>
            <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                <div class="row px-0 mb-3">
                    <div class="col-12 d-flex align-items-center">
                        <label class="form-label fw-bold mb-2">Path</label>
                    </div>
                    <div class="col-12">
                        <?php $this->ui->field('path'); ?>
                    </div>
                </div>
                <div class="row px-0">
                    <div class="col-12 d-flex align-items-center">
                        <label class="form-label fw-bold mb-2">Title</label>
                    </div>
                    <div class="col-12">
                        <?php $this->ui->field('title'); ?>
                    </div>
                </div>
                <div class="row px-0 mb-3">
                    <div class="col-12 d-flex align-items-center">
                        <label class="form-label fw-bold mb-2">Notice</label>
                    </div>
                    <div class="col-12">
                        <?php $this->ui->field('note'); ?>
                    </div>
                </div>
                <div class="row px-0 mb-3">
                    <div class="col-12 d-flex align-items-center">
                        <label class="form-label fw-bold mb-2">Positions</label>
                    </div>
                    <div class="col-12">
                        <?php $this->ui->field('positions'); ?>
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
<div class="modal fade" id="selectWidgetType" tabindex="-1" aria-labelledby="selectWidgetTypeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectWidgetTypeLabel">Select Widget Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $this->ui->field('widgets'); ?>
                <?php $this->ui->field('id'); ?>
                <?php $this->ui->field('position'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createModel">Create</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="widgetForm" tabindex="-1" aria-labelledby="widgetFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="widgetFormLabel">Widget</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe width="100%" style="height: 50vh" id="widget_form_load" src="" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveWidget">Save</button>
            </div>
        </div>
    </div>
</div>
<?php echo $this->render('backend.template.form.javascript'); ?>