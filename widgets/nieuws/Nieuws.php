<?php

?>
<html> 
<head>
<!-- idk of dit werkt -->
<script>
 $(document).ready(function()
 {
 setInterval(function() {
     .news 

 },5000);
 });

</script>
<!-- dit is het nu.nl algemeen rss nieuws omgezet via een site naar html -->
</head>
<div class="news" >
<script src="//rss.bloople.net/?url=https%3A%2F%2Fwww.nu.nl%2Frss%2FAlgemeen&detail=30&limit=4&showtitle=true&type=js"></script>
</div>
<style>
/* gewoon geprobeerd te kijken wat er nou verneukt werd, want alleen de tekst wordt verplaats. de achtergrond blijft wel goed. */
.news {
    max-height: 95%;
    padding: 35px;
    height: 99%;
    width: 99%;
    background-color: lightblue;
    overflow: hidden;
}
</style> 

