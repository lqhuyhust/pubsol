<?php
$this->theme->add( $this->url. 'assets/css/select2.min.css', '', 'select2_css_min');
$this->theme->add( $this->url. 'assets/css/select2_custom.css', '', 'select2_css_custom');
$this->theme->add( $this->url. 'assets/font/font-awesome-4.7.0/css/font-awesome.min.css', '', 'font_awesome_css');
$this->theme->add( $this->url. 'assets/font/fontawesome/css/fontawesome.min.css', '', 'fontawesome_css');
$this->theme->add( $this->url. 'assets/font/fontawesome/css/all.css', '', 'all_css');
$this->theme->add( $this->url. 'assets/css/gutenberg.css', '', 'gutenberg_css');
$this->theme->add( $this->url. 'assets/css/all.min.css', '', 'all_mincss');
$this->theme->add( $this->url. 'assets/user/css/blocks.css', '', 'blocks_css');
$this->theme->add( $this->url. 'assets/css/adminlte.css', '', 'adminlte_css');
$this->theme->add( $this->url. 'assets/css/adminlte.min.css', '', 'adminlte_min_css');

$this->theme->add( $this->url. 'assets/js/jquery-3.6.0.min.js', '', 'jquery' , 'top');
$this->theme->add( $this->url. 'assets/js/bootstrap.bundle.min.js', '', 'bootstrap', 'top');
$this->theme->add( $this->url. 'assets/js/select2.full.min.js', '', 'select2_js', 'top');
$this->theme->add( $this->url. 'assets/user/js/main.js', '', 'main_js' , '');
?>
<!-- Main content -->
<section class="content p-0">
    <!-- Default box -->
    <div class="card no_shadow">
        <div class="card-header">
            <article id="post-516"
                class="post-516 post type-post status-publish format-standard hentry category-user-app">
                <div class="entry-content">
                    <div clas="w-full pl-title-576">
                        <p class="title_header"><strong>User Group Management</strong></p>
                    </div>
                    <div class="row">
                        <?php $this->render('message') ?>
                    </div>
                    <div class="mb-3 under_dragbox">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div>
                                    <!-- filter -->
                                    <?php $this->render('backend.userGroup.list.filter') ;?>
                                </div>
                                <div class="row list-view m-0">
                                    <div class="col-sm-12 p-0 table-responsive-md">
                                        <form id="tableList" method="POST" action="<?php echo $this->link_user_group_list; ?>">

                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline"
                                            role="grid"
                                            style="font-size: 14px;min-width: 800px;white-space: nowrap;"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="p-0"
                                                        style="text-align: center;vertical-align: middle;">
                                                        <input type="checkbox" onclick="toggleAllCheckbox(this)">
                                                    </th>
                                                    <th class="sorting th_hover relative pointer" tabindex="0"
                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending" id="sort_name">
                                                            Group Name
                                                            <?php
                                                                if ($this->sort == 'name asc' || $this->sort == 'name desc'):
                                                            ?>
                                                            <div class="<?php echo $this->sort == 'name asc' ? 'icon_absolute' : 'icon_absolute sort_roltate'; ?>">
                                                                <i class="fas fa-sort-down"></i>
                                                            </div>
                                                            <?php endif ?>
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Right Access </th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        User Active </th>
                                                    <th class="sorting relative pointer" tabindex="0"
                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending" id="filter_status">
                                                        Status
                                                        <?php
                                                            if ($this->sort == 'status asc' || $this->sort == 'status desc'):
                                                        ?>
                                                        <div class="<?php echo $this->sort == 'status asc' ? 'icon_absolute' : 'icon_absolute sort_roltate'; ?>">
                                                            <i class="fas fa-sort-down"></i>
                                                        </div>
                                                        <?php endif ?>
                                                    </th>
                                                    <th class="sorting relative pointer th_hover" tabindex="0"
                                                        aria-controls="example1" rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">
                                                        Delete
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="listMedia">
                                                <?php while($this->list->hasRow()) $this->render('backend.userGroup.list.row'); ?>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="_method" id="method" />
                                        <input type="hidden" name="published" id="published" />
                                        <input name="token" type="hidden"   value="<?php echo $this->token;?>">
                                        </form>
                                    </div>
                                </div>

                                <!-- pagination -->
                                <div class="row list-view m-0">
                                    <?php $this->render('pagination'); ?>
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </article>
        </div>
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<?php $this->render('backend.userGroup.list.javascript');
