<?php defined( 'APP_PATH' ) or die('');
$this->theme->prepareAssets([
    'bootstrap-css',
]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Demo</title>

  <?php $this->theme->echo('css', $this->url) ?> 
  <?php $this->theme->echo('topJs', $this->url) ?>
  <?php $this->theme->echo('inlineCss', $this->url) ?>
</head>

<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php  echo $this->render('widgets.sidebar'); ?>
  <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper m-0">
        <!-- Main content -->
        <?php echo $this->theme->getBody(); ?>
        
        <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php $this->theme->echo('js', $this->url) ?> 
<?php $this->theme->echo('inlineJs', $this->url) ?>
</body>

</html>
