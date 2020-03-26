<?php

?>
<div class="summernote-buttons">
    <button class="summernote-edit-button btn btn-primary" type="button">Edit</button>
    <button class="summernote-save-button btn btn-primary" type="button">Save</button>
</div>

<div class="summernote" style="width: 100%; height: 92%; overflow-y: hidden">click2edit</div>

<!--div class="summernote">
    <div id="summernote-save-message"></div>
</div-->

<script>

    function getWidgetIndex(element) {
        return $(element).parent().find('input[name=widget-index]').val();
    }


    function summernoteEdit(widgetIndex) {
        var height = calculateHeight(widgetIndex);

        $('.summernote').eq(widgetIndex-1).summernote({
            disableResizeEditor: true,
            height: height,
            focus: true,
        });
        $(".note-editor").css('width', '89%');
        $(".note-editor").css('height', '100%');

        loadText();
    }

    function summernoteSave(widgetIndex) {
        var markup = $('.summernote').eq(widgetIndex-1).summernote('code');
        $('.summernote').eq(widgetIndex-1).summernote('destroy');
    }

    function loadText() {

    }

    function calculateHeight(widgetIndex) {
        var pageLayout = $('input[name=pageLayout]').val();
        var small = 325;
        var big = 750;

        if (pageLayout == "1" || (pageLayout == "2-vertical") || (pageLayout == "2-1" && widgetIndex == "3")
        || (pageLayout == "1-2" && widgetIndex == "1")) {
            return big;
        }
        else return small;
    }

    $(document).ready(function() {

        //importTextEditor()

        $(document).on("click", ".summernote-edit-button", function() {
            var widgetIndex = $(this).parent().parent().find('input[name=widget-index]').val();
            summernoteEdit(widgetIndex);
        });

        $(document).on("click", ".summernote-save-button", function() {
            var widgetIndex = $(this).parent().parent().find('input[name=widget-index]').val();
            summernoteSave(widgetIndex);
        });


    });

</script>

