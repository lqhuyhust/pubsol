<?php defined('APP_PATH') or die('');
$this->theme->prepareAssets([
    'jquery',
    'foundation-css',
    'foundation-js',
]);
$widget = $this->_view->getVar('widgetPosition');

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SDM</title>
    <?php $this->theme->echo('css', $this->url()) ?>
    <?php $this->theme->echo('inlineCss', $this->url()) ?>
    <!-- optional CDN for Foundation Icons ^^ -->
</head>

<body>
    <!-- Start Top Bar -->
    <?php include 'position/top_bar.php' ?>
    <!-- End Top Bar -->
    <?php include 'position/banner.php' ?>

    <article class="grid-container">
        <div class="grid-x grid-margin-x" id="content">
            <div class="medium-9 cell">
                <?php echo $this->render($this->mainLayout) ?>
            </div>
            <div class="medium-3 cell" data-sticky-container>
                <?php include 'position/sidebar.php' ?>
            </div>
        </div>
    </article>

    <?php include 'position/footer.php' ?>

    <?php $this->theme->echo('js', $this->url()); ?>
    <?php $this->theme->echo('inlineJs', $this->url()); ?>
</body>

</html>