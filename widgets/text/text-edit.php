<?php

?>

<div id="summernote">Hello Summernote</div>

<script>

    var container_index_summernote = "yo";

    function importTextEditor() {
        $('#summernote').summernote({
            height: 350,
            disableResizeEditor: true
        });
    }

    $(document).ready(function() {

        container_index_summernote = $('#I_will_put_my_contents_inside_this').parent().find('input[name=widget-index]').val();

        importTextEditor()

        $(".note-editor").css('width', '90%');
        $(".note-editor").css('height', '100%');

    });

</script>

