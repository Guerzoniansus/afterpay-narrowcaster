<?php
$text = $_POST["spotifyURI"];

$filePath = getcwd() . "\piles\spotify.txt";

$fp = fopen($filePath, "w");
fwrite($fp,$text);
fclose($fp);
echo $text;
?>