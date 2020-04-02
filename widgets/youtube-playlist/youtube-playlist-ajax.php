<?php
$text = $_POST["youtubeplaylistLink"];

$filePath = getcwd() . "\piles\playlist.txt";

$fp = fopen($filePath, "w");
fwrite($fp,$text);
fclose($fp);
?>