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
            <article id="post-535"
                class="post-535 post type-post status-publish format-standard hentry category-user-app">
                <div class="entry-content">
                    <div class="main_navbar topHeader d-flex align-items-center flex-wrap mb-3"
                        style="padding-left: 14px;">
                        <p class="title_header m-0 mr-2 p-0"><strong><?php $this->echo( $this->id ? 'Edit User' : 'Add User'); ?></strong></p>
                    </div>
                    <div class="row m-0">
                        <?php $this->render('message') ?>
                    </div>
                    <form method="post" id="user-form" action="<?php echo $this->link_user_form_save; ?>" class="form_black" enctype="multipart/form-data">
                        <div class="row m-0">
                            <div class="col-12 col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                <label class="lb_black">Name<span class="color_red">*</span></label>
                                <?php $this->field('name'); ?>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="mb-3">
                                    <label class="lb_black">User name<span class="color_red">*</span></label>
                                    <?php $this->field('username'); ?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                <label class="lb_black">Email<span class="color_red">*</span></label>
                                <?php $this->field('email'); ?>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                <label class="lb_black" style="font-size: 16px;">User group</label>
                                <?php $this->field('groups');?>
                            </div>

                            <div class="col-12 col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="row m-0 mb-1">
                                    <div class="col-12 mb-3 p-0">
                                        <label class="lb_black">Password<?php echo (!$this->id) ? '<span class="color_red">*</span>' : ''; ?></label>
                                        <?php $this->field('password'); ?>
                                    </div>
                                    <div class="col-12 mb-3 p-0">
                                        <label class="lb_black">Confirm password<?php echo (!$this->id) ? '<span class="color_red">*</span>' : ''; ?></label>
                                        <?php $this->field('confirm_password'); ?>
                                    </div>
                                    <div class="col-12 mb-3 p-0">
                                        <p class="mb-1"><label class="lb_black" for="">Status</label></p>
                                        <div class="d-flex align-item-center">
                                            <input class="" type="checkbox" value="active" <? echo $this->form->getField('status')->value === 0 ? ' ' : 'checked'; ?> name="status" id="status_field"
                                                style="min-height: 27px;min-width: 27px;">
                                            <label class="form-check-label m-0 px-2" for="flexCheckDefault">
                                                Active User
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="col-12 mb-3 p-0">
                                    <div class="row m-0">
                                        <div class="col-12 col-lg-5 col-md-8 col-sm-12 p-0 mb-3 full_400">
                                            <div class="row m-0 py-2">
                                                <div class="col-12 p-0">
                                                <img class=""
                                                        style="height: 192px;width:300px;max-width:100%;object-fit:cover;border: 1px black solid;border-bottom:none;"
                                                        id="image"
                                                        src="<?php echo ($this->data['avatar']) ?  $this->url. 'media/'. $this->data['avatar'] : $this->url. 'media/users/dummyUser.png'?>"
                                                        alt="">
                                                </div>
                                                <div class="row m-0 p-0 border border-dark" style="width:300px;max-width:100%;">
                                                    <div class="col-6 text-center py-1 cs-pointer relative pointer" style="border-right:1px black solid;">
                                                        <i class="fas fa-upload"></i>
                                                        <input type="file" accept="image/*" id="input-file" name="avatar" class="file-absolute">
                                                    </div>
                                                    <div class="col-6 text-center py-1 cs-pointer relative delete-avatar" >
                                                        <i class="fas fa-trash-alt"></i>
                                                        <input type="checkbox" value="1" id="input-check-delete" name="delete" class="file-absolute">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="col-12 mb-3 p-0">
                                    <button class="btn btn-primary pr-2" id="submit_user_form" type="submit"><a
                                            class="text-decoration-none text-reset"><?php echo $this->id ?' Update' : 'Save';?></a></button>
                                    <button class="btn btn-secondary" type="button"><a href="<?php echo $this->link_user_list; ?>"
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
    jQuery(document).ready(function() {
        jQuery('.js-example-basic-multiple').select2({
            placeholder: "Select User Group",
            allowClear: true
        });
        jQuery('#input-file').on('change' , function(evt) {
            var file = jQuery("input[type=file]").get(0).files[0];
            jQuery("#input-check-delete").prop('checked', false);
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    jQuery("#image").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        })
        jQuery(".delete-avatar").on('click' , function() {            
            jQuery("#input-check-delete").prop('checked', true);
            jQuery("#image").attr("src", "<?php echo $this->url. 'media/dummyUser.png'; ?>");
            // jQuery("#user-form").submit();
        });
    });
</script>