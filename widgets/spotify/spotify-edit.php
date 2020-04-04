<style>
    .spotifyplayer{
        height:100%;
        width:100%;
    }
    .spotplayer{
        height:100%;
        width:100%;
        padding:10px;
    }
    .spotifyform{
        font-size:175%;
        padding:10px;
        padding-top:2px;
    }
    .spotifybtn{
        cursor:pointer;
        border: 1px solid transparent;
        border-radius:5px;
        background-color:rgba(135, 205, 155, 0.5);
    }
    .spotifybtn:hover{
        background-color: rgba(135, 205, 155, 0.8);
    }
    .spotifyinput{
        padding:2px;
        border: 1px solid rgba(135, 205, 155, 0.8);
        border-radius:5px;
    }
    .spotifyinput:focus{
        outline:none;
    }
</style>
<div class="spotplayer">
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
</div>

<h3>Insert a Spotify URI here</h3>
<form method="post" class="spotifyform">
    <input type="text" name="playlist" class="spotifyinput" value=<?=$spotifyid?>>
    <button type="submit" class="spotifybtn">Save</button>
</form>
<a href="/widgets/spotify/spotify-help.php" target="_blank">Click here for help with getting a Spotify link</a>
<script>
    $(".spotifyform").submit(function(e) {
        e.preventDefault();
        var spotifyURI = $(".spotifyinput").val(); //je input element

        $.post('/widgets/spotify/spotify-ajax.php', {spotifyURI: spotifyURI}, function(data) {
            var nospotify = data.substring(8);
            var location = nospotify.indexOf(":");
            var spotifytype = nospotify.substring(0,location);
            var spotifyid = nospotify.substring(spotifytype.length+1);
            console.log(spotifyid);
            $(".spotplayer").html('<iframe class="spotifyplayer" src="https://open.spotify.com/embed/'+spotifytype+'/'+spotifyid+'" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>')
        });
    });
</script>