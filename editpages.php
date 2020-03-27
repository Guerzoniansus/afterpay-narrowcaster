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


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Pages</title>

    <!-- IMPORT BOOTSTRAP AND JQUERY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/editpages.css">
    <script src="js/editpages.js"></script>
</head>
<body>

<div class="container-fluid" style="height: 90vh">

    <!-- Top bar -->
    <div class="row" id="navbar">
        <div class="col-1">
            <img src="https://i.imgur.com/01voZlO.png">
        </div>
        <div class="col-10">
            <h1 align="center">Afterpay</h1>
        </div>
        <div class="col-1">
            <a style="vertical-align: middle" href="edit.php"><h2>Go back</h2></a>
        </div>
    </div>


    <div class="row content" style="height: 100%">
        <!-- Pages, gets loaded with javascript on document ready (loadPages()) -->
        <div class="col-10">
            <div class="pages-containers-container mx-auto"></div>
        </div>

        <!-- Add page button on the right -->
        <div class="col-2 my-auto mx-auto text-center" >
            <input id="page-name-input" type="text" class="form-control mx-auto" name="page-name" placeholder="Page Name">
            <p id="page-name-input-error" class="text-danger"></p>
            <br>
            <h1 id="add-page-button" class="plus-icon mx-auto">+</h1>
        </div>
    </div>

</div>

<!-- Page settings -->
<div id="overlay-page-settings" class="overlay">
    <div id="page-settings" class="settings-container">
        <p align="center">Page Settings</p>
        <br>
        <div class="settings-row">
            <p>Layout</p>
            <img id="page-setting-button-layout" class="edit-icon" src="images/edit.png">
        </div>
        <div class="settings-row">
            <p>Time To Wait</p>
            <img id="page-setting-button-timeout" class="edit-icon" src="images/edit.png">
        </div>
        <div class="settings-row">
            <p>Delete Page</p>
            <img id="page-setting-button-delete" class="edit-icon" src="images/edit.png">
        </div>
    </div>
</div>

<!-- Layout settings -->
<div id="overlay-page-settings-layout" class="overlay">
    <div id="page-settings-layout" class="settings-container">
        <p align="center">Page Settings - Layout</p>
        <br>
        <div class="settings-row">
            <p>Amount</p>
            <select class="setting-input h-50" name="amount">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div class="settings-row">
            <p>Layout for two widgets</p>
            <select class="setting-input h-50" name="twoLayout">
                <option value="vertical">Vertical</option>
                <option value="horizontal">Horizontal</option>
            </select>
        </div>
        <div class="settings-row">
            <p>Layout for three widgets</p>
            <select class="setting-input h-50" name="threeLayout">
                <option value="2-1">2-1</option>
                <option value="1-2">1-2</option>
            </select>
        </div>
    </div>
</div>

</body>
</html>
