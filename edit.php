<?php

// ===== CHECK IF USER HAS A COOKIE THAT SAYS THEY SUCCESSFULLY LOGGED IN, OTHERWISE REDIRECT TO LOGIN PAGE
if (!isset($_COOKIE["admin"])) {
    header('Location: login.php');
    die();
}

else {
    if ($_COOKIE["admin"] != "ja") {
        header('Location: login.php');
        die();
    }
}
// ===== CHECK IF USER HAS A COOKIE THAT SAYS THEY SUCCESSFULLY LOGGED IN, OTHERWISE REDIRECT TO LOGIN PAGE

$pageName = null;

if (!empty($_GET["pageName"])) {
    $pageName = $_GET["pageName"];
}


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

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/edit.css">
    <script src="js/edit.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <!-- Unedited and edited images from Font Awesome were used. License at https://fontawesome.com/license -->
</head>
<body>


<div class="container-fluid">

    <!-- Top bar -->
    <div class="row" id="navbar">
        <div class="col-2">
            <a href="editpages.php" style="text-decoration: none;" title="Go back to all pages"><h1 id="page-button">◄ Pages</h1></a>
        </div>
        <div class="col-8">
            <div style="display: flex; justify-content: center; align-items: center;">
                <h1 align="center"><b>Page: <?= $pageName ?></b></h1>
            </div>
        </div>
        <div class="col-2">
            <div class="float-right">
                <a href="display.php" target="_blank"><img id="display-redirect-button" title="Open display page in a new tab" class="img" src="images/redirect.svg" height="40px"></a>
            </div>
        </div>
    </div>

    <!-- Widgets -->
    <div class="row content" style="height: 90vh">
        <? if ($pageName == null): ?>
        <h1>No page selected. Click pages on the top left and choose a page to edit.</h1>
        <? else: ?>

        <!-- All widgets get loaded inside this div through javascript -->
        <div id="widget-containers-container" class="col-12 mx-auto my-auto">

        </div>

        <? endif; ?>
        <input id="pageNameHiddenInput" type="hidden" name="pageName" value="<?= $pageName ?>">
    </div>
</div>

<!-- Images of widgets -->
<div id="overlay-widget-select" class="overlay">
    <div id="widget-select" style="display: flex; justify-content: space-between; flex-wrap: wrap; align-content: start;">
        <div class="widget-img-div">
            <p class="widget-img-text">Orders</p>
            <img id="orders" class="widget-img" src="images/widget-icons/orders.png"
                 title="Display order numbers">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Text</p>
            <img id="text" class="widget-img" src="images/widget-icons/text.png"
                 title="Display formatted text and images">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Weather</p>
            <img id="weather" class="widget-img" src="images/widget-icons/weather.png"
                 title="Display weather">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Weather Forecast</p>
            <img id="weatherforecast" class="widget-img" src="images/widget-icons/weatherforecast.png"
                 title="Display weather forecast">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Weather map</p>
            <img id="weathermap" class="widget-img" src="images/widget-icons/weathermap.png"
                 title="Display weather map">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Delete</p>
            <img id="empty" class="widget-img" src="images/widget-icons/delete.png"
                 title="Delete this widget">
        </div>
    </div>
</div>




</body>
</html>