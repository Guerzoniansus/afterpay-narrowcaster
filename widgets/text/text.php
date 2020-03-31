<?php


?>

<div class="summernote" style="width: 100%; height: 100%; padding: 10px; overflow-y: hidden"></div>

<script>
    // CHECK IF SCRIPT IS ALREADY LOADED, OTHERWISE CLICK EVENTS GET LOADED 4 TIMES
    // AND YES, THIS DOES GIVE AN ERROR IN THE CONSOLE. JUST IGNORE THE ERROR. THIS IS THE ONLY WAY TO MAKE IT WORK.
    let summerScripts = Array
        .from(document.querySelectorAll('script'))
        .map(scr => scr.src);
    if (!summerScripts.includes('widgets/text/text.js')) {
        console.log("loading");
        $.getScript('widgets/text/text.js');
    }
</script>
