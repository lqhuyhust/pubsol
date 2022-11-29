<?php defined('APP_PATH') or die('');
// $this->theme->prepareAssets([
//   'bootstrap-css',
// ]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Demo</title> -->
  <?php $this->theme->add('/assets/css/app.css', '', 'styles'); ?>
  <?php $this->theme->add('/assets/css/select2.min.css', '', 'select2'); ?>
  <?php $this->theme->add('/assets/font/fontawesome/css/fontawesome.min.css', '', 'font'); ?>
  <?php $this->theme->add('/assets/js/app.js', '', 'js'); ?>
  <?php $this->theme->add('/assets/js/select2.min.js', '', 'select2js'); ?>

  <?php $this->theme->echo('css', $this->url) ?>
  <?php $this->theme->echo('topJs', $this->url) ?>
  <?php $this->theme->echo('inlineCss', $this->url) ?>
  
</head>

<body  data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
  <div class="wrapper">
    <?php echo $this->render('widgets.backend.sidbar'); ?>
    <div class="main">
      <?php echo $this->render('widgets.backend.header'); ?>

      <main class="content p-0">
        <?php echo $this->theme->getBody(); ?>
      </main>

    </div>
  </div>
  <?php $this->theme->echo('js', $this->url) ?>
  <?php $this->theme->echo('inlineJs', $this->url) ?>
</body>

</html>