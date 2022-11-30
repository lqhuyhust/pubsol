<?php
    $this->theme->add( $this->url. 'assets/css/select2.min.css', '', 'select_css');
    $this->theme->add( $this->url. 'assets/css/select2_custom.css', '', 'select2_custom_css');
    $this->theme->add( $this->url. 'assets/font/font-awesome-4.7.0/css/font-awesome.min.css', '', 'font_awesome_css');
    $this->theme->add( $this->url. 'assets/font/fontawesome/css/fontawesome.min.css', '', 'fontawesome_css');
    $this->theme->add( $this->url. 'assets/font/fontawesome/css/all.css', '', 'all_css');
    $this->theme->add( $this->url. 'assets/css/gutenberg.css', '', 'gutenberg_css');
    $this->theme->add( $this->url. 'assets/css/all.min.css', '', 'all_mincss');
    $this->theme->add( $this->url. 'assets/user/css/blocks.css', '', 'blocks_css');
    $this->theme->add( $this->url. 'assets/css/adminlte.css', '', 'adminlte_css');
    $this->theme->add( $this->url. 'assets/css/adminlte.min.css', '', 'adminlte_min_css');

    $this->theme->add( $this->url. 'assets/js/jquery-3.6.0.min.js', '', 'jquery' , 'top');
    $this->theme->add( $this->url. 'assets/js/select2.full.min.js', '', 'select_js' , 'top');
    $this->theme->add( $this->url. 'assets/user/js/main.js', '', 'main_js' , '');
?>

<!-- Main content -->
<section class="content p-0">
    <!-- Default box -->
    <div class="card no_shadow">
        <div class="card-header">
            <article id="post-545"
                class="post-545 post type-post status-publish format-standard hentry category-user-app">
                <div class="entry-content">
                    <div class="main_navbar topHeader d-flex align-items-center flex-wrap mb-3"
                        style="padding-left: 23px;">
                        <p class="title_header m-0 mr-2 p-0"><strong><?php $this->echo( $this->id ? 'Edit User Group' : 'Add User Group'); ?></strong></p>
                    </div>
                    <div class="row m-0">
                        <?php $this->render('message') ?>
                    </div>
                    <form method="post" action="<?php echo $this->link_user_group_form;?>">
                        <input name="id" type="hidden" id="id" value="1">
                        <div class="row m-0">
                            <div class="col-12">
                                <div class="row m-0 mb-1">
                                    <div class="col-12 col-sm-6 col-md-6  mb-3">
                                        <label class="">Group Name<span class="color_red">*</span></label>
                                        <!-- <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Enter name"> -->
                                        <?php $this->field('name'); ?>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-3">
                                        <label class="">Right Access<span class="color_red">*</span></label>
                                        <?php $this->field('access'); ?>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div>
                                                <?php $this->field('description'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="mb-3">
                                            <p class="mb-1"><label for="">Status</label><span class="color_red">*</span></p>
                                            <div class="d-flex align-item-center">
                                                <input class="" name="status" type="checkbox" value="active" <? echo $this->form->getField('status')->value === 0 ? ' ' : 'checked'; ?> style="min-height: 27px;min-width: 27px;">
                                                <label class="form-check-label m-0 px-2" for="flexCheckDefault">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="col-12 mb-3">
                                    <button class="btn btn-primary pr-2" type="submit"><a
                                            class="text-decoration-none text-reset">Update</a></button>
                                    <button class="btn btn-secondary" type="button"><a href="<?php echo $this->link_user_group_list; ?>"
                                            class="text-decoration-none text-reset">Cancel</a></button>
                                </div>
                            </div>
                        </div>
                        <?php $this->field('token'); ?>
                        <input type="hidden" name="_method" value="<?php echo $this->id?'PUT':'POST';?>">
                    </form>
                </div>
            </article>
        </div>
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<script>
    $(document).ready(function() {
        jQuery(document).ready(function() {
            jQuery('.js-example-basic-multiple').select2({
                placeholder: "Select Right Access",
                allowClear: true
            });
        });
    });
</script>
