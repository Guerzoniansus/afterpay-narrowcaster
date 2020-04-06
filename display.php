<?php
require 'helpers.php';
require 'contenthandler.php';

$pages = getAllPages();

// getTimeout is seconds, Bootstrap carousel (slideshow) uses milliseconds
$timeout = getTimeout(false) * 1000;
?>

<!doctype html>
<html lang="en">
<head>
    <?php addHead("Display") ?>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/display.css">
    <script src="js/display.js"></script>

</head>
<body>

<div class="container-fluid">

    <script>
        // This script is so widgets can do stuff for individual pages
        var pageNames = [];
        <? for ($i = 0; $i < count($pages); $i++) {
            if ($pages[$i]->visible == "true") {
                ?>
                pageNames[<?= $i ?>] = "<?= $pages[$i]->pageName ?>";
                <?
            }
        } ?>
    </script>

    <!-- Top bar -->
    <div class="row" id="navbar">
        <div class="col-2">
            <div class="d-flex justify-content-center align-items-center float-left">
                <p id="topbar-time"></p>
            </div>
        </div>
        <div class="col-8">
            <div class="d-flex justify-content-center align-items-center">
                <img src="images/website-logo-wit.png" style="margin-top: 3px">
            </div>
        </div>
        <div class="col-2">
            <div class="d-flex justify-content-center align-items-center float-right">
                <p id="topbar-date"></p>
            </div>
        </div>
    </div>
    <div class="row content" style="height: 90vh">

        <!-- Carousel is a bootstrap thing that creates a slideshow -->
        <div id="carouselExampleIndicators" class="carousel slide mx-auto my-auto w-100 h-100" data-ride="carousel"
        data-interval="<?= $timeout ?>" data-pause="false">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <? for ($i = 0; $i < count($pages); $i++): ?>
                <? if ($pages[$i]->visible == "false") continue; ?>
                    <div class="carousel-item <?= $i == 0 ? 'active' : ''?>">
                        <div id="widget-containers-container" class="col-12 mx-auto my-auto">
                            <?= loadWidgetsFromArguments(false, $pages[$i]->pageName) ?>
                        </div>
                    </div>
                <? endfor; ?>
            </div>
        </div>


    </div>
</div>


</body>
</html>
