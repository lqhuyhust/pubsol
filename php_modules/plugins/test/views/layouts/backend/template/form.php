<div class="container-fluid p-0 align-items-center row justify-content-center mx-auto">
    <form action="" method="post" id="form_template">
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
                        <?php $this->ui->field('notice'); ?>
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
                <input class="form-control rounded-0 border border-1" id="_method" type="hidden" name="_method" value="POST">
                <div class="row">
                    <div class="col-6 text-end pe-0">
                        <button type="button" class="btn btn-outline-secondary fs-4" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <div class="col-6 text-end pe-0 ">
                        <button type="submit" class="btn btn-outline-success fs-4">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>       
<?php
$js = <<<Javascript
$(document).ready(function() { 
  });
Javascript;

$this->theme->addInline('js', $js);