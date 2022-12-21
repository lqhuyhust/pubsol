<?php echo $this->render('notification');?>
<div class="container-fluid align-items-center row justify-content-center mx-auto pt-3">
    <div class="card shadow-none p-0 col-lg-12">
        <div class="card-body">
            <form action="<?php echo $this->link_form . '/' . $this->id ?>" method="post">
                <div class="row g-3 align-items-center">
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto pt-3">
                            <label class="form-label fw-bold">Name:</label>
                            <?php $this->field('name'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto">
                            <label class="form-label fw-bold">User Name:</label>
                            <?php $this->field('username'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto">
                            <label class="form-label fw-bold">Password:</label>
                            <?php $this->field('password'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto">
                            <label class="form-label fw-bold">Confirm Password:</label>
                            <?php $this->field('confirm_password'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto">
                            <label class="form-label fw-bold" for="inputEmail4">Email:</label>
                            <?php $this->field('email'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto">
                            <label class="form-label fw-bold" for="groups">Groups:</label>
                            <?php $this->field('groups'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-sm-12 mx-auto">
                            <label class="form-label fw-bold">Status:</label>
                            <?php $this->field('status'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center m-0">
                        <?php $this->field('token'); ?>
                        <input class="form-control rounded-0 border border-1" type="hidden" name="_method" value="<?php echo $this->id ? 'PUT' : 'POST' ?>">
                        <div class="col-xl-6 col-sm-6 text-end">
                            <a href="<?php echo $this->link_list ?>">
                                <button type="button" class="btn btn-outline-secondary">Cancel</button>
                            </a>
                        </div>
                        <div class="col-xl-3 col-sm-6 text-start ">
                            <button type="submit" class="btn btn-outline-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>