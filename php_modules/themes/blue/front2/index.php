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
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="SPT-fw 0.8">

    <title>SDM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="canonical" href="<?php echo $this->url(); ?>">
    <?php $this->theme->echo('css', $this->url()) ?>
    <?php $this->theme->echo('inlineCss', $this->url()) ?>
</head>
<body>
    <?php include 'position/header.php' ?>
    <!-- Topbar End -->
    <!-- Navbar Start -->
    <?php include 'position/menu.php' ?>
    <!-- Navbar End -->
    <!-- Carousel Start -->
    <?php include 'position/slider.php' ?>
    <!-- Carousel End -->
    <!-- Features Start -->
    <?php include 'position/feature.php' ?>
    <!-- Features End -->
    <!-- Project Start -->
    <div class="container-xxl pt-5">
        <div class="container">
            <?php echo $this->render($this->mainLayout) ?>
        </div>
    </div>
    <!-- Project End -->

    <!-- Footer Start -->
    <?php include 'position/footer.php' ?>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <?php include 'position/copyright.php' ?>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php $this->theme->echo('js', $this->url()); ?>
    <?php $this->theme->echo('inlineJs', $this->url()); ?>
    <!-- Template Javascript -->
</body>
</html>