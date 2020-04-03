<style>
    .youtubeplaylistform{
        font-size:175%;
        padding:10px;
    }
    .ytplaylist{
        height:100%;
        width:100%;
        padding:10px;
        text-align:center;
    }
    .youtubeplaylistplayer{
        height:100%;
        width:80%;
    }
</style>
<?php
$ytpfilePath = getcwd()."\widgets\youtube-playlist\piles\playlist.txt";
$ytpfp = fopen($ytpfilePath, "r");
$playlistid = fread($ytpfp, filesize($ytpfilePath));
fclose($ytpfp);
?>
<div class="ytplaylist"><iframe class="youtubeplaylistplayer" src="https://www.youtube.com/embed/videoseries?amp;list=<?=$playlistid?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
<h1>Insert a YouTube Playlist ID here</h1>
<form method="post" class="youtubeplaylistform">
    <input type="text" name="playlist" class="youtubeplaylistinput" value=<?=$playlistid?>>
    <button type="submit">Save</button>
</form>
<script>
    $(".youtubeplaylistform").submit(function(e) {
        e.preventDefault();
        var youtubeplaylistLink = $(".youtubeplaylistinput").val(); //je input element

        $.post('/widgets/youtube-playlist/youtube-playlist-ajax.php', {youtubeplaylistLink: youtubeplaylistLink}, function(data) {
            // stuff to do after saving, like saying "link saved!"
            $(".ytplaylist").html('<iframe class="youtubeplaylistplayer" src="https://www.youtube.com/embed/videoseries?amp;list='+data+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
        });
    });
</script>