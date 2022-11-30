<div class="main">
    <nav class="navbar navbar-expand navbar-light navbar-bg shadow-none py-2 ">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>
        <h2 class="pt-2">Setting</h2>
    </nav>
    <main class="content p-0">
        <div class="container-fluid align-items-center row justify-content-center mx-auto p-0">
            <?php
            ?>
            <div class="card shadow-none col-lg-12">
                <div class="card-body">
                    <?php echo $this->render('message'); ?>
                    <form enctype='multipart/form-data' action="<?php echo  $this->link_form ?>" method="POST">
                        <?php foreach ($this->fileds as $key => $value) {
                            if ($key != 'token') { ?>
                                <div class="mb-3 col-lg-12 col-sm-12 mx-auto">
                                    <?php if ($value['label']) { ?>
                                        <label class="form-label fs-5 fw-bold pt-2"><?php echo $value['label']; ?></label>
                                    <?php } ?>

                                    <?php $this->field($key); ?>
                                </div>
                        <?php }
                        } ?>

                        <div class="row align-items-center ">
                            <div class="col-xl-12 col-sm-12 text-center ">
                                <button type="submit" class="btn btn-outline-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            //  } 
            ?>
        </div>
    </main>
</div>