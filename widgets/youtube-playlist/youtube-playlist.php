<style>
    .youtubeplaylistplayer{
        width:100%;
        height:100%;
        padding:10px;
    }
</style>
<?php
    $ytpfilePath = getcwd()."\widgets\youtube-playlist\piles\playlist.txt";
    $ytpfp = fopen($ytpfilePath, "r");
    $playlistid = fread($ytpfp, filesize($ytpfilePath));
    fclose($ytpfp);
?>
<iframe class="youtubeplaylistplayer" src="https://www.youtube.com/embed/videoseries?controls=0&amp;list=<?=$playlistid?>&autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>