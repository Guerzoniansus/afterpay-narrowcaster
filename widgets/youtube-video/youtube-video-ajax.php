<?php
$text = $_POST["youtubevideoLink"];

$filePath = getcwd() . "\piles\pideo.txt";

$fp = fopen($filePath, "w");
fwrite($fp,$text);
fclose($fp);
echo $text;
?>