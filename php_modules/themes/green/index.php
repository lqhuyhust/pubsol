<?php // Just a default theme

$this->theme->prepareAssets([
    'bootstrap-css',
    'style-css',
    'js-bootstrap'
]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? echo $this->title() ?></title>

    <?php $this->theme->echo('css', $this->url) ?> 
    <?php $this->theme->echo('topJs', $this->url) ?>
    <?php $this->theme->echo('inlineCss', $this->url) ?>
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <?php  echo $this->renderWidget('core::header'); ?>
    <?php echo $this->theme->getBody(); ?>
    <?php  echo $this->renderWidget('core::footer'); ?>
            
    <?php $this->theme->echo('js', $this->url) ?> 
    <?php $this->theme->echo('inlineJs', $this->url) ?>
</body>
</html>
