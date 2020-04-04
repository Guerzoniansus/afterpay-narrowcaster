<style>
    .spotifyplayer{
        padding:10px;
        width:100%;
        height:100%;
    }
</style>
<?php
    $spotifyfilePath = getcwd()."\widgets\spotify\piles\spotify.txt";
    $spotifyfp = fopen($spotifyfilePath, "r");
    $spotifyuri = fread($spotifyfp, filesize($spotifyfilePath));
    fclose($spotifyfp);

    $substring_start = strpos($spotifyuri, ":");
    $substring_start += strlen(":");
    $size = strpos($spotifyuri, ":", $substring_start) - $substring_start;
    $spotifytype = substr($spotifyuri, $substring_start, $size);
    
    $spotifyid = substr($spotifyuri,strpos($spotifyuri,$spotifytype)+strlen($spotifytype.":"));
?>
<iframe class="spotifyplayer" src="https://open.spotify.com/embed/<?=$spotifytype?>/<?=$spotifyid?>" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>