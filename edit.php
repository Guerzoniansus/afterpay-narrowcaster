<?php
require 'helpers.php';

denyAccessIfNotLoggedIn();

$pageName = null;

if (!empty($_GET["pageName"])) {
    $pageName = $_GET["pageName"];
}


?>

<!doctype html>
<html lang="en">
<head>
    <?php addHead("Edit"); ?>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/edit.css">
    <script src="js/edit.js"></script>
</head>
<body>


<div class="container-fluid">

    <!-- Top bar -->
    <div class="row" id="navbar">
        <div class="col-4">
            <a href="editpages.php" style="text-decoration: none;" title="Go back to all pages"><h1 id="page-button">◄ Pages</h1></a>
        </div>
        <div class="col-4">
            <div style="display: flex; justify-content: center; align-items: center;">
                <h1 align="center"><b>Page: <?= $pageName ?></b></h1>
            </div>
        </div>
        <div class="col-4">
            <div class="float-right">
                <a href="display.php" target="_blank" onclick="goToDisplayPage()">
                    <a href="editpages.php" style="text-decoration: none;" target="_blank" title="Open slideshow in a new tab"><h1 id="page-button">Go to slideshow ►</h1></a>
                </a>
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
            <p class="widget-img-text">News</p>
            <img id="Nieuws" class="widget-img" src="images/widget-icons/news.png"
                 title="Display news">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Weather</p>
            <img id="weather" class="widget-img" src="images/widget-icons/weather.png"
                 title="Display current weather, updated every minute">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Forecast</p>
            <img id="weatherforecast" class="widget-img" src="images/widget-icons/weatherforecast.png"
                 title="Display weather forecast of 3 hours from now">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Weather map</p>
            <img id="weathermap" class="widget-img" src="images/widget-icons/weathermap.png"
                 title="Display weather map">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">YouTube Video</p>
            <img id="youtube-video" class="widget-img" src="images/widget-icons/youtube-video.png"
                 title="Display YouTube Video">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Playlist</p>
            <img id="youtube-playlist" class="widget-img" src="images/widget-icons/youtube-playlist.png"
                 title="Display YouTube Playlist">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Rather</p>
            <img id="wouldyourather" class="widget-img" src="images/widget-icons/wouldyourather.png"
                 title='Display a random "Would you rather?" question to start a conversation about'>
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Spotify</p>
            <img id="spotify" class="widget-img" src="images/widget-icons/spotify.png"
                 title='Display a Spotify player'>       
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Birthday</p>
            <img id="Birthday" class="widget-img" src="images/widget-icons/birthday.png"
                 title="Display birthdays of today">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text">Delete</p>
            <img id="empty" class="widget-img" src="images/widget-icons/delete.png"
                 title="Delete this widget">
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text"></p>
        </div>
        <div class="widget-img-div">
            <p class="widget-img-text"></p>
        </div>
    </div>
</div>
</body>
</html>