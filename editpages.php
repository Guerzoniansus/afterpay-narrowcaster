<?php
require 'helpers.php';

denyAccessIfNotLoggedIn();


?>

<!doctype html>
<html lang="en">
<head>
    <?php addHead("Edit Pages"); ?>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/editpages.css">
    <script src="js/editpages.js"></script>
</head>
<body>

<div class="container-fluid" style="height: 90vh">

    <!-- Top bar -->
    <div class="row" id="navbar">
        <div class="col-1">
            <img id="general-settings-button" title="Open general settings" class="img" src="images/cog-solid.svg" height="40px">
        </div>
        <div class="col-10">
            <h1 align="center"><b>Pages</b></h1>
        </div>
        <div class="col-1">
            <div class="float-right">
                <a href="display.php" target="_blank"><img id="display-redirect-button" title="Open display page in a new tab" class="img" src="images/redirect.svg" height="40px"></a>
            </div>
        </div>
    </div>


    <div class="row content" style="height: 100%">
        <!-- Pages get loaded here with javascript on document ready (loadPages()) -->
        <div class="col-10">
            <div class="pages-containers-container mx-auto"></div>
        </div>

        <!-- Add page button on the right -->
        <div class="col-2 my-auto mx-auto text-center" >
            <h3>Click to add a page</h3>
            <img id="add-page-button" title="Add page" class="plus-icon" src="images/plus-solid.svg">
        </div>
    </div>

</div>

<!-- Input page name -->
<div id="overlay-page-settings-name" class="overlay">
    <div id="page-settings-name" class="settings-container pb-0" style="width: 520px;">
        <div>
            <p align="center" style="display: inline;">Enter a name for your page and press enter</p>
            <button class="close-settings-button" type="button" style="align-self: flex-start" onclick="hideOverlay()">×</button>
        </div>
        <hr>
        <input id="page-name-input" type="text" class="form-control mx-auto" name="page-name" placeholder="Page Name">
        <p id="page-name-input-error" class="text-danger"></p>
    </div>
</div>

<!-- General settings -->
<div id="overlay-page-settings" class="overlay">
    <div id="page-settings" class="settings-container">
        <div>
            <p align="center" style="display: inline;">General settings</p>
            <button class="close-settings-button" type="button" onclick="hideOverlay()">×</button>
        </div>
        <hr>
        <div class="settings-row">
            <p>Time to wait (seconds)</p>
            <input id="timeout-input" type="text" class="form-control h-50 w-25" name="timeout">
        </div>
    </div>
</div>

<!-- Layout settings -->
<div id="overlay-page-settings-layout" class="overlay">
    <div id="page-settings-layout" class="settings-container">
        <div>
            <p id="layout-settings-title" align="center" style="display: inline;">Layout Settings</p>
            <button class="close-settings-button" type="button" onclick="hideOverlay()">×</button>
        </div>
        <hr>
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

<!-- Delete page confirmation window -->
<div id="delete-confirmation-modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Page</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure that you want to delete this page? This cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button id="delete-confirmation-button" type="button" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
