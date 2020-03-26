// Get widget index
// $(element).parent().find('input[name=widget-index]').val();

$(document).ready(function() {

    // Small delay so things load properly
    setTimeout(function() {
        summernoteLoadText();
    }, 100);


    $(document).on("click", ".summernote-edit-button", function() {
        widgetIndex = $(this).parent().parent().find('input[name=widget-index]').val();
        summernoteEdit(widgetIndex);
    });

    $(document).on("click", ".summernote-save-button", function() {
        widgetIndex = $(this).parent().parent().find('input[name=widget-index]').val();
        summernoteSave(widgetIndex);
    });

});

function getSummernoteElement(widgetIndex) {
    return $('.summernote').eq(widgetIndex - 1);
}

function summernoteEdit(widgetIndex) {
    var height = summernoteCalculateHeight(widgetIndex);
    var summernoteElement = $('.summernote').eq(widgetIndex-1);

    $(summernoteElement).summernote({
        disableResizeEditor: true,
        height: height,
        focus: true,
        callbacks: {
            // Remove warning / success text when continuing to type
            onChange: function(contents, $editable) {$(".summernote-status-message").text("");}
        }
    });

    $(".note-editor").css('width', '100%');
    //summernoteLoadText();
}

function summernoteSave(widgetIndex) {
    summernoteElement = getSummernoteElement(widgetIndex);

    markup = $(summernoteElement).summernote('code');
    pageName = $('input[name=pageName]').val();

    $(summernoteElement).summernote('destroy');

    $.post('widgets/text/text-handler.php', {
        action: "save",
        text: markup,
        pageName: pageName,
        widgetIndex: widgetIndex
    }, function(data, status) {
        if (status != "success") {
            summernoteShowStatusMessage(true, "Something went wrong, please try again.", widgetIndex)
        }
        else {
            if (data == "success") {
                summernoteShowStatusMessage(false, "Save successful", widgetIndex)
            }

            else {
                summernoteShowStatusMessage(true, "Something went wrong, please try again.", widgetIndex)
            }
        }
    })

}

function summernoteLoadText() {
    //$(summernoteElement).summernote('code', "yoyoyooyoyoyooyoyoyoy");
    pageName = $('input[name=pageName]').val();
    $.get('widgets/text/' + pageName + "/" + (1) + ".txt", function(data) {
        $(".summernote").eq(0).summernote('code', data);
        $(".summernote").eq(0).summernote('destroy');
    });
    $.get('widgets/text/' + pageName + "/" + (2) + ".txt", function(data) {
        $(".summernote").eq(1).summernote('code', data);
        $(".summernote").eq(1).summernote('destroy');
    });
    $.get('widgets/text/' + pageName + "/" + (3) + ".txt", function(data) {
        $(".summernote").eq(2).summernote('code', data);
        $(".summernote").eq(2).summernote('destroy');
    });

    $.get('widgets/text/' + pageName + "/" + (4) + ".txt", function(data) {
        $(".summernote").eq(3).summernote('code', data);
        $(".summernote").eq(3).summernote('destroy');
    });

    $(".summernote-buttons").show();
}

function summernoteCalculateHeight(widgetIndex) {
    pageLayout = $('input[name=pageLayout]').val();
    small = 325;
    big = 750;

    if (pageLayout == "1" || (pageLayout == "2-vertical") || (pageLayout == "2-1" && widgetIndex == "3")
        || (pageLayout == "1-2" && widgetIndex == "1")) {
        return big;
    }
    else return small;
}

function summernoteShowStatusMessage(error, message, widgetIndex) {
    var element = $(".summernote-status-message").eq(widgetIndex - 1);
    if (error == true) {
        $(element).removeClass("text-success");
        $(element).addClass("text-danger");
    }
    else {
        $(element).removeClass("text-danger");
        $(element).addClass("text-success");
    }

    $(element).text(message);
}

function summernoteAddButtonIndexes() {
    $('.summernote-edit-button').eq(0).attr("id", "summernote-edit-button-1");
    $('.summernote-save-button').eq(0).attr("id", "summernote-edit-button-1");
    $('.summernote-edit-button').eq(1).attr("id", "summernote-edit-button-2");
    $('.summernote-save-button').eq(1).attr("id", "summernote-edit-button-2");
    $('.summernote-edit-button').eq(2).attr("id", "summernote-edit-button-3");
    $('.summernote-save-button').eq(2).attr("id", "summernote-edit-button-3");
    $('.summernote-edit-button').eq(3).attr("id", "summernote-edit-button-4");
}
