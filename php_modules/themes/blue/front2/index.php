<?php defined('APP_PATH') or die('');
$this->theme->prepareAssets([
    // 'jquery',
    'fontawesome-css',
    'bootstrap-css',
    // 'js-bootstrap',
    'animate-css',
    'carousel-css',
    'lightbox-css',
    'style-css',
    'wow-js',
    'easing-js',
    'waypoints-js',
    'carousel-js',
    'lightbox-js',
]);
$widget = $this->_view->getVar('widgetPosition');

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-prototype.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css' rel='stylesheet' type='text/css'>
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
                <?php include 'position/banner.php' ?>
            </div>
        </div>
    </article>
    <?php include 'position/footer.php' ?>
    <script src="bower_components/jquery/dist/jquery.js?hash=4d87a332421d7631f5e204529a472bff"></script>
    <script src="bower_components/what-input/what-input.js?hash=af041c30741a345292bed3cb0f1295ca"></script>
    <script src="bower_components/foundation-sites/dist/foundation.js?hash=37375b21ccbe17669cdc30790ba5a003"></script>
    <script src="js/app.js?hash=78ce4569316d2924214f821d75e9028f"></script>
</body>

</html>



<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.js"></script>
<script>
    $(document).foundation();
</script>
</body>

</html>