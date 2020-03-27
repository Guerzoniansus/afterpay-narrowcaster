<?php
require 'contenthandler.php';

$pages = getAllPages();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>

    <!-- IMPORT BOOTSTRAP AND JQUERY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/display.css">
    <script src="js/display.js"></script>

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
        <div class="col-1">
            <img src="https://i.imgur.com/01voZlO.png">
        </div>
        <div class="col-10">
            <h1 align="center">Afterpay</h1>
        </div>
        <div class="col-1">
            <a href="editpages.php"><h1 align="right" id="page-button">+</h1></a>
        </div>
    </div>
    <div class="row content" style="height: 90vh">

        <!-- Carousel is a bootstrap thing that creates a slideshow -->
        <div id="carouselExampleIndicators" class="carousel slide mx-auto my-auto w-100 h-100" data-ride="carousel">
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
