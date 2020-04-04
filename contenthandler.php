<?php
require ('pagehandler.php');
require ('generalsettings.php');

if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    //die(); DONT REMOVE THIS COMMENT OR THINGS MIGHT BREAK
}

if (!empty($_POST["action"])) {
    $action = $_POST["action"];

    switch ($action) {
        case "loadWidgets":
            loadWidgets();
            break;
    }
}

/**
 * Insert a HTML container with $widgets[$widgetIndex] inside of it
 * If "edit" mode is true, it adds a + button in the top left of a widget,
 * and (when it exists) inserts the special edit version of a widget
 * @param array $widgets
 * @param int $widgetIndexI
 */
function insertWidgetContainer(array $widgets, int $widgetIndex, int $height) {
    $widgetName = $widgets[$widgetIndex - 1];
    $edit = $_POST["edit"];

    if ($widgetName == "empty") {
        ?>
        <div class="widget-container empty-widget w-100 h-100 mx-auto my-auto border" style="height: <?= $height ?>px;">
            <img id="<?= $widgetIndex ?>" class="plus-icon add-widget-plus-button" src="images/plus-solid.svg">
        </div>
        <?php
    }

    /* The code BELOW will create HTML that looks like this:
     * <div id="$widgetIndex" class="widget-container w-100 h-100 border">
         <h1 id="$widgetIndex" class="plus-icon add-widget-plus-button">+</h1> (ONLY IF EDIT MODE == TRUE)
         <div id="$widgetName" class="widget-content mx-auto my-auto">
            --- here is the content of the widget ---
         </div>
       </div>
     */

    else {
        ?>
        <div id="<?= $widgetIndex ?>" class="widget-container w-100 border page-<?= $_POST["pageName"] ?>" style="height: <?= $height ?>px;">
            <? if ($edit == true): ?>
                <img id="<?= $widgetIndex ?>" class="plus-icon-small add-widget-plus-button" src="images/plus-solid.svg">
            <? endif; ?>
            <div id="<?= $widgetName ?>" class="widget-content mx-auto my-auto">
                <input type="hidden" name="widget-index" value="<?= $widgetIndex ?>">
                <input type="hidden" name="pageName" value="<?= $_POST["pageName"] ?>">
                <?
                // If in edit mode (aka admin adding widgets):
                // Select widgetname-edit.php to get the editor version
                // Or the regular widgetname.php if a special edit version does not exist

                if ($edit == false) {
                    // THIS IS HOW WIDGETS GET INSERTED FROM THEIR OWN PHP file
                    require 'widgets/' . $widgetName . '/' . $widgetName . '.php';
                }

                else {
                    if (file_exists('widgets/' . $widgetName . '/' . $widgetName . '-edit.php')) {
                        require 'widgets/' . $widgetName . '/' . $widgetName . '-edit.php';
                    }
                    else require 'widgets/' . $widgetName . '/' . $widgetName . '.php';
                } ?>
            </div>
        </div>
        <?php
    }
}

// This is used on display.php so I don't have to do stupid AJAX post requests
function loadWidgetsFromArguments($edit, $pageName) {
    $_POST["edit"] = $edit;
    $_POST["pageName"] = $pageName;
    echo loadWidgets();
}

/**
 * Create page layout with HTML / bootstrap, then use insertWidgetContainer() to insert the widget itself into the page
 * Then return the layout as a whole
 */
function loadWidgets() {
    $edit = $_POST["edit"];
    $pageName = $_POST["pageName"];

    $page = getPage($pageName);
    $widgets = $page->widgets;

    $smallHeight = 475;
    $tallHeight = $smallHeight * 2;

    if ($page->getLayoutAsString() == "1") {
        ?>
        <div class="row" style="height: <?=$tallHeight?>px">
            <div class="col-12">
                <? insertWidgetContainer($widgets, 1, $tallHeight); ?>
            </div>
        </div>
        <?php
    }

    else if ($page->getLayoutAsString() == "2-horizontal") {
        ?>
        <div class="row" style="height: <?=$smallHeight?>px;">
            <div class="col-12">
                <? insertWidgetContainer($widgets, 1, $smallHeight); ?>
            </div>
        </div>
        <div class="row" style="height: <?=$smallHeight?>px;">
            <div class="col-12">
                <? insertWidgetContainer($widgets, 2, $smallHeight); ?>
            </div>
        </div>
        <?php
    }

    else if ($page->getLayoutAsString() == "2-vertical") {
        ?>
        <div class="row" style="height: <?=$tallHeight?>px;">
            <div class="col-6">
                <? insertWidgetContainer($widgets, 1, $tallHeight); ?>
            </div>
            <div class="col-6">
                <? insertWidgetContainer($widgets, 2, $tallHeight); ?>
            </div>
        </div>
        <?php
    }

    else if ($page->getLayoutAsString() == "1-2") {
        ?>
        <div class="row" style="height: <?=$tallHeight?>px;">
            <div class="col-6">
                <? insertWidgetContainer($widgets, 1, $tallHeight); ?>
            </div>
            <div class="col-6">
                <div class="row" style="height: <?=$smallHeight?>px;">
                    <div class="col-12">
                        <? insertWidgetContainer($widgets, 2, $smallHeight); ?>
                    </div>
                </div>
                <div class="row" style="height: <?=$smallHeight?>px;">
                    <div class="col-12">
                        <? insertWidgetContainer($widgets, 3, $smallHeight); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    else if ($page->getLayoutAsString() == "2-1") {
        ?>
        <div class="row" style="height: <?=$tallHeight?>px">
            <div class="col-6">
                <div class="row" style="height: <?=$smallHeight?>px;">
                    <div class="col-12">
                        <? insertWidgetContainer($widgets, 1, $smallHeight); ?>
                    </div>
                </div>
                <div class="row" style="height: <?=$smallHeight?>px;">
                    <div class="col-12">
                        <? insertWidgetContainer($widgets, 2, $smallHeight); ?>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <? insertWidgetContainer($widgets, 3, $tallHeight); ?>
            </div>
        </div>
        <?php
    }

    else if ($page->getLayoutAsString() == "4") {
        ?>
        <div class="row" style="height: <?=$smallHeight?>px;">
            <div class="col-6">
                <? insertWidgetContainer($widgets, 1, $smallHeight); ?>
            </div>
            <div class="col-6">
                <? insertWidgetContainer($widgets, 2, $smallHeight); ?>
            </div>
        </div>
        <div class="row" style="height: <?=$smallHeight?>px;">
            <div class="col-6">
                <? insertWidgetContainer($widgets, 3, $smallHeight); ?>
            </div>
            <div class="col-6">
                <? insertWidgetContainer($widgets, 4, $smallHeight); ?>
            </div>
        </div>
        <?php
    }

    ?>
    <input id="pageLayoutHiddenInput" type="hidden" name="pageLayout" value="<?= $page->getLayoutAsString(); ?>">
    <?php
}
