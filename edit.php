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
</head>
<body>


<div class="container-fluid">

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

    <!-- Widgets -->
    <div class="row content" style="height: 90vh">
        <? if ($pageName == null): ?>
        <h1>No page selected. Click the + icon on the top right and choose a page to edit.</h1>
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
    <div id="widget-select">
        <img id="orders" class="widget-img" src="images/widget-icons/orders.png">
        <img id="text" class="widget-img" src="images/widget-icons/text.png">
        <img id="empty" class="widget-img" src="images/widget-icons/delete.png">
        <img id="orders" class="widget-img" src="images/widget-icons/orders.png">
        <img id="orders" class="widget-img" src="images/widget-icons/orders.png">
        <img id="weather" class="widget-img" src="images/widget-icons/weather.png">
    </div>
</div>




</body>
</html>