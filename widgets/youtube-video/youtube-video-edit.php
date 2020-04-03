<style>
    .youtubevideoform{
        font-size:175%;
        padding:10px;
        padding-top:2px;
        
    }
    .ytvideo{
        height:100%;
        width:100%;
        padding:10px;
        text-align:center;
    }
    .youtubevideoplayer{
        height:100%;
        width:80%;
    }
    .ytvideobtn{
        cursor:pointer;
        border: 1px solid transparent;
        border-radius:5px;
        background-color:rgba(135, 205, 155, 0.5);
    }
    .ytvideobtn:hover{
        background-color: rgba(135, 205, 155, 0.8);
    }
    .youtubevideoinput{
        padding:2px;
        border: 1px solid rgba(135, 205, 155, 0.8);
        border-radius:5px;
    }
    .youtubevideoinput:focus{
        outline:none;
    }
</style>
<?php
$ytvfilePath = getcwd()."\widgets\youtube-video\piles\pideo.txt";
$ytvfp = fopen($ytvfilePath, "r");
$videoid = fread($ytvfp, filesize($ytvfilePath));
fclose($ytvfp);
?>
<div class="ytvideo"><iframe class="youtubevideoplayer" src="https://www.youtube.com/embed/<?=$videoid?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
<h3 style="margin:0px;">Insert a YouTube Video ID here</h3>
<form method="post" class="youtubevideoform">
    <input type="text" name="video" class="youtubevideoinput" value=<?=$videoid?>>
    <button class="ytvideobtn" type="submit">Save</button>
</form>
<script>
    $(".youtubevideoform").submit(function(e) {
        e.preventDefault();
        var youtubevideoLink = $(".youtubevideoinput").val(); //je input element

        $.post('/widgets/youtube-video/youtube-video-ajax.php', {youtubevideoLink: youtubevideoLink}, function(data) {
            // stuff to do after saving, like saying "link saved!" 
            $(".ytvideo").html('<iframe class="youtubevideoplayer" src="https://www.youtube.com/embed/'+data+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
        });
    });
</script>