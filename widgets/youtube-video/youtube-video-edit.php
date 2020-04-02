<style>
    .youtubevideoform{
        font-size:300%;
    }
</style>
<?php
$ytvfilePath = getcwd()."\widgets\youtube-video\piles\pideo.txt";
$ytvfp = fopen($ytvfilePath, "r");
$videoid = fread($ytvfp, filesize($ytvfilePath));
fclose($ytvfp);
?>

<h1>Insert a YouTube Video ID here</h1>
<form method="post" class="youtubevideoform">
    <input type="text" name="video" class="youtubevideoinput" value=<?=$videoid?>>
    <button type="submit">Save</button>
</form>
<script>
    $(".youtubevideoform").submit(function(e) {
        e.preventDefault();
        var youtubevideoLink = $(".youtubevideoinput").val(); //je input element

        $.post('/widgets/youtube-video/youtube-video-ajax.php', {youtubevideoLink: youtubevideoLink}, function(data) {
        // stuff to do after saving, like saying "link saved!"
        console.log(youtubevideoLink);
        });
    });
</script>