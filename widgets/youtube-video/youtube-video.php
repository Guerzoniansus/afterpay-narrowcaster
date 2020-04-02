<style>
    .youtubevideoplayer{
        width:100%;
        height:100%;
        padding:10px;
    }
</style>
<?php
    $ytvfilePath = getcwd()."\widgets\youtube-video\piles\pideo.txt";
    $ytvfp = fopen($ytvfilePath, "r");
    $videoid = fread($ytvfp, filesize($ytvfilePath));
    fclose($ytvfp);
?>
<iframe class="youtubevideoplayer" src="https://www.youtube.com/embed/<?=$videoid?>?controls=0&autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>