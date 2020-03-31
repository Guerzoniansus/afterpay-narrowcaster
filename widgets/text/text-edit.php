<?php

?>

<div class="summernote-buttons" style="display: none">
    <button class="summernote-edit-button btn btn-primary" type="button">Edit Text</button>
    <button class="summernote-save-button btn btn-primary" type="button">Save</button>
    <p class="summernote-status-message d-inline"></p>
</div>

<div class="summernote" style="width: 100%; height: 92%; padding: 10px; overflow-y: hidden"></div>

<script>
    // CHECK IF SCRIPT IS ALREADY LOADED, OTHERWISE CLICK EVENTS GET LOADED 4 TIMES
    // AND YES, THIS DOES GIVE AN ERROR IN THE CONSOLE. JUST IGNORE THE ERROR. THIS IS THE ONLY WAY TO MAKE IT WORK.
    let summerScripts = Array
        .from(document.querySelectorAll('script'))
        .map(scr => scr.src);
    if (!summerScripts.includes('widgets/text/text-edit.js')) {
        console.log("loading");
        $.getScript('widgets/text/text-edit.js');
    }
</script>