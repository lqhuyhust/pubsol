<?php
/**
 * SPT software - Layout html
 *
 * @project: https://github.com/smpleader/spt-boilerplate
 * @author: Pham Minh - smpleader
 * @description: Display a layout
 *
 */
$this->theme->add( $this->url. 'assets/css/adminlte.css', '', 'adminlte_css');
$this->theme->add( $this->url. 'assets/user/css/blocks.css', '', 'user_block_css');
$this->theme->add( $this->url. 'assets/css/all.min.css', '', 'fontawersome');
$this->theme->add( $this->url. 'assets/font/font-awesome-4.7.0/css/font-awesome.min.css', '', 'fontawersome-4.7');
$this->theme->add( $this->url. 'assets/font/fontawesome/css/fontawesome.min.css', '', 'fontawersome-free');
$this->theme->add( $this->url. 'assets/font/fontawesome/css/all.css', '', 'fontawersome-style');
$this->theme->add( $this->url. 'assets/css/gutenberg.css', '', 'user_min_all');
$this->theme->add( $this->url. 'assets/css/bootstrap5.min.css', '', 'bootstrap5');


?>
<section class="content p-0">
      <!-- Default box -->
      <div class="card no_shadow" style="border:none;margin-top: 50px;">
        <div class="card-header" style="background: none;">
        <article id="post-549" class="post-549 post type-post status-publish format-standard hentry category-user-app">
	<div class="entry-content">

<h3 class="has-text-align-center text-align-center" id="login-admin"><strong>Login</strong></h3>
<div class="row m-0" style="width:350px;margin: 0 auto !important">
    <?php $this->render('message') ?>
</div>
<div class="wp-container-2 wp-block-columns">
<div class="wp-block-column">
<div class="wp-container-1 wp-block-columns">
<div class="wp-block-column"><div style="width: 350px;margin: 0 auto;">
    <div class="card">
        <div class="card-body login-card-body">
            <form method="post" action="<?php echo $this->link_login;?>">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-12 mb-2 p-0">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div></div>
</div>
</div>
</div>
	</div>
</article>        </div>
      </div>
      <!-- /.card -->

    </section>
