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
                <div class="blog-post">
                    <h3>Awesome blog post title <small>3/6/2016</small></h3>
                    <img class="thumbnail" src="https://placehold.it/850x350">
                    <p>Praesent id metus massa, ut blandit odio. Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus.</p>
                    <div class="callout">
                        <ul class="menu simple">
                            <li><a href="#">Author: Mike Mikers</a></li>
                            <li><a href="#">Comments: 3</a></li>
                        </ul>
                    </div>
                </div>

                <div class="blog-post">
                    <h3>Awesome blog post title <small>3/6/2016</small></h3>
                    <img class="thumbnail" src="https://placehold.it/850x350">
                    <p>Praesent id metus massa, ut blandit odio. Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus.</p>
                    <div class="callout">
                        <ul class="menu simple">
                            <li><a href="#">Author: Mike Mikers</a></li>
                            <li><a href="#">Comments: 3</a></li>
                        </ul>
                    </div>
                </div>

                <div class="blog-post">
                    <h3>Awesome blog post title <small>3/6/2016</small></h3>
                    <img class="thumbnail" src="https://placehold.it/850x350">
                    <p>Praesent id metus massa, ut blandit odio. Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus.</p>
                    <div class="callout">
                        <ul class="menu simple">
                            <li><a href="#">Author: Mike Mikers</a></li>
                            <li><a href="#">Comments: 3</a></li>
                        </ul>
                    </div>
                </div>

                <div class="blog-post">
                    <h3>Awesome blog post title <small>3/6/2016</small></h3>
                    <img class="thumbnail" src="https://placehold.it/850x350">
                    <p>Praesent id metus massa, ut blandit odio. Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at nulla justo, eget luctus.</p>
                    <div class="callout">
                        <ul class="menu simple">
                            <li><a href="#">Author: Mike Mikers</a></li>
                            <li><a href="#">Comments: 3</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="medium-3 cell" data-sticky-container>
                <div class="sticky" data-sticky data-anchor="content">
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="#">Skyler</a></li>
                        <li><a href="#">Jesse</a></li>
                        <li><a href="#">Mike</a></li>
                        <li><a href="#">Holly</a></li>
                    </ul>

                    <h4>Authors</h4>
                    <ul>
                        <li><a href="#">Skyler</a></li>
                        <li><a href="#">Jesse</a></li>
                        <li><a href="#">Mike</a></li>
                        <li><a href="#">Holly</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="grid-x cell">
            <ul class="pagination" role="navigation" aria-label="Pagination">
                <li class="disabled">Previous</li>
                <li class="current"><span class="show-for-sr">You're on page</span> 1</li>
                <li><a href="#" aria-label="Page 2">2</a></li>
                <li><a href="#" aria-label="Page 3">3</a></li>
                <li><a href="#" aria-label="Page 4">4</a></li>
                <li class="ellipsis"></li>
                <li><a href="#" aria-label="Page 12">12</a></li>
                <li><a href="#" aria-label="Page 13">13</a></li>
                <li><a href="#" aria-label="Next page">Next</a></li>
            </ul>
        </div>
    </article>
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