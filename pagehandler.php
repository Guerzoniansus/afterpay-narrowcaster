<?php
require ('class/Page.php');

if (!$_SERVER["REQUEST_METHOD"] == "POST") {
    //die(); DONT REMOVE THIS COMMENT OR THINGS MIGHT BREAK
}

if (!empty($_POST["action"])) {
    $action = $_POST["action"];

    switch ($action) {
        case "load":
            loadPages();
            break;
        case "addPage":
            addPage();
            break;
        case "deletePage":
            deletePage($_POST["pageName"]);
            break;
        case "updatePage":
            updatePage();
            break;
        case "addWidget":
            addWidget();
            break;
        case "getLayoutData":
            sendLayoutData();
            break;
    }
}


/**
 * Return amount, twoLayout and threeLayout of a specified page, encoded in JSON format
 */
function sendLayoutData() {
    $pageName = $_POST["pageName"];
    $page = getPage($pageName);

    $ajaxData["amount"] = $page->amount;
    $ajaxData["twoLayout"] = $page->twoLayout;
    $ajaxData["threeLayout"] = $page->threeLayout;
    echo json_encode($ajaxData);
}

/**
 * Returns Page objected from specified pageName
 * @param string $pageName
 * @return Page|null
 */
function getPage(string $pageName) : ?Page {
    $pageData = file_get_contents("pages/" . strtolower($pageName) . ".txt");
    $page = unserialize($pageData);
    return $page;
}

/**
 * Completely deletes the text file of specified page
 * @param string $pageName
 */
function deletePage(string $pageName) {
    unlink(getcwd() . "/pages/" . strtolower($pageName) . ".txt");
}

/**
 * Add widgetName at widgetIndex to specified pageName
 */
function addWidget() {
    $pageName = $_POST["pageName"];
    $widgetName = $_POST["widgetName"];
    $widgetIndex = $_POST["widgetIndex"];

    $page = getPage($pageName);
    $page->widgets[$widgetIndex - 1] = $widgetName;
    deletePage($pageName);
    savePage($page);

    // to make sure the file doesn't stay open and prevents loading and weird bugs
    die();
}

/**
 * Update the page with $option and $value
 */
function updatePage() {
    $pageName = $_POST["pageName"];
    $option = $_POST["option"];
    $value = $_POST["value"];

    $page = getPage($pageName);

    if ($option == "twoLayout") {
        $page->twoLayout = $value;
    }

    else if ($option == "threeLayout") {
        $page->threeLayout = $value;
    }

    else if ($option == "amount") {
        $page->amount = $value;
    }

    deletePage($pageName);
    savePage($page);
}

/**
 * @return array of Page objects
 */
function getAllPages() : array {
    $pages = [];
    $pagePaths = scandir(getcwd() . "/pages/");

    foreach ($pagePaths as $pagePath) {
        // This line is needed to prevent stupid bugs
        if (strpos($pagePath, "txt") === false)
            continue;

        $pageData = file_get_contents("pages/" . $pagePath);
        $page = unserialize($pageData);
        array_push($pages, $page);
    }

    return $pages;
}

/**
 * Loads all pages and returns HTML to display them nicely inside containers
 */
function loadPages() {
    $pagePaths = scandir(getcwd() . "/pages/");

    foreach ($pagePaths as $pagePath) {
        // This line is needed to prevent stupid bugs
        if (strpos($pagePath, "txt") === false)
            continue;

        $pageData = file_get_contents("pages/" . $pagePath);
        $page = unserialize($pageData);

        if (!empty($page)) {
            ?>

            <div id="<?= $page->pageName ?>" class="page-container">
                <div class="page-container-top">
                    <h3><?= $page->pageName ?></h3>
                    <img id="<?= $page->pageName ?>" class="edit-icon open-settings-button" height="25px" width="25px" src="images/edit.png">
                </div>
                <div id="<?= $page->pageName ?>" class="page-layout-image-container">
                    <img class="mx-auto d-block" src="images/layouts/<?= $page->getLayoutAsString() ?>.png">
                </div>
            </div>

            <?php
        }

    }

}

/**
 * Create text file for specified pageName and add default values
 * Default amount: 4
 * Default widgets: "empty", "empty", "empty", "empty"
 */
function addPage() {
    $name = $_POST["pageName"];

    $response = "Something unexpected went wrong, please try again";

    $pageNames = scandir("pages/");

    if ($pageNames != null) {
        if (in_array(strtolower($name) . '.txt', $pageNames)) {
            echo "A page with this name already exists";
            die();
        }
    }

    $page = new Page();
    $page->pageName = $name;
    $page->visible = true;
    $page->amount = 4;
    $page->widgets = ["empty", "empty", "empty", "empty"];
    $page->twoLayout = $page->defaultTwoLayout;
    $page->threeLayout = $page->defaultThreeLayout;

    savePage($page);

    $response = "success";

    echo $response;
}

/**
 * Save the page to txt file
 * @param Page $page
 */
function savePage(Page $page) {
    $pageData = serialize($page);
    $filePath = getcwd() . "/pages/" . strtolower($page->pageName) . ".txt";

    $fp = fopen($filePath, "w");
    fwrite($fp, $pageData);
    fclose($fp);
}