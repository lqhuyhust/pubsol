<div class="container-fluid p-0 align-items-center row justify-content-center mx-auto">
    <form action="<?php echo $this->link_form . '/'  . $this->id?>" method="post" id="form_template">
        <div class="row g-3">
            <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                <?php foreach($this->paths as $key => $template) : ?>
                <div data-template="<?php echo $key; ?>" class="d-none image-template">
                    <img class="img-fluid" src="<?php echo $this->url($template[2]->image); ?>" alt="">
                </div>
                <?php endforeach; ?>
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
<?php 
include 'widgetModal.php'; 
include 'widgetsModal.php'; 
include 'javascript.php'; 
?>