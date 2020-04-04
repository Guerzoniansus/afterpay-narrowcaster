<?php
require 'contenthandler.php';

$pages = getAllPages();

// getTimeout is seconds, Bootstrap carousel (slideshow) uses milliseconds
$timeout = getTimeout(false) * 1000;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display</title>

    <!-- IMPORT BOOTSTRAP AND JQUERY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/display.css">
    <script src="js/display.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <!-- Unedited images from Font Awesome were used. License at https://fontawesome.com/license -->
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
