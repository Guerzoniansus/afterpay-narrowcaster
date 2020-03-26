<?php

if (isset($_POST["action"])) {
    $action = $_POST["action"];

    switch ($action) {
        case "save": saveText();
        break;
    }
}

function saveText() {
    $returnMessage = "success";

    $dirName = getcwd() . "/" . $_POST["pageName"];
    $widgetIndex = $_POST["widgetIndex"];
    $text = $_POST["text"];

    // Create folder with name pageName
    if (!is_dir($dirName))
    {
        mkdir($dirName, 0755, true);
    }

    // Text gets saved to text/pageName/widgetIndex.txt
    // So for example: pages/Page1/1.txt
    $filePath = $dirName . "/" . $widgetIndex . ".txt";

    $fp = fopen($filePath, "w");
    if (fwrite($fp, $text) == false) {
        $returnMessage = "error";
    }
    fclose($fp);

    echo $returnMessage;
    die();
}

function loadText() {

}

function deleteFiles() {

}