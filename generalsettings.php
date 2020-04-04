<?php

if (!empty($_POST["action"])) {
    $action = $_POST["action"];

    switch ($action) {
        case "updateSettings":
            updateSettings();
            break;
        case "getTimeout":
            getTimeout(true);
            break;
    }
}

/**
 * Get timeout time
 * @param bool $echo whether the value should be echo'd (to AJAX request), or returned (as PHP variable)
 * @return mixed
 */
function getTimeout(bool $echo) {
    $file = "generalsettings.txt";
    $contents = file_get_contents($file);
    $timeout = explode(":", $contents)[1];

    if ($echo == true) echo $timeout;
    else return $timeout;
}

function updateSettings() {
    $option = $_POST["option"];


    if ($option == "timeout") {
        $newValue = $_POST["newValue"];

        // This is in case the admin accidentally forgets to type a number
        if (empty($_POST["newValue"]) || !isset($_POST["newValue"])) $newValue = "1";

        $filePath = "generalsettings.txt";

        $fp = fopen($filePath, "w");

        // Right now it will just overwrite the entire file
        // Later on the code might need to be changed if we add more options

        fwrite($fp, "timeout:" . $newValue);
        fclose($fp);
    }
}