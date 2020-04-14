<?php

if (isset($_POST["action"])) {
	$action = $_POST["action"];

	switch ($action) {
		case "save":
			saveCalendar();
			break;
		case "load":
			loadCalendar();
			break;
	}
}

function loadCalendar() {
	$filePath = getcwd() . "\URL.txt";
	$file = fopen($filePath, "r");
	$URL = file_get_contents($filePath);
	fclose($file);

	echo $URL;
}

function saveCalendar() {
	$URL = $_POST["URL"];

	// Replace width and height with 100%
	$URL = preg_replace('/width="(.*?)"/', 'width="100%"', $URL);
	$URL = preg_replace('/height="(.*?)"/', 'height="100%"', $URL);

	$filePath = getcwd() . "\URL.txt";
	$fp = fopen($filePath, "w");
	fwrite($fp, $URL);
	fclose($fp);
}

?>


