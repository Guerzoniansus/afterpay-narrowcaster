<style>
    .youtubeplaylistform{
        font-size:300%;
    }
</style>
<?php
$ytpfilePath = getcwd()."\widgets\youtube-playlist\piles\playlist.txt";
$ytpfp = fopen($ytpfilePath, "r");
$playlistid = fread($ytpfp, filesize($ytpfilePath));
fclose($ytpfp);
?>

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
        console.log(youtubeplaylistLink);
        });
    });
</script>