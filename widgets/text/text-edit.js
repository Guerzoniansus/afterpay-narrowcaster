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
        summernoteSave(widgetIndex, true);
    });


});


function getSummernoteElement(widgetIndex) {
    return $(".widget-container[id=" + widgetIndex + "]").find(".summernote");
}

function summernoteEdit(widgetIndex) {
    var height = summernoteCalculateHeight(widgetIndex);
    var summernoteElement = getSummernoteElement(widgetIndex);

    $(summernoteElement).summernote({
        disableResizeEditor: true,
        placeholder: "Your text also gets saved when you leave or refresh the page",
        height: height,
        focus: true,
        fontSizes: ['10', '12', '14', '16', '18', '24', '36', '48' , '72', '100', '120', '150', '200'],
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear',]],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']], ,
        ],
        callbacks: {
            // Remove warning / success text when continuing to type
            onChange: function(contents, $editable) {$(".summernote-status-message").text("");}
        }
    });

    $(".note-editor").css('width', '100%');
}

function summernoteSaveAll() {

    for (i = 1; i < 5; i++) {
        try {
            summernoteSave(i, false);
        }
        catch(error) {
            // Just ignore the error, try catch is so stuff doesnt crash when
            // 1 widget container doesn't actually have the text widget
        }
    }

}

function summernoteSave(widgetIndex, showMessage) {
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
            if (showMessage) summernoteShowStatusMessage(true, "Something went wrong, please try again.", widgetIndex)
        }
        else {
            if (data == "success") {
                if (showMessage) summernoteShowStatusMessage(false, "Save successful", widgetIndex)
            }

            else {
                if (showMessage) summernoteShowStatusMessage(true, "Something went wrong, please try again.", widgetIndex)
            }
        }
    });

}

function summernoteLoadText() {
    pageName = $('input[name=pageName]').val();


    $.get('widgets/text/' + pageName + "/" + (1) + ".txt", function(data) {
        $(".widget-container[id=1]").find(".summernote").summernote('code', data);
        $(".widget-container[id=1]").find(".summernote").summernote('destroy');
    });

    $.get('widgets/text/' + pageName + "/" + (2) + ".txt", function(data) {
        $(".widget-container[id=2]").find(".summernote").summernote('code', data);
        $(".widget-container[id=2]").find(".summernote").summernote('destroy');
    });

    $.get('widgets/text/' + pageName + "/" + (3) + ".txt", function(data) {
        $(".widget-container[id=3]").find(".summernote").summernote('code', data);
        $(".widget-container[id=3]").find(".summernote").summernote('destroy');
        console.log(3 + data);
    });

    $.get('widgets/text/' + pageName + "/" + (4) + ".txt", function(data) {
        $(".widget-container[id=4]").find(".summernote").summernote('code', data);
        console.log(4 + data);
        $(".widget-container[id=4]").find(".summernote").summernote('destroy');
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
    var element = $(".widget-container[id=" + widgetIndex + "]").find(".summernote-status-message");
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
