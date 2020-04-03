<style>
    .youtubeplaylistform{
        font-size:175%;
        padding:10px;
        padding-top:2px;
        
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
    .ytplaylistbtn{
        cursor:pointer;
        border: 1px solid transparent;
        border-radius:5px;
        background-color:rgba(135, 205, 155, 0.5);
    }
    .ytplaylistbtn:hover{
        background-color: rgba(135, 205, 155, 0.8);
    }
    .youtubeplaylistinput{
        padding:2px;
        border: 1px solid rgba(135, 205, 155, 0.8);
        border-radius:5px;
    }
    .youtubeplaylistinput:focus{
        outline:none;
    }
</style>
<?php
$ytpfilePath = getcwd()."\widgets\youtube-playlist\piles\playlist.txt";
$ytpfp = fopen($ytpfilePath, "r");
$playlistid = fread($ytpfp, filesize($ytpfilePath));
fclose($ytpfp);
?>
<div class="ytplaylist"><iframe class="youtubeplaylistplayer" src="https://www.youtube.com/embed/videoseries?amp;list=<?=$playlistid?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
<h3>Insert a YouTube Playlist ID here</h3>
<form method="post" class="youtubeplaylistform">
    <input type="text" name="playlist" class="youtubeplaylistinput" value=<?=$playlistid?>>
    <button type="submit" class="ytplaylistbtn">Save</button>
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