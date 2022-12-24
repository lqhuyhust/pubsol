<?php echo $this->render('notification'); ?>
<div class="container-fluid align-items-center row justify-content-center mx-auto ">
    <h4 class="text-center">Version format: X.Y.Z , With X,Y,Z has the format x, xx, xxx,... <br> Example with format x.x.x : 0.0.2 </strong></h4>
    <form enctype='multipart/form-data' action="<?php echo  $this->link_form ?>" method="POST">
        <div class="d-flex mt-2 justify-content-center mb-3">
            <div class="d-flex align-items-center">
                <strong class="me-2">X: </strong> <?php echo $this->field('version_format_x'); ?>
            </div>
            <div class="d-flex align-items-center ms-3">
                <strong class="me-2">Y: </strong> <?php echo $this->field('version_format_y'); ?>
            </div>
            <div class="d-flex align-items-center ms-3">
                <strong class="me-2">Z: </strong> <?php echo $this->field('version_format_z'); ?>
            </div>
        </div>
        <div class="d-flex g-3 flex-row align-items-end m-0 justify-content-center">
            <?php $this->field('token'); ?>
            <input class="form-control rounded-0 border border-1" type="hidden" name="_method" value="<?php echo $this->id ? 'PUT' : 'POST' ?>">
            <div class="me-2">
                <a href="<?php echo $this->link_list ?>">
                    <button type="button" class="btn btn-outline-secondary">Cancel</button>
                </a>
            </div>
            <div class="">
                <button type="submit" class="btn btn-outline-success">Apply</button>
            </div>
        </div>
    </form>
    <?php
    //  } 
    ?>
</div>